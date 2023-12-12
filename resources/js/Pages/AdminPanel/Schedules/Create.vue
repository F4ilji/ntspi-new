<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить расписание'" />
			<form @submit.prevent="store">
				<AdminFormSelect :required="true" v-model="form.faculty_id" :items="this.faculties">
					<option disabled selected value="">Выберите факультет</option>
				</AdminFormSelect>
				<div class="flex items-center mb-4">
					<label for="hs-basic-with-description" class="text-sm text-gray-500 me-3 dark:text-gray-400">Заочная форма</label>
					<input v-model="form.is_fullTime" type="checkbox" id="hs-basic-with-description" class="relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600

  before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200">
					<label for="hs-basic-with-description" class="text-sm text-gray-500 ms-3 dark:text-gray-400">Очная формай</label>
				</div>

				<div class="mb-4">
					<input required @input="form.files = $event.target.files" multiple type="file">
				</div>

				<AdminFormButton v-bind="$attrs" type="submit" :title="'Добавить расписание'" />
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
import AdminFormList from "@/Components/AdminFormList.vue";
import AdminFormListItem from "@/Components/AdminFormListItem.vue";


export default {
    name: "Create",
    components: {
		AdminFormListItem,
		AdminFormList,
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
                faculty_id: "",
				is_fullTime: true,
				files: null,
            }),
        }
    },
    methods: {
        store() {
            this.form.post(route('admin.schedule.store'))
        },
    },

}
</script>
<style scoped>

</style>
