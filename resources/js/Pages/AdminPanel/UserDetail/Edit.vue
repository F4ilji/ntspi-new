<template>
	<AdminLayout>
		<AdminFormLayout>
			<AdminFormHeader :title="'Обновить дополнительную информацию'" />
			<form @submit.prevent="update">
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
						<button :data-hs-tab="'#tabs-with-underline-4'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Награды
						</button>
						<button :data-hs-tab="'#tabs-with-underline-5'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Преподаваемые дисциплины
						</button>
						<button :data-hs-tab="'#tabs-with-underline-7'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Данные о повышении квалификации
						</button>
						<button :data-hs-tab="'#tabs-with-underline-6'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Данные о профессиональной переподготовке
						</button>
						<button :data-hs-tab="'#tabs-with-underline-8'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Стаж работы
						</button>
						<button :data-hs-tab="'#tabs-with-underline-9'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Участие в конференциях
						</button>
						<button :data-hs-tab="'#tabs-with-underline-10'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Участие в научных проектах
						</button>
						<button :data-hs-tab="'#tabs-with-underline-11'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Публикации
						</button>
						<button :data-hs-tab="'#tabs-with-underline-12'" type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500" role="tab">
							Учебники и учебные пособия
						</button>
					</nav>
				</div>

				<div class="mt-3">
					<div id="tabs-with-underline-1" role="tabpanel">
						<div class="grid grid-cols-3 gap-3">
							<AdminFormInput class="mb-4" v-model="formDetailInfo.name" :error="formDetailInfo.errors.name" :placeholder="'Имя'" />
							<AdminFormInput class="mb-4" v-model="formDetailInfo.surname" :error="formDetailInfo.errors.surname" :placeholder="'Фамилия'" />
							<AdminFormInput class="mb-4" v-model="formDetailInfo.middleName" :placeholder="'Отчество (Необязательно)'" />
						</div>
						<div class="grid grid-cols-2 gap-3">
							<AdminFormInput :type="'email'" class="mb-4" v-model="formDetailInfo.contactEmail" :placeholder="'Контактный Email'" />
							<AdminFormInput class="mb-4" v-model="formDetailInfo.contactPhone" :placeholder="'Контактный телефон'" />
						</div>
						<div class="mb-4">
							<label for="file-input" class="sr-only">Choose file</label>
							<input @input="formDetailInfo.photo = $event.target.files[0]" type="file" name="file-input" id="file-input" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 file:border-0 file:bg-gray-100 file:me-4 file:py-3 file:px-4">
						</div>
					</div>
					<div id="tabs-with-underline-2" class="hidden" role="tabpanel">
						<div class="grid grid-cols-2 gap-3">
							<AdminFormInput class="mb-4" v-model="formDetailInfo.administrativePosition" :placeholder="'Административная должность'" />
							<AdminFormInput class="mb-4" v-model="formDetailInfo.educatorPosition" :placeholder="'Преподовательская должность'" />
						</div>
					</div>
					<div id="tabs-with-underline-3" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.education" :placeholder="'Направление подготовки'" />
					</div>
					<div id="tabs-with-underline-4" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.awards" :placeholder="'Награды'" />
					</div>
					<div id="tabs-with-underline-5" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.professDisciplines" :placeholder="'Преподаваемые дисциплины'" />
					</div>
					<div id="tabs-with-underline-6" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.professionalRetraining" :placeholder="'Данные о профессиональной переподготовке'" />
					</div>
					<div id="tabs-with-underline-7" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.professionalDevelopment" :placeholder="'Данные о повышении квалификации'" />
					</div>
					<div id="tabs-with-underline-8" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.workExperience" :placeholder="'Стаж работы'" />
					</div>
					<div id="tabs-with-underline-9" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.attendedConferences" :placeholder="'Участие в конференциях'" />
					</div>
					<div id="tabs-with-underline-10" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.participationScienceProjects" :placeholder="'Участие в научных проектах'" />
					</div>
					<div id="tabs-with-underline-11" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.publications" :placeholder="'Публикации'" />
					</div>
					<div id="tabs-with-underline-12" class="hidden" role="tabpanel">
						<AdminFormInput class="mb-4" v-model="formDetailInfo.trainingAids" :placeholder="'Учебники и учебные пособия'" />
					</div>
				</div>
				<AdminFormButton v-bind="$attrs" type="submit" :title="'Обновить информацию'" />

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
    name: "Edit",
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
		'userDetail',
    ],
    data() {
        return {
			formDetailInfo: this.$inertia.form({
				_method: 'patch',
				name: this.userDetail.name,
				surname: this.userDetail.surname,
				middleName: this.userDetail.middleName,
				photo: null,
				academicTitle: this.userDetail.academicTitle,
				administrativePosition: this.userDetail.administrativePosition,
				educatorPosition: this.userDetail.educatorPosition,
				education: this.userDetail.education,
				awards: this.userDetail.awards,
				professDisciplines: this.userDetail.professDisciplines,
				professionalRetraining: this.userDetail.professionalRetraining,
				professionalDevelopment: this.userDetail.professionalDevelopment,
				workExperience: this.userDetail.workExperience,
				attendedConferences: this.userDetail.attendedConferences,
				participationScienceProjects: this.userDetail.participationScienceProjects,
				publications: this.userDetail.publications,
				trainingAids: this.userDetail.trainingAids,
				contactEmail: this.userDetail.contactEmail,
				contactPhone: this.userDetail.contactPhone
			}),
        }
    },
    methods: {
		update() {
			this.formDetailInfo.post(route('admin.userDetail.update', this.userDetail.id))
		},
    },


}
</script>


<style scoped>

</style>
