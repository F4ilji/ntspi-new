<template>
	<td class="h-px w-px whitespace-nowrap">
		<div class="px-6 py-2">
			<span v-if="value"
						class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" width="16"
																										 height="16"
																										 fill="currentColor" viewBox="0 0 16 16">
                                                    <path
																												d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                </svg>
                                                Онлайн
                                            </span>
			<span v-if="!value"
						class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-green-200">
                                                    <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg"
																												 width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                        <path
																														d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
                                                    </svg>
                                                    Оффлайн
                                                </span>
		</div>
	</td>

</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableCellisOnlined",
	components: {Link},
	props: ['value', 'textLimitValue'],
	methods: {
		textLimit(text, symbols) {
			if (text.length > symbols) {
				let LimitedText
				LimitedText = text.substring(0, symbols)
				return LimitedText + "..."
			}
			return text
		},

	}
}
</script>

<style scoped>

</style>