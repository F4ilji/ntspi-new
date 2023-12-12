<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Обновить подраздел'" />
			<form @submit.prevent="update">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок раздела'" />
				<AdminFormList class="mb-4" :label="'Добавить страницу'" :items="this.pages" :checked_ids="this.form.page_ids" @get-data="getIds"/>
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Обновить подраздел'" />
				{{ this.form.subSection_ids }}
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
import AdminFormButton from "@/Components/AdminFormButton.vue";
import AdminFormHeader from "@/Components/AdminFormHeader.vue";
import AdminFormList from "@/Components/AdminFormList.vue";
import AdminFormListItem from "@/Components/AdminFormListItem.vue";


export default {
    name: "Create",
    components: {
		AdminFormListItem,
		AdminFormList,
		AdminFormHeader, AdminFormButton, AdminFormInput, AdminFormLayout,
        AdminLayout,
        Link,
    },

    props: [
        'errors',
        'subSection',
		'pages',
		'page_ids'
    ],
    data() {
        return {
            form: this.$inertia.form({
                title: this.subSection.data.title,
				page_ids: this.page_ids,
            }),
        }
    },
    methods: {
        update() {
            this.form.patch(route('admin.subSection.update', this.subSection.data.id))
        },
		getIds(data) {
			this.form.page_ids = data
		}
    },


}
</script>


<style scoped>

</style>
