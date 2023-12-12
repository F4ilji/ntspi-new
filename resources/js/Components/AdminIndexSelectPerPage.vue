<template>
	<div class="max-w-sm space-y-3">
		<select v-model="perPage" v-on:change="updatePerPage"
				class="py-2 px-3 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option selected>9</option>
			<option>20</option>
		</select>
	</div>

</template>

<script>


export default {
	name: "AdminIndexSelectPerPage",
	data() {
		return {
			perPage: this.itemLength,
		}
	},
	methods: {
		updatePerPage() {
			this.$inertia.reload({
				method: 'get',
				data: {
					perPage: this.perPage
				},
			})
		},
	},
	components: {
	},
	props: [
		'itemLength'
	]

}


</script>

<style scoped>

</style>