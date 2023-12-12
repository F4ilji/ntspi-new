<template>
	<div class="w-full pb-4">
		<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">{{ label }}</label>
		<div class="bg-gray-50 text-center py-10 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" ref="dropzone">
		</div>
	</div>
</template>

<script>
import { Dropzone } from "dropzone";
export default {
	name: "AdminFormDropZone",
	data() {
		return {
			dropzone: null,
			images: null,
		};
	},
	methods: {
		saveImages() {
			this.images = this.dropzone.getAcceptedFiles();
			this.$emit('get-images', this.images);
		},

	},
	props: ["label", "modelValue"],
	mounted() {
		this.dropzone = new Dropzone(this.$refs.dropzone, {
			url: "adgdagssdgag",
			autoProcessQueue: false,
			dictDefaultMessage: "Put your custom message here",
			resizeHeight: 800,
			addRemoveLinks: true,
		});
	},
};
</script>