<template>
	<AdminLayout>
		<AdminIndexLayout>
			<AdminIndexHeader>
				<AdminIndexHeaderTitle :title="'Все факультеты'"/>
				<AdminIndexSearch/>
				<AdminIndexFilter/>
			</AdminIndexHeader>
			<AdminIndexTable>
				<AdminIndexTableHead>
					<AdminIndexTableRow :name="'ID'"/>
					<AdminIndexTableRow :name="'Название'"/>
					<AdminIndexTableRow :name="'Дата создания'"/>
					<th scope="col" class="px-6 py-3 text-right"></th>
				</AdminIndexTableHead>
				<AdminIndexTableBody>
					<template v-for="faculty in faculties.data">
						<tr>
							<AdminIndexTableCell :value="faculty.id"/>
							<AdminIndexTableCell :value="faculty.title" :text-limit-value="20"/>
							<AdminIndexTableCell :value="faculty.created_at"/>
							<AdminIndexTableButtonGroup>
								<AdminIndexTableDropdownButton :title="'Действия'">
									<AdminIndexTableDropdownElement :title="'Обновить'" :link="route('admin.faculty.edit', faculty.id)" :method="'get'" />
									<AdminIndexTableDropdownElement :title="'Удалить'" :link="route('admin.faculty.destroy', faculty.id)" :method="'delete'" />
								</AdminIndexTableDropdownButton>
							</AdminIndexTableButtonGroup>
						</tr>
					</template>
				</AdminIndexTableBody>
			</AdminIndexTable>
			<AdminIndexFooter>
				<AdminIndexSelectPerPage :item-length="this.faculties.data.length" />
				<AdminIndexPaginate v-if="this.faculties.links" :links="this.faculties.links"/>
			</AdminIndexFooter>
		</AdminIndexLayout>
	</AdminLayout>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {debounce} from "lodash/function.js";
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
        'faculties',
        'filters'
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
        AdminLayout,
        Link,
    }
}
</script>


<style scoped>

</style>
