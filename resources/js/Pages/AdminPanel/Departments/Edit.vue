<template>
    <AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Обновить факультет'" />
			<form @submit.prevent="update">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок факультета'" />
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Обновить факультет'" />
			</form>
		</AdminFormLayout>
        <!-- End Card Section -->
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


export default {
    name: "Create",
    components: {
		AdminFormHeader, AdminFormButton, AdminFormInput, AdminFormLayout,
        AdminLayout,
        Link,
    },

    props: [
        'errors',
        'faculty'
    ],
    data() {
        return {
            editorError: false,
            form: this.$inertia.form({
                title: this.faculty.title,
            }),
        }
    },
    methods: {
        update() {
            this.form.patch(route('admin.faculty.update', this.faculty.id))
        },
    },

}
</script>


<style scoped>

</style>
