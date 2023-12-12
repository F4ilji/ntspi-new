<script>
export default {
	name: "AdminFormHeader",
	props: [
		'title'
	]
}
</script>

<template>
	<div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
		<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
			{{ title }}
		</h3>
	</div>
</template>

<style scoped>

</style>