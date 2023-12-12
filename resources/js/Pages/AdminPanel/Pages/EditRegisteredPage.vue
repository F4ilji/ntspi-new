<template>
	<AdminLayout>

		<AdminFormLayout>
			<AdminFormHeader :title="'Изменить зарегистрированную страницу'"/>
			<form @submit.prevent="submit">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок'" />
				<AdminFormInput class="mb-4" v-model="form.path" :error="form.errors.title" :placeholder="'Путь'" :disable="true" />
				<AdminFormSelect v-model="form.code">
					<option class="text-gray-900" selected disabled value="">Выберите категорию</option>
					<option value="200">Открытая страница</option>
					<option value="404">Страница не найдена</option>
					<option value="401">Требуется авторизация</option>
				</AdminFormSelect>
				<AdminFormCheckbox v-model="form.is_visible" :label="'Виден?'" />
				<AdminFormButton type="submit" :title="'Обновить'" />
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
import {Dropzone} from "dropzone";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormLayout from "@/Components/AdminFormLayout.vue";
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormSelect from "@/Components/AdminFormSelect.vue";
import AdminFormCheckbox from "@/Components/AdminFormCheckbox.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";


export default {
	name: "Edit",
	components: {
		AdminFormButton,
		AdminFormCheckbox,
		AdminFormSelect,
		AdminFormInput,
		AdminFormLayout,
		AdminFormHeader,
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
				path: this.page.data.path,
				is_visible: this.toBoolean(this.page.data.is_visible),
				code: this.page.data.code,
			}),
		}
	},
	methods: {
		submit() {
			this.update()
		},
		update() {
			this.form.patch(route('admin.registered.page.update', this.page.data.id))
		},
		toBoolean(num) {
			if (num === 1) {
				return true
			} else {
				return false
			}
		}

	},
}
</script>


<style scoped>

</style>
