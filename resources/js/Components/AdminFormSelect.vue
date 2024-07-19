<script>
export default {
	name: "AdminFormSelect",
	props: [
		'modelValue',
		'items',
		'required'
	],
}
</script>

<template>
<div>
	<select v-if="items" :required="this.required" :value="modelValue" @change="$emit('update:modelValue', $event.target.value)" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
		<slot />
		<template v-for="item in items.data" :key="item.id">
			<option :value="item.id">{{ item.title }}</option>
		</template>
	</select>
</div>
</template>

<style scoped>

</style>