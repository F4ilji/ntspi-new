<template>
    <AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Обновить категорию'" />
			<form @submit.prevent="update">
				<AdminFormInput class="mb-4" v-model="form.title" :error="form.errors.title" :placeholder="'Заголовок категории'" />
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Обновить категорию'" />
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
        'category'
    ],
    data() {
        return {
            editorError: false,
            form: this.$inertia.form({
                title: this.category.title,
            }),
        }
    },
    methods: {
        update() {
            this.form.patch(route('admin.category.update', this.category.id))
        },
    },

}
</script>


<style scoped>

</style>
