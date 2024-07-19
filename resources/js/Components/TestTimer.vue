<template>
	<div class="flex w-full h-1 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700 " role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
		<div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500" :style="{ 'width': `${percentage}%` }"></div>
	</div>
</template>

<script>
export default {
	name: 'TestTimer',
	data() {
		return {
			percentage: 0,
			intervalId: null,
		}
	},
	methods: {
		progressStatus() {
			if (this.percentage >= 100) {
				this.resetTimer()
			} else {
				this.percentage++
			}
		},
		startTimer() {
			this.intervalId = setInterval(this.progressStatus, 60)
		},
		stopTimer() {
			clearInterval(this.intervalId)
		},
		resetTimer() {
			this.percentage = 0
			this.stopTimer()
			this.startTimer()
		}
	},
	mounted() {
		this.startTimer()
	},
};
</script>
