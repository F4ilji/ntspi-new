<template>
	<div class="hs-tooltip inline-block">
		<Link class="hs-tooltip-toggle py-1.5 px-2 inline-flex justify-center items-center gap-2 rounded-l-md bg-white text-gray-700 align-middle focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
			  :href="link">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
				 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
				<path stroke-linecap="round" stroke-linejoin="round"
					  d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
				<path stroke-linecap="round" stroke-linejoin="round"
					  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
			</svg>

			<span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-sm dark:bg-slate-700"
				  role="tooltip">
				{{ title }}
			</span>
		</Link>
	</div>

</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableButtonView",
	components: {Link},
	props: [
		'title',
		'link'
	]
}
</script>
<style scoped>

</style>