<template>
	<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
		<!-- Card -->
		<div class="flex flex-col">
			<div class="-m-1.5 overflow-x-auto">
				<div class="p-1.5 min-w-full inline-block align-middle">
					<div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
						<slot />
					</div>
				</div>
			</div>
		</div>
		<!-- End Card -->
	</div>

</template>

<script>

export default {
	name: "AdminIndexLayout"
}</script>

<style scoped>

</style>