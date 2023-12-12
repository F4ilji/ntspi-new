<template>
	<Link class="flex w-full items-center gap-x-3 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
		  :href="link" :method="method" as="button" type="button">

		{{ title }}
	</Link>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableDropdownElement",
	components: {Link},
	props: [
		'title',
		'link',
		'method'
	]
}
</script>
<style scoped>

</style>