<template>
	<td class="h-px w-px whitespace-nowrap">
		<div class="px-6 py-2">
			<div class="flex items-center gap-x-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">
					{{ value != null ? textLimit(value, textLimitValue) : '' }}
				</span>
			</div>
		</div>
	</td>

</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
	name: "AdminIndexTableCell",
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