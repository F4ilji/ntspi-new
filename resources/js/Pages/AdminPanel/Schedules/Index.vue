<template>
	<AdminLayout>
		<AdminIndexLayout>
			<AdminIndexHeader>
				<AdminIndexHeaderTitle :title="'Все категории'"/>
				<AdminIndexSearch/>
				<AdminIndexFilter/>
			</AdminIndexHeader>
			<AdminIndexTable>
				<AdminIndexTableHead>
					<AdminIndexTableRow :name="'ID'"/>
					<AdminIndexTableRow :name="'Название'"/>
					<AdminIndexTableRow :name="'Вложенное расписание'"/>
					<AdminIndexTableRow :name="'Дата создания'"/>
					<th scope="col" class="px-6 py-3 text-right"></th>
				</AdminIndexTableHead>
				<AdminIndexTableBody>
					<template v-for="schedule in schedules.data">
						<tr>
							<AdminIndexTableCell :value="schedule.id"/>
							<AdminIndexTableCell :value="schedule.name" :text-limit-value="20"/>
							<AdminIndexTableCell :value="schedule.subSchedules.length"/>

							<AdminIndexTableCell :value="schedule.created_at"/>
							<AdminIndexTableButtonGroup>
								<AdminIndexTableButtonView :title="'Посмотреть'" :link="route('admin.schedule.show', schedule.id)" />
								<AdminIndexTableDropdownButton :title="'Действия'">
									<AdminIndexTableDropdownElement :title="'Удалить'" :link="route('admin.schedule.destroy', schedule.id)" :method="'delete'" />
								</AdminIndexTableDropdownButton>
							</AdminIndexTableButtonGroup>
						</tr>
					</template>
				</AdminIndexTableBody>
			</AdminIndexTable>
			<AdminIndexFooter>
				<AdminIndexSelectPerPage :item-length="schedules.data.length" />
				<AdminIndexPaginate :links="schedules.links"/>
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
        'schedules',
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
