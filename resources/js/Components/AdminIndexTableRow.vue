<template>
	<th scope="col" class="pl-6 py-3 text-left">
		<div class="flex items-center gap-x-2">
			<span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
				{{ name }}
			</span>
		</div>
	</th>

</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableRow",
	components: {Link},
	props: ['name']
}
</script>

<style scoped>

</style>