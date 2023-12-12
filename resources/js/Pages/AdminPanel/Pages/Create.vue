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
				<AdminFormPageEditorJs @get-content="getContentFromChildComponentEditorJs"
									   :error="form.errors['content.blocks']" ref="editorJsComponent"/>
				<AdminFormButton type="submit" :title="'Добавить'"/>
			</form>
		</AdminFormLayout>
	</AdminLayout>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import EditorJS from "@editorjs/editorjs";
import AttachesTool from '@editorjs/attaches';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Header from '@editorjs/header';
import slugify from 'slugify';
import editorjsColumns from '@calumk/editorjs-columns';
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormSelect from "@/Components/AdminFormSelect.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormPageEditorJs from "@/Components/AdminFormPageEditorJs.vue";
import AdminFormEditorJs from "@/Components/AdminFormEditorJs.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormLayout from "@/Components/AdminFormLayout.vue";


export default {
	name: "Create",
	components: {
		AdminFormLayout,
		AdminFormHeader,
		AdminFormEditorJs,
		AdminFormPageEditorJs,
		AdminFormButton,
		AdminFormSelect,
		AdminFormInput,
		AdminLayout,
		Link,
	},

	props: [
		'errors',
	],
	data() {
		return {
			editorError: false,
			form: this.$inertia.form({
				title: null,
				content: null,
				slug: null,
				path: null,
				code: 200,
			}),
		}
	},
	methods: {
		async submitForm() {
			await this.store()
		},
		store() {
			this.form.post(route('admin.page.store'))
		},
		async getContentFromChildComponentEditorJs(content) {
			const dataArray = JSON.parse(JSON.stringify(content));
			this.form.content = dataArray
		},
		generateSlug: function () {
			this.form.slug = slugify(this.form.title, {
				lower: true,
				strict: true,
				locale: 'ru'
			});
			this.form.path = this.form.slug
		}
	},
}
</script>


<style scoped>

</style>



