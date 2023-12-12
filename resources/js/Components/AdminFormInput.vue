<script>
export default {
	name: "AdminFormInput",
	data() {
		return {
			'uniq': (Math.random().toString(36)),
		}
	},
	props: {
		modelValue: {
		},
		error: {
			type: Array
		},
		placeholder: {
			default: '',
			type: String
		},
		disable: {
			default: false,
			type: Boolean
		},
		type: {
			default: 'text',
			type: String
		},
		required: {
			default: false,
			type: Boolean
		}
	}
}
</script>

<template>
	<div>
		<div class="relative">
			<input :disabled="disable" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :required="this.required" autocomplete="off" :type="this.type" :id="'floating_' + this.uniq"
				   :class="{'border-red-600 dark:border-red-500 transition-colors duration-500': error}"
				   class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
				   placeholder=" " />
			<label :for="'floating_' + this.uniq"
				   :class="{'text-red-600 dark:text-red-500 transition-colors duration-500': error}"
				   class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">{{ placeholder }}</label>
		</div>
		<p v-if="error" id="outlined_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">{{ error }}</p>
	</div>
</template>

<style scoped>

</style>