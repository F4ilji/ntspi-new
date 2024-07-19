<template>
	<div class="relative rounded-xl overflow-auto">
		<div class="max-w-4xl mx-auto bg-white min-w-0">
			<div class="overflow-x-scroll flex no-scrollbar">
				<div class="flex items-center gap-x-3 whitespace-nowrap">
					<template v-for="eventMonth in dates">
						<div class="">
							<div class="flex flex-col items-center">
								<!--							<span class="text-[12px] text-gray-500">|</span>-->
								<span class="text-[12px] text-gray-500">{{ eventMonth.month }}</span>
							</div>
							<div class="flex">
								<div class="flex">
									<template v-for="eventDate in eventMonth.events">
										<div class="flex flex-col items-center">
											<button :class="date == eventDate.date ? 'active-button' : ''" @click="filter(eventDate.date)" type="button" class="min-h-[38px] duration-300 ease-linear min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">{{ eventDate.day }}</button>
											<span class="text-[12px] text-gray-500">{{ eventDate.dayOfWeek }}</span>
										</div>
									</template>
								</div>
							</div>
						</div>
					</template>
				</div>
			</div>
		</div>
	</div>

</template>

<script>

export default {
	name: "ClientEventSelectDate",
	data() {
		return {
			date: this.currentDate,
		}
	},
	methods: {
		filter(eventDate) {
			this.date = eventDate
			this.$inertia.reload( {
				data: {
					date: eventDate,
				},
			});
		},
	},

	props: {
		dates: {
			type: Array,
		},
		currentDate: {
			type: String,
		},
	},
}
</script>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
	display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
	-ms-overflow-style: none;  /* IE and Edge */
	scrollbar-width: none;  /* Firefox */
}

.active-button {
	@apply bg-blue-600 text-white;
}

</style>