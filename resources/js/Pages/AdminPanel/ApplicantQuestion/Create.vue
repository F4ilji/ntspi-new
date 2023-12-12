<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить вопрос абитуриента'" />
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

import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import EditorJS from "@editorjs/editorjs";
import AttachesTool from '@editorjs/attaches';
import ImageTool from '@editorjs/image';
import List from '@editorjs/list';
import Header from '@editorjs/header';
import {Dropzone} from "dropzone";
import AdminFormTextarea from "@/Components/AdminFormTextarea.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormInput from "@/Components/AdminFormInput.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormLayout from "@/Components/AdminFormLayout.vue";


export default {
    name: "Create",
    components: {
		AdminFormLayout,
		AdminFormHeader,
		AdminFormInput,
		AdminFormButton,
		AdminFormTextarea,
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
                first_name: null,
                last_name: null,
                email: null,
                phone: null,
                text: null,
            }),
        }
    },
    methods: {
        submit() {
            this.store()
        },
        store() {
            this.form.post(route('admin.applicantQuestion.store'))
        },

    },

}
</script>


<style scoped>

</style>
