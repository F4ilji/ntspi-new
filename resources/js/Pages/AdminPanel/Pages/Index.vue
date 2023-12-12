<template>
	<AdminLayout>
		<AdminIndexLayout>
			<AdminIndexHeader>
				<AdminIndexHeaderTitle :title="'Все страницы'"/>
				<AdminIndexSearch/>
				<AdminIndexFilter/>
			</AdminIndexHeader>
			<AdminIndexTable>
				<AdminIndexTableHead>
					<AdminIndexTableRow :name="'ID'"/>
					<AdminIndexTableRow :name="'Заголовок'"/>
					<AdminIndexTableRow :name="'Slug'"/>
					<AdminIndexTableRow :name="'Код страницы'"/>
					<AdminIndexTableRow :name="'Путь'"/>
					<AdminIndexTableRow :name="'Раздел'"/>
					<AdminIndexTableRow :name="'Дата создания'"/>
					<th scope="col" class="px-6 py-3 text-right"></th>
				</AdminIndexTableHead>
				<AdminIndexTableBody>
					<template v-for="page in pages.data">
						<tr>
							<AdminIndexTableCell :value="page.id"/>
							<AdminIndexTableCell :value="page.title"/>
							<AdminIndexTableCell :value="page.slug"/>
							<AdminIndexPageStateBadge :code="page.code" />
							<AdminIndexTableCell :value="page.path"/>
							<AdminIndexTableCell v-if="page.section" :value="page.section"/>
							<AdminIndexTableCell v-else :value="'нет'"/>
							<AdminIndexTableCell :value="page.created_at"/>

							<AdminIndexTableButtonGroup>
								<AdminIndexTableButtonView :title="'Посмотреть'" :link="route('page.view', page.path)" />

								<AdminIndexTableDropdownButton :title="'Действия'">
									<AdminIndexTableDropdownElement :title="'Обновить'" :link="route('admin.page.edit', page.slug)" :method="'get'" />
									<AdminIndexTableDropdownElement :title="'Удалить'" :link="route('admin.page.destroy', page.id)" :method="'delete'" />
								</AdminIndexTableDropdownButton>
							</AdminIndexTableButtonGroup>
						</tr>
					</template>
				</AdminIndexTableBody>
			</AdminIndexTable>
			<AdminIndexFooter>
				<AdminIndexSelectPerPage :item-length="this.$page.props.pages.data.length" />
				<AdminIndexPaginate :links="this.pages.links"/>
			</AdminIndexFooter>
		</AdminIndexLayout>
	</AdminLayout>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { throttle, debounce } from "lodash/function.js";
import AdminIndexPageStateBadge from "@/Components/AdminIndexPageStateBadge.vue";
import AdminIndexTableDropdownElement from "@/Components/AdminIndexTableDropdownElement.vue";
import AdminIndexHeader from "@/Components/AdminIndexHeader.vue";
import AdminIndexPaginate from "@/Components/AdminIndexPaginate.vue";
import AdminIndexSelectPerPage from "@/Components/AdminIndexSelectPerPage.vue";
import AdminIndexTableButtonGroup from "@/Components/AdminIndexTableButtonGroup.vue";
import AdminIndexTableCellisPublished from "@/Components/AdminIndexTableCellisPublished.vue";
import AdminIndexHeaderTitle from "@/Components/AdminIndexHeaderTitle.vue";
import AdminIndexFilter from "@/Components/AdminIndexFilter.vue";
import AdminIndexTable from "@/Components/AdminIndexTable.vue";
import AdminIndexTableButtonView from "@/Components/AdminIndexTableButtonView.vue";
import AdminIndexFooter from "@/Components/AdminIndexFooter.vue";
import AdminIndexSearch from "@/Components/AdminIndexSearch.vue";
import AdminIndexTableDropdownButton from "@/Components/AdminIndexTableDropdownButton.vue";
import AdminIndexTableHead from "@/Components/AdminIndexTableHead.vue";
import AdminIndexTableRow from "@/Components/AdminIndexTableRow.vue";
import AdminIndexTableCell from "@/Components/AdminIndexTableCell.vue";
import AdminIndexTableBody from "@/Components/AdminIndexTableBody.vue";
import AdminIndexLayout from "@/Components/AdminIndexLayout.vue";
export default {
    name: "Index",
    data() {
        return {
            userData: this.$page.props.auth.user,
        }
    },
    methods: {
        
    },
    props: [
        'pages',
    ],
    components: {
		AdminIndexLayout,
		AdminIndexTableBody,
		AdminIndexTableCell,
		AdminIndexTableRow,
		AdminIndexTableHead,
		AdminIndexTableDropdownButton,
		AdminIndexSearch,
		AdminIndexFooter,
		AdminIndexTableButtonView,
		AdminIndexTable,
		AdminIndexFilter,
		AdminIndexHeaderTitle,
		AdminIndexTableCellisPublished,
		AdminIndexTableButtonGroup,
		AdminIndexSelectPerPage,
		AdminIndexPaginate,
		AdminIndexHeader,
		AdminIndexTableDropdownElement,
		AdminIndexPageStateBadge,
        AdminLayout,
        Link,
    },

}
</script>


<style scoped>

</style>
