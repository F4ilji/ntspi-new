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
					<AdminIndexTableRow :name="'Название'"/>
					<AdminIndexTableRow :name="'Статус'"/>
					<AdminIndexTableRow :name="'URL'"/>
					<AdminIndexTableRow :name="'Дата создания'"/>
					<th scope="col" class="px-6 py-3 text-right"></th>
				</AdminIndexTableHead>
				<AdminIndexTableBody>
					<template v-for="page in pages.data">
						<tr>
							<AdminIndexTableCell :value="page.id"/>
							<AdminIndexTableCell :value="page.title"/>
							<AdminIndexPageStateBadge :code="page.code" />
							<AdminIndexTableCell :value="page.path"/>
							<AdminIndexTableCell :value="page.created_at"/>

							<AdminIndexTableButtonGroup>
								<AdminIndexTableButtonView :title="'Посмотреть'" :link="page.path" />

								<AdminIndexTableDropdownButton :title="'Действия'">
									<AdminIndexTableDropdownElement :title="'Обновить'" :link="route('admin.registered.page.edit', page.id)" :method="'get'" />
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
import AdminIndexTableDropdownElement from "@/Components/AdminIndexTableDropdownElement.vue";
import AdminIndexHeader from "@/Components/AdminIndexHeader.vue";
import AdminIndexPaginate from "@/Components/AdminIndexPaginate.vue";
import AdminIndexSelectPerPage from "@/Components/AdminIndexSelectPerPage.vue";
import AdminIndexTableButtonGroup from "@/Components/AdminIndexTableButtonGroup.vue";
import AdminIndexHeaderTitle from "@/Components/AdminIndexHeaderTitle.vue";
import AdminIndexFilter from "@/Components/AdminIndexFilter.vue";
import AdminIndexTable from "@/Components/AdminIndexTable.vue";
import AdminIndexTableButtonView from "@/Components/AdminIndexTableButtonView.vue";
import AdminIndexPageStateBadge from "@/Components/AdminIndexPageStateBadge.vue";
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
            perPage: this.$page.props.pages.data.length,
            searchInput: this.$page.props.filters,
        }
    },
    methods: {
        deletePost(postId) {
            this.$inertia.delete(route('post.delete', postId))
        },
        textLimit(text, symbols) {
            if (text.length > symbols) {
                let LimitedText
                LimitedText = text.substring(0, symbols)
                return LimitedText + "..."
            }
            return text
        },
        updatePerPage() {
            this.$inertia.reload({
                method: 'get',
                data: {
                    perPage: this.perPage
                },
            })
        },
        search: debounce(function() {
            this.$inertia.reload({
                method: 'get',
                data: {
                    search: this.searchInput,
                },
                preserveState: true,
                replace: true,
            });
        }, 500),
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
		AdminIndexPageStateBadge,
		AdminIndexTableButtonView,
		AdminIndexTable,
		AdminIndexFilter,
		AdminIndexHeaderTitle,
		AdminIndexTableButtonGroup,
		AdminIndexSelectPerPage,
		AdminIndexPaginate,
		AdminIndexHeader,
		AdminIndexTableDropdownElement,
        AdminLayout,
        Link,
    },

}
</script>


<style scoped>

</style>
