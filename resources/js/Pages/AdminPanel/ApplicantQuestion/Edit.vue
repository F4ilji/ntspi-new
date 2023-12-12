<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Обновить вопрос абитуриента'" />
			<form @submit.prevent="submit">
				<div class="grid gap-4 mb-4 sm:grid-cols-2">
					<AdminFormInput v-model="form.first_name" :error="form.errors.first_name" :placeholder="'Имя'" />
					<AdminFormInput v-model="form.last_name" :error="form.errors.last_name" :placeholder="'Фамилия'" />
				</div>

				<div class="grid gap-4 mb-4 sm:grid-cols-2">
					<AdminFormInput v-model="form.email" :error="form.errors.email" :placeholder="'Email'" />
					<AdminFormInput v-model="form.phone" :error="form.errors.phone" :placeholder="'Телефон'"></AdminFormInput>
				</div>
				<AdminFormTextarea v-model="form.text" :error="form.errors.text" :label="'Задать вопрос'" />

				<AdminFormButton v-bind="$attrs" type="submit" :title="'Создать новость'" />

			</form>
		</AdminFormLayout>
	</AdminLayout>

</template>

<script>

import {Link, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import EditorJS from "@editorjs/editorjs";
import AttachesTool from '@editorjs/attaches';
import Quote from '@editorjs/quote';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import AnyButton from 'editorjs-button';
import Paragraph from '@editorjs/paragraph';
import Header from '@editorjs/header';
import TextVariantTune from '@editorjs/text-variant-tune';
import AdminFormLayout from "@/Components/AdminFormLayout.vue";
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormTextarea from "@/Components/AdminFormTextarea.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";


export default {
    name: "Create",
    components: {
		AdminFormHeader, AdminFormButton, AdminFormTextarea, AdminFormInput, AdminFormLayout,
        AdminLayout,
        Link,
    },

    props: [
        'errors',
        'categories',
        'post'
    ],
    data() {
        return {
            editorError: false,
            form: this.$inertia.form({
                title: this.post.data.title,
                content: null,
                category_id: this.post.data.category_id || "",
                author: this.post.data.authors[0].name,
            }),
        }
    },
    methods: {
        update() {
            this.form.patch(route('admin.post.update', this.post.data.id))

        },
        saveEditor() {
            this.editor.save().then((outputData) => {
                this.form.content = outputData
                this.update()
            }).catch((error) => {
                console.log('Saving failed: ', error)
            });
        }
    },
    mounted() {
        this.editor = new EditorJS({
            holder: this.$refs.editor,
            data: JSON.parse(this.post.data.content),
            minHeight: 150,
            placeholder: "Заполните новость",
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: ['link'],
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
                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: '/upload-image', // Your backend file uploader endpoint
                        }
                    }
                },
            },
        });


    },
    beforeUnmount() {
        this.editor.destroy();
    },
}
</script>


<style scoped>

</style>
