<template>
	<div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
		<button id="hs-table-dropdown-1" type="button"
				class="hs-dropdown-toggle py-1.5 px-2 inline-flex justify-center items-center gap-2 rounded-r-md text-gray-700 align-middle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
			<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
				 width="16" height="16" fill="currentColor"
				 viewBox="0 0 16 16">
				<path
						d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
			</svg>
		</button>
		<div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mt-2 divide-y divide-gray-200 min-w-[10rem] z-10 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-gray-700 dark:bg-gray-800 dark:border dark:border-gray-700" aria-labelledby="hs-table-dropdown-1">
			<div class="py-2 first:pt-0 last:pb-0">
				<span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-gray-600">
					{{ title }}
				</span>
				<slot />
			</div>
		</div>
	</div>

</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableDropdownButton",
	components: {Link},
	props: [
		'title'
	]
}
</script>
<style scoped>

</style>