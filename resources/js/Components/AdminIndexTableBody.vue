<template>
	<tbody class="divide-y divide-gray-200 dark:divide-gray-700">
		<slot />
	</tbody>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableBody",
	components: {Link}
}
</script>

<style scoped>

</style>