<template>
    <AdminLayout>
        <AdminFormLayout>
			<AdminFormHeader :title="'Изменить новость'" />

			<form @submit.prevent="submitForm">
				<div class="grid gap-4 mb-4 sm:grid-cols-2">
					<AdminFormInput v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок новости'" />
					<AdminFormInput :disable="true" v-model="form.author" :error="form.errors.author" :placeholder="'Автор'" />
				</div>
				<AdminFormSelect :items="categories">
					<option class="text-gray-900" selected disabled value="">Выберите категорию</option>
				</AdminFormSelect>
				<div class="mb-4">
					<div class="hidden">
						<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple files</label>
						<input class="mb-4 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
					</div>
				</div>
				<AdminFormEditorJs @get-content="getContentFromChildComponentEditorJs" :contentData="this.post.data.content" />
				<AdminFormButton :title="'Обновить'" />

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
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormLayout from "@/Components/AdminFormLayout.vue";
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormSelect from "@/Components/AdminFormSelect.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormEditorJs from "@/Components/AdminFormEditorJs.vue";


export default {
    name: "Create",
    components: {
		AdminFormEditorJs,
		AdminFormButton,
		AdminFormSelect,
		AdminFormInput,
		AdminFormLayout,
		AdminFormHeader,
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
            form: this.$inertia.form({
                title: this.post.data.title,
                content: null,
                category_id: this.post.data.category_id || "",
                author: this.post.data.authors[0].name,
            }),
        }
    },
    methods: {
		async submitForm() {
			await this.update()
		},
        update() {
            this.form.patch(route('admin.post.update', this.post.data.id))

        },
		async getContentFromChildComponentEditorJs(content) {
			const dataArray = JSON.parse(JSON.stringify(content));
			this.form.content = dataArray
		},
    },

}
</script>


<style scoped>

</style>
