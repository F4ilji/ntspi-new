<template>
	<thead class="bg-gray-50 dark:bg-slate-800">
		<tr>
			<slot />
		</tr>
	</thead>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableHead",
	components: {Link}
}
</script>

<style scoped>

</style>