<script>
export default {
	name: "Index",
	props: {
		persons: {
			type: Array
		}
	}
}
</script>

<template>
	<h1>{{ this.persons }}</h1>
</template>

<style scoped>

</style>