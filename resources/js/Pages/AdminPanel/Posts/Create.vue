<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить новость'" />
			<form @submit.prevent="submitForm">
				<div class="grid gap-4 mb-4 sm:grid-cols-2">
					<AdminFormInput v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок новости'" />
					<AdminFormInput v-model="form.author" :error="form.errors.author" :placeholder="'Автор'" />
				</div>
				<AdminFormSelect v-model="form.category_id" :categories="this.categories" />

				<AdminFormCheckbox v-model="form.is_published" :label="'Опубликовать сейчас'" />

				<AdminFormDropZone @get-images="getImageFromChildComponentDropZone" :label="'Загрузите фотографии'" ref="dropzoneComponent" />

				<AdminFormEditorJs @get-content="getContentFromChildComponentEditorJs" :error="form.errors['content.blocks']" ref="editorJsComponent" />

				<AdminFormButton v-bind="$attrs" type="submit" :title="'Создать новость'" />


			</form>
		</AdminFormLayout>
	</AdminLayout>

</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import AdminFormLayout from "@/Components/AdminFormLayout.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormSelect from "@/Components/AdminFormSelect.vue";
import AdminFormDropZone from "@/Components/AdminFormDropZone.vue";
import AdminFormCheckbox from "@/Components/AdminFormCheckbox.vue";
import AdminFormEditorJs from "@/Components/AdminFormEditorJs.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
export default {
	name: "Create",
	components: {
		AdminFormButton,
		AdminFormEditorJs,
		AdminFormCheckbox,
		AdminFormDropZone,
		AdminFormSelect,
		AdminFormInput,
		AdminFormHeader,
		AdminFormLayout,
		AdminLayout,
		Link,
	},
	props: [
		'errors',
		'categories'
	],
	data() {
		return {
			form: this.$inertia.form({
				title: null,
				content: null,
				category_id: "",
				is_published: true,
				author: null,
				images: null,
			}),
		}
	},
	methods: {
		async submitForm() {
			await this.requestImageFromChildComponentDropZone()
			await this.store()
		},
		store() {
			this.form.post(route('admin.post.store'))
		},
		async getImageFromChildComponentDropZone(images) {
			if (images) {
				this.form.images = images;
			}
		},
		async getContentFromChildComponentEditorJs(content) {
			const dataArray = JSON.parse(JSON.stringify(content));
			this.form.content = dataArray
		},
		requestImageFromChildComponentDropZone() {
			this.$refs.dropzoneComponent.saveImages()
		},
	},
}
</script>




<style scoped>

</style>
