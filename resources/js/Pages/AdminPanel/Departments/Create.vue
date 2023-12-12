<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить кафедру'" />
			<form @submit.prevent="store">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок кафедры'" />
				<AdminFormSelect v-model="form.faculty_id" :required="true" :items="this.faculties">
					<option value="" selected disabled>Выберите факультет</option>
				</AdminFormSelect>
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Создать кафедру'" />
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
import AdminFormCheckbox from "@/Components/AdminFormCheckbox.vue";
import AdminFormDropZone from "@/Components/AdminFormDropZone.vue";
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormEditorJs from "@/Components/AdminFormEditorJs.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormSelect from "@/Components/AdminFormSelect.vue";


export default {
    name: "Create",
    components: {
		AdminFormSelect,
		AdminFormHeader,
		AdminFormEditorJs,
		AdminFormButton,
		AdminFormDropZone,
		AdminFormCheckbox,
		AdminFormInput,
		AdminFormLayout,
        AdminLayout,
        Link,
    },
    props: [
        'errors',
		'faculties'
    ],
    data() {
        return {
            editorError: false,
            form: this.$inertia.form({
                title: null,
				faculty_id: "",
            }),
        }
    },
    methods: {
        store() {
            this.form.post(route('admin.department.store'))
        },
    },

}
</script>


<style scoped>

</style>
