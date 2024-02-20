<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Добавить студента'" />
			<form @submit.prevent="store">
				<div class="border-b border-gray-200 dark:border-gray-700">
					<nav class="flex flex-wrap space-x-2" aria-label="Tabs" role="tablist">
						<button :data-hs-tab="'#tabs-with-underline-1'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active" role="tab">
							Основная информация
						</button>
						<button :data-hs-tab="'#tabs-with-underline-2'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Должность
						</button>
						<button :data-hs-tab="'#tabs-with-underline-3'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Направление подготовки
						</button>
					</nav>
				</div>

				<div class="mt-3">
					<div id="tabs-with-underline-1" role="tabpanel">
						<div class="grid grid-cols-3 gap-3">
							<AdminFormInput class="mb-4" v-model="formStudent.name" :error="formStudent.errors.name" :placeholder="'Имя'" />
							<AdminFormInput class="mb-4" v-model="formStudent.surname" :error="formStudent.errors.surname" :placeholder="'Фамилия'" />
							<AdminFormInput class="mb-4" v-model="formStudent.middleName" :placeholder="'Отчество (Необязательно)'" />
						</div>
						<div class="grid grid-cols-2 gap-3">
							<AdminFormInput :type="'email'" class="mb-4" v-model="formStudent.contactEmail" :placeholder="'Контактный Email'" />
							<AdminFormInput class="mb-4" v-model="formStudent.vk_link" :placeholder="'Страница ВК'" />
						</div>
						<div class="mb-4">
							<label for="file-input" class="sr-only">Choose file</label>
							<input @input="formStudent.photo = $event.target.files[0]" type="file" name="file-input" id="file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 file:border-0 file:bg-gray-100 file:me-4 file:py-3 file:px-4">
						</div>
					</div>
					<div id="tabs-with-underline-2" class="hidden" role="tabpanel">
							<AdminFormInput class="mb-4" v-model="formStudent.position" :placeholder="'Должность'" />
					</div>
					<div id="tabs-with-underline-3" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formStudent.education" :placeholder="'Направление подготовки'" />
					</div>
				</div>
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Добавить информацию'" />

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
			formStudent: this.$inertia.form({
				name: null,
				surname: null,
				middleName: null,
				photo: null,
				position: null,
				education: null,
				vk_link: null,
				contactEmail: null,
				contactPhone: null,
			}),

		}
    },
    methods: {
        store() {
			this.formStudent.post(route('admin.student.store'))
		},
    },

}
</script>


<style scoped>

</style>
