<script>
export default {
	name: "AdminFormTextarea",
	props: [
		'modelValue',
		'error',
		'label'
	]
}
</script>

<template>
	<div class="mb-4">
		<label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ label }}</label>
		<textarea :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
		<p v-if="error" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ error }}</p>
	</div>
</template>

<style scoped>

</style>