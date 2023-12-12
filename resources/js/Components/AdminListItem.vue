<template>
	<li class="hs-accordion" id="posts-accordion">
		<span class="hs-accordion-toggle select-none cursor-default flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white"
			  href="javascript:;">
<!--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"-->
			<!--							 stroke="currentColor" class="w-3.5 h-3.5">-->
			<!--                            <path stroke-linecap="round" stroke-linejoin="round"-->
			<!--								  d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>-->
			<!--                        </svg>-->
                        {{ title }}
                        <svg class="hs-accordion-active:block ml-auto hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
							 width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 11L8.16086 5.31305C8.35239 5.13625 8.64761 5.13625 8.83914 5.31305L15 11"
								  stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                        <svg class="hs-accordion-active:hidden ml-auto block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
							 width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
								  stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                    </span>
		<div id="account-accordion-sub"
			 class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
			<ul class="pt-2 pl-2">
				<slot/>
			</ul>
		</div>
	</li>
</template>

<script>

export default {
	data() {
		return []
	},
	props: [
		'title',
	]
}
</script>

<style scoped>

</style>