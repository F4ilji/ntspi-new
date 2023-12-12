<script>
import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
import AttachesTool from "@editorjs/attaches";
import ImageTool from "@editorjs/image";
import editorjsColumns from "@calumk/editorjs-columns";
import LinkTool from '@editorjs/link';

export default {
	name: "AdminFormPageEditorJs",
	data() {
		return {
			editor: null,
			content: null,
		}
	},
	methods: {
		saveEditor() {
			this.editor.save().then((outputData) => {
				this.content = outputData
				this.$emit('get-content', this.content);
			}).catch((error) => {
				console.log('Saving failed: ', error)
			});
		},

	},
	mounted() {
		const columnTools = {
			header: Header,
			list: List,
			image: {
				class: ImageTool,
				config: {
					endpoints: {
						byFile: '/upload-image', // Your backend file uploader endpoint
					}
				}
			},
		};
		const mainTools = {
			image: {
				class: ImageTool,
				config: {
					endpoints: {
						byFile: '/upload-image', // Your backend file uploader endpoint
					}
				}
			},
			header: {
				class: Header,
				inlineToolbar: ['link'],
				levels: [2],
				defaultLevel: 2
			},
			list: {
				class: List,
				inlineToolbar: ['link', 'bold'],
			},
			attaches: {
				class: AttachesTool,
				config: {
					endpoint: '/upload-file'
				}
			},
			columns: {
				class: editorjsColumns,
				config: {
					EditorJsLibrary: EditorJS, // Pass the library instance to the columns instance.
					tools: columnTools // IMPORTANT! ref the columnTools
				}
			},
			linkTool: {
				class: LinkTool,
				config: {
					endpoint: '/getInfoForLink', // Your backend endpoint for url data fetching,
				}
			}
		};
		this.editor = new EditorJS({
			holder: this.$refs.editor,
			minHeight: 150,
			data: this.contentData,
			placeholder: "Заполните контент страницы",
			tools: mainTools,
			onChange: () => {
				this.saveEditor()
			}
		});
	},

	props: [
		'error',
		'contentData'
	]
}
</script>

<template>
	<div class="mb-4">
		<div class="sm:col-span-2">
			<div :class="{'border-red-600 dark:border-red-500 transition-colors duration-500': error}"
				 class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
				<div class="sm:col-span-12">
					<div class="" ref="editor"></div>
				</div>
			</div>
			<p v-if="error" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ error }}</p>
		</div>
	</div>
</template>

<style scoped>
.ce-block__content {
	max-width: 650px !important;
}

</style>