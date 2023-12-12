<template>
	<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
		<slot />
	</table>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTable",
	components: {Link}
}
</script>

<style scoped>

</style>