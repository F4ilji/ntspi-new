<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить страницу'"/>
			<form @submit.prevent="submitForm">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" @input="generateSlug"
								:placeholder="'Заголовок страницы'"/>
				<div class="grid gap-4 mb-4 sm:grid-cols-2">
					<AdminFormInput v-model="form.slug" :error="form.errors.slug" :placeholder="'slug'"/>
					<AdminFormInput v-model="form.path" :error="form.errors.path" :placeholder="'Путь'"/>
				</div>
				<AdminFormSelect v-model="form.code">
					<option value="200">Открытая страница</option>
					<option value="404">Страница не найдена</option>
					<option value="401">Требуется авторизация</option>
				</AdminFormSelect>
				<AdminFormPageEditorJs :contentData="this.page.data.content" @get-content="getContentFromChildComponentEditorJs"
									   :error="form.errors['content.blocks']" ref="editorJsComponent"/>
				<AdminFormButton type="submit" :title="'Обновить'"/>
			</form>
		</AdminFormLayout>
	</AdminLayout>

</template>

<script>

import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import EditorJS from "@editorjs/editorjs";
import AttachesTool from '@editorjs/attaches';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Header from '@editorjs/header';
import {Dropzone} from "dropzone";
import editorjsColumns from "@calumk/editorjs-columns";
import AdminFormLayout from "@/Components/AdminFormLayout.vue";
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormPageEditorJs from "@/Components/AdminFormPageEditorJs.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormSelect from "@/Components/AdminFormSelect.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";


export default {
    name: "Create",
    components: {
		AdminFormHeader, AdminFormSelect, AdminFormButton, AdminFormPageEditorJs, AdminFormInput, AdminFormLayout,
        AdminLayout,
        Link,
    },

    props: [
        'page',
        'errors',
    ],

    data() {
        return {
            editorError: false,
            form: this.$inertia.form({
                id: this.page.data.id,
                title: this.page.data.title,
                content: this.page.data.content,
                slug: this.page.data.slug,
                path: this.page.data.path,
                code: this.page.data.code,
            }),
        }
    },
    methods: {
		async submitForm() {
			await this.update()
		},
		async getContentFromChildComponentEditorJs(content) {
			const dataArray = JSON.parse(JSON.stringify(content));
			this.form.content = dataArray
		},
        update() {
            this.form.patch(route('admin.page.update', this.page.data.id))
        },
        generateSlug() {
            this.form.title.toLowerCase().trim().replace(/[^a-zа-я]/g, '-').replace(/-+/g, '-');
        }
    },

}
</script>


<style scoped>

</style>
