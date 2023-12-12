<template>
	<AdminLayout>
		<AdminIndexLayout>
			<AdminIndexHeader>
				<AdminIndexHeaderTitle :title="'Все новости'"/>
				<AdminIndexSearch/>
				<AdminIndexFilter/>
			</AdminIndexHeader>
			<AdminIndexTable>
				<AdminIndexTableHead>
					<AdminIndexTableRow :name="'ID'"/>
					<AdminIndexTableRow :name="'Заголовок'"/>
					<AdminIndexTableRow :name="'Статус публикации'"/>
					<AdminIndexTableRow :name="'Автор'"/>
					<AdminIndexTableRow :name="'Дата создания'"/>
					<th scope="col" class="px-6 py-3 text-right"></th>
				</AdminIndexTableHead>
				<AdminIndexTableBody>
					<template v-for="post in posts.data">
						<tr>
							<AdminIndexTableCell :value="post.id"/>
							<AdminIndexTableCell :value="post.title" :text-limit-value="20"/>
							<AdminIndexTableCellisPublished :value="post.is_published"/>
							<AdminIndexTableCell :value="post.authors[0].name" :text-limit-value="20"/>
							<AdminIndexTableCell :value="post.created_post"/>
							<AdminIndexTableButtonGroup>
								<AdminIndexTableButtonView :title="'Посмотреть'" :link="route('client.post.show', post.slug)" />
								<AdminIndexTableDropdownButton :title="'Действия'">
									<AdminIndexTableDropdownElement :title="'Обновить'" :link="route('admin.post.edit', post.id)" :method="'get'" />
									<AdminIndexTableDropdownElement :title="'Удалить'" :link="route('admin.post.destroy', post.id)" :method="'delete'" />
								</AdminIndexTableDropdownButton>
							</AdminIndexTableButtonGroup>
						</tr>
					</template>
				</AdminIndexTableBody>
			</AdminIndexTable>
			<AdminIndexFooter>
				<AdminIndexSelectPerPage :item-length="this.$page.props.posts.data.length" />
				<AdminIndexPaginate :links="this.posts.links"/>
			</AdminIndexFooter>
		</AdminIndexLayout>
	</AdminLayout>
</template>

<script>


import AdminLayout from "@/Layouts/AdminLayout.vue";
import AdminIndexLayout from "@/Components/AdminIndexLayout.vue";
import AdminIndexHeader from "@/Components/AdminIndexHeader.vue";
import AdminIndexHeaderTitle from "@/Components/AdminIndexHeaderTitle.vue";
import AdminIndexSearch from "@/Components/AdminIndexSearch.vue";
import AdminIndexFilter from "@/Components/AdminIndexFilter.vue";
import AdminIndexTable from "@/Components/AdminIndexTable.vue";
import AdminIndexTableHead from "@/Components/AdminIndexTableHead.vue";
import AdminIndexTableRow from "@/Components/AdminIndexTableRow.vue";
import AdminIndexTableBody from "@/Components/AdminIndexTableBody.vue";
import AdminIndexFooter from "@/Components/AdminIndexFooter.vue";
import AdminIndexSelectPerPage from "@/Components/AdminIndexSelectPerPage.vue";
import AdminIndexPaginate from "@/Components/AdminIndexPaginate.vue";
import AdminIndexTableCell from "@/Components/AdminIndexTableCell.vue";
import AdminIndexTableCellisPublished from "@/Components/AdminIndexTableCellisPublished.vue";
import {Link} from "@inertiajs/vue3";
import AdminIndexTableButtonGroup from "@/Components/AdminIndexTableButtonGroup.vue";
import AdminIndexTableButtonView from "@/Components/AdminIndexTableButtonView.vue";
import AdminIndexTableDropdownButton from "@/Components/AdminIndexTableDropdownButton.vue";
import AdminIndexTableDropdownElement from "@/Components/AdminIndexTableDropdownElement.vue";

export default {
	name: "Index",
	data() {
		return {
			userData: this.$page.props.auth.user,
		}
	},
	methods: {
		deletePost(postId) {
			this.$inertia.delete(route('post.delete', postId))
		},

	},
	props: [
		'posts',
		'filters'
	],
	components: {
		AdminIndexTableDropdownElement,
		AdminIndexTableDropdownButton,
		AdminIndexTableButtonView,
		AdminIndexTableButtonGroup,
		AdminIndexTableCellisPublished,
		AdminIndexTableCell,
		AdminIndexPaginate,
		AdminIndexSelectPerPage,
		AdminIndexFooter,
		AdminIndexTableBody,
		AdminIndexTableRow,
		AdminIndexTableHead,
		AdminIndexTable,
		AdminIndexFilter,
		AdminIndexSearch,
		AdminIndexHeaderTitle,
		AdminIndexHeader,
		AdminIndexLayout,
		AdminLayout,
		Link

	},

}
</script>


<style scoped>

</style>
