<template>

	<td class="h-px w-px whitespace-nowrap">
		<div class="px-6 py-1.5 flex justify-end">
			<div class="group inline-flex items-center divide-x divide-gray-300 border border-gray-300 bg-white shadow-sm rounded-md transition-all dark:divide-gray-700 dark:bg-slate-700 dark:border-gray-700">
				<slot />
			</div>
		</div>
	</td>

</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableButtonGroup",
	components: {Link}
}
</script>
<style scoped>

</style>