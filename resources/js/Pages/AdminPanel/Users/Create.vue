<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить пользователя'" />
			<form class="mb-4" @submit.prevent="store">
				<AdminFormInput class="mb-4" v-model="form.email" :error="form.errors.email" :placeholder="'Email'" />
				<AdminFormInput :type="'password'" class="mb-4" v-model="form.password" :error="form.errors.password" :placeholder="'Пароль'" />
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Создать пользователя'" />
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
    ],
    data() {
        return {
			editorError: false,
            form: this.$inertia.form({
                email: null,
				password: null,
				password_confirmation: null,
            }),
			formDetailInfo: this.$inertia.form({
				name: null,
				surname: '',
				middleName: '',
				photo: '',
				academicTitle: '',
				administrativePosition: '',
				educatorPosition: '',
				education: '',
				awards: '',
				professDisciplines: '',
				professionalRetraining: '',
				professionalDevelopment: '',
				workExperience: null,
				attendedConferences: '',
				participationScienceProjects: '',
				publications: '',
				trainingAids: '',
				contactEmail: '',
				contactPhone: ''
			}),

		}
    },
    methods: {
        store() {
			this.form.password_confirmation = this.form.password
            this.form.post(route('admin.user.store'))
        },
    },

}
</script>


<style scoped>

</style>
