<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import {debounce} from "lodash/function.js";
import {Link} from "@inertiajs/vue3";


export default {
	name: "Show",
	data() {
		return {
			weekdayFull: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
			weekday: ['ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
			timeSchedules: ['09:00 - 10:35', '10:55 - 12:30', '13:00 - 14:35', '14:45 - 16:20', '16:30 - 18:00']
		}
	},
	components: {ClientFooterDown, MainNavbar, Link},
	props: [
		'schedule',
		'searchRequest',
		'navigation',
	],
	methods: {
		getEndTime(timeString) {
			const [start, end] = timeString.split(' - ');
			const [hours, minutes] = end.split(':');
			const hoursInt = parseInt(hours);
			const minutesInt = parseInt(minutes);
			const date = new Date();
			date.setHours(hoursInt);
			date.setMinutes(minutesInt);
			return date;
		},
		generateDayTitle(dayId) {
			const today = new Date();
			const todayDayOfWeek = today.getDay() - 1;
			let title;
			if (todayDayOfWeek === dayId) {
				title = "Cегодня"
			} else if(todayDayOfWeek + 1 === dayId) {
				title = "Завтра"
			} else {
				title = this.weekdayFull[dayId]
			}
			return title;
		}
	},
	computed: {
		getDayOfWeek() {
			const today = new Date();
			const todayDayOfWeek = today.getDay() - 1;
			let scheduleDay;
			let currentDay;
			let todaySchedule = this.schedule.days[todayDayOfWeek];
			if (todaySchedule === undefined) {
				scheduleDay = this.schedule.days[0];
				currentDay = 0;
				return {
					'title': this.generateDayTitle(currentDay),
					'scheduleDay': scheduleDay,
				}
			}
			if (this.getEndTime(this.timeSchedules[todaySchedule.form.length - 1]) < today) {
				scheduleDay = this.schedule.days[todayDayOfWeek + 1];
				currentDay = todayDayOfWeek + 1;
			} else {
				scheduleDay = this.schedule.days[todayDayOfWeek];
				currentDay = todayDayOfWeek;
			}

			return {
				'title': this.generateDayTitle(currentDay),
				'scheduleDay': scheduleDay,
			}
		}
	}

}
</script>

<template>
	<MainNavbar class="border-b" :sections="$page.props.navigation"></MainNavbar>

	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<article class="w-full min-w-0 mt-4 px-1 md:px-6">
			<div class="relative overflow-hidden">
				<div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-5">
					<div class="text-center">
						<h1 class="text-2xl sm:text-4xl font-bold text-gray-800 dark:text-gray-200">
							Расписание занятий
						</h1>

						<div class="text-center">
							<p class="mt-1 text-gray-600 dark:text-neutral-400">{{ schedule.title }}</p>
						</div>


						<div class="mt-7 sm:mt-12 mx-auto max-w-xl relative">

							<div class="border-b border-gray-200 px-4">
								<nav class="flex space-x-2 justify-center" aria-label="Tabs" role="tablist">
									<button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none active" id="basic-tabs-item-1" data-hs-tab="#basic-tabs-1" aria-controls="basic-tabs-1" role="tab">
										Расписание на {{ getDayOfWeek.title }}
									</button>
									<button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none" id="basic-tabs-item-2" data-hs-tab="#basic-tabs-2" aria-controls="basic-tabs-2" role="tab">
										Расписание на неделю
									</button>
								</nav>
							</div>



						</div>
					</div>
				</div>
			</div>


			<div class="mx-auto max-w-4xl hs-accordion-group gap-3">

				<div id="basic-tabs-1" role="tabpanel" aria-labelledby="basic-tabs-item-1">
						<table class="border-collapse rounded-xl border w-full mb-4">
							<tbody>
							<tr>
								<td class="text-center border px-3">#</td>
								<td class="text-center border" width="20%">Время</td>
								<td class="text-center border" colspan="3">Предмет</td>
							</tr>
							<template v-for="(lesson, index) in getDayOfWeek.scheduleDay.form">
								<tr>
									<td class="border text-center">{{ index + 1 }}</td>
									<td class="border text-center">{{ this.timeSchedules[index] }}</td>
									<td class="text-center border">
										<template v-for="lesson_info in lesson">
											<div class="flex items-stretch justify-center">
												<template v-for="firstWeek in lesson_info[0]">
													<template v-for="(couple, index) in firstWeek">
														<div class="flex" :class="{'border-l': index === 1, 'w-1/2': Object.keys(firstWeek).length === 2,}">
															<p class="my-auto text-center px-2 py-1">{{ couple.title }} {{ couple.teacher }} <i>{{ couple.studyRoom }}</i></p>
														</div>
													</template>
												</template>
											</div>
											<div v-if="lesson_info[1]" class="flex border-t justify-center">
												<template v-for="firstWeek in lesson_info[1]">
													<template v-for="(couple, index) in firstWeek">
														<div class="flex justify-center" :class="{'border-l': index === 1, 'w-1/2': Object.keys(firstWeek).length === 2}">
															<p class="my-auto text-center px-2 py-1">{{ couple.title }} {{ couple.teacher }} <i>{{ couple.studyRoom }}</i></p>
															<p class="unselectable text-center opacity-0" v-if="couple.title === null">-------------------- <br>
																---------</p>
														</div>
													</template>
												</template>
											</div>
										</template>
									</td>
								</tr>
							</template>







							</tbody>
						</table>
				</div>
				<div id="basic-tabs-2" class="hidden" role="tabpanel" aria-labelledby="basic-tabs-item-2">
					<template v-for="(day, index) in schedule.days">
						<table class="border-collapse border w-full mb-4">
							<tbody>
							<tr>
								<td class="text-center" rowspan="9" width="30px">{{ this.weekday[index] }}</td>
							</tr>
							<tr>
								<td class="text-center border  px-3">#</td>
								<td class="text-center border" width="20%">Время</td>
								<td class="text-center border" colspan="3">Предмет</td>
							</tr>
							<template v-for="(lesson, index) in day.form">
								<tr>
									<td class="border text-center">{{ index + 1 }}</td>
									<td class="border text-center">{{ this.timeSchedules[index] }}</td>
									<td class="text-center border">
										<template v-for="lesson_info in lesson">
											<div class="flex items-stretch justify-center">
												<template v-for="firstWeek in lesson_info[0]">
													<template v-for="(couple, index) in firstWeek">
														<div class="flex" :class="{'border-l': index === 1, 'w-1/2': Object.keys(firstWeek).length === 2,}">
															<p class="my-auto text-center px-2 py-1">{{ couple.title }} {{ couple.teacher }} <i>{{ couple.studyRoom }}</i></p>
														</div>
													</template>
												</template>
											</div>
											<div v-if="lesson_info[1]" class="flex border-t justify-center">
												<template v-for="firstWeek in lesson_info[1]">
													<template v-for="(couple, index) in firstWeek">
														<div class="flex justify-center" :class="{'border-l': index === 1, 'w-1/2': Object.keys(firstWeek).length === 2}">
															<p class="my-auto text-center px-2 py-1">{{ couple.title }} {{ couple.teacher }} <i>{{ couple.studyRoom }}</i></p>
															<p class="unselectable text-center opacity-0" v-if="couple.title === null">-------------------- <br>
																---------</p>
														</div>
													</template>
												</template>
											</div>
										</template>
									</td>
								</tr>
							</template>







							</tbody>
						</table>
						<hr class="py-2">
					</template>
				</div>
				<div id="basic-tabs-3" class="hidden" role="tabpanel" aria-labelledby="basic-tabs-item-3">

				</div>



			</div>
		</article>
	</div>


	<ClientFooterDown style="margin-top: 300px;"/>
</template>

<style scoped>


.unselectable {
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
.fade-enter-active,
.fade-leave-active {
	transition: all 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
	transform: translateY(30px);
}

.gg-enter-active,
.gg-leave-active {
	transition: all 0.5s ease;
}

.gg-enter-from,
.gg-leave-to {
	opacity: 0;
	transform: translateY(30px);
}
</style>