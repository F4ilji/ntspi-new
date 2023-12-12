<template>
	<div>
		<h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
			{{ title }}
		</h2>
	</div>
</template>

<script>
export default {
	name: "AdminIndexHeaderTitle",
	props: [
		'title'
	]

}
</script>

<style scoped>

</style>