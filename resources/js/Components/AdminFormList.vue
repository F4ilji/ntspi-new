<script>
export default {
	name: "AdminFormList",
	props: [
		'label',
		'items',
		'checked_ids'
	],
	data() {
		return {
			selectedItems: this.checked_ids ? this.checked_ids : [],
		}
	},
	methods: {
		handleData() {
			setTimeout(() => {
				this.$emit('get-data', this.selectedItems)
			}, 10);

		}
	}
}
</script>

<template>
	<div>
		<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">{{ label }}</label>
		<ul class="max-w-sm flex flex-col">
			<template v-for="item in items">
				<li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
					<div class="relative flex items-start w-full">
						<div class="flex items-center h-5">
							<input :id="item.id" type="checkbox"
									class="border-gray-200 rounded disabled:opacity-50 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
									v-model="selectedItems"
									:value="item.id"
									@input="handleData"
								   checked
							>
						</div>
						<label :for="item.id" class="ms-3.5 block w-full text-sm text-gray-600 dark:text-gray-500">
							{{ item.title }}
						</label>
					</div>
				</li>
			</template>
		</ul>
	</div>
</template>


<style scoped>

</style>