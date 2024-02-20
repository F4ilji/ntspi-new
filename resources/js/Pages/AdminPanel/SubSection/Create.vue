<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить подраздел'" />
			<form @submit.prevent="store">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок раздела'" />
				<AdminFormList class="mb-4" :label="'Добавить страницы'" :items="this.pages" @get-data="getIds"/>
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Создать подраздел'" />
			</form>
		</AdminFormLayout>
	</AdminLayout>
</template>


<script>

import {Link, useForm} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
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
        'pages'
    ],
    data() {
        return {
            editorError: false,
            form: this.$inertia.form({
                title: null,
				page_ids: [],
            }),
        }
    },
    methods: {
        store() {
            this.form.post(route('admin.subSection.store'))
        },
		getIds(data) {
			this.form.page_ids = data
		}
    },

}
</script>


<style scoped>

</style>
