<template>
	<li>
		<Link :href="route(routeName)"
			  class="flex select-none cursor-default items-center gap-x-2 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300">
			{{ title }}
		</Link>
	</li>

</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	data() {
		return [

		]
	},
	props: [
		'title',
		'routeName'
	],
	components: {
		Link,
	}
}
</script>

<style scoped>

</style>