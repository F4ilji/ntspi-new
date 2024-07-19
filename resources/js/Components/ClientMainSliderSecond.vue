<template>
	<div class="z-0 min-h-[calc(100vh-10vh)] items-center">

		<div class="flex items-center pt-[150px] px-20">
			<div :class="{ 'block': currentIndex === index, 'hidden': currentIndex !== index }" v-for="(item, index) in photos" :key="index" class="mx-auto max-w-screen-md px-5 pb-0">
				<h1 class="text-brand-primary mb-3 mt-2 text-3xl font-semibold tracking-tight text-black lg:text-5xl lg:leading-tight">
					{{ item.title }}
				</h1>
				<div class="mt-8 flex space-x-3 text-gray-500 ">
					<div class="flex flex-col gap-3 md:flex-row md:items-center">
						<div class="flex gap-3">
							<p class="text-black"><a href="/author/erika-oliver">{{ item.description }}</a></p>
						</div>
					</div>
				</div>
			</div>
			<img
					alt="Thumbnail"
					loading="eager"
					decoding="async"
					data-nimg="fill"
					class="w-[500px] h-[500px] brightness-[0.7] object-cover transition-opacity duration-1000 rounded-full"
					sizes="100vw"
					v-for="(photo, index) in photos"
					:key="index"
					:src="photo.url"
					:class="{ 'block': currentIndex === index, 'hidden': currentIndex !== index }"
					style="color: transparent;"
			/>
		</div>



		<div class="mx-auto max-w-screen-md px-5">
			<div class="mt-8 text-gray-500">
				<div class="flex space-x-3 items-center justify-between">
					<div class="flex space-x-3 w-[100px] items-center font-semibold text-xl">
						<span>{{ this.currentIndex + 1 }}</span>
						<div class="flex w-full h-1 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700 " role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
							<div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500 my-slider-progress-bar" :style="{ 'width': `${percentage}%` }"></div>
						</div>
						<span> {{ photos.length }}</span>
					</div>
					<div class="space-x-2">
						<button @click="prev" class="bg-gray-200 w-10 h-10 hover:bg-gray-300 text-gray-800 font-bold rounded-full">
							<svg class="w-6 h-6 mx-auto my-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
							</svg>
						</button>

						<button @click="next" class="bg-gray-200 w-10 h-10 hover:bg-gray-300 text-gray-800 font-bold rounded-full">
							<svg class="w-6 h-6 mx-auto my-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19l7-7-7-7"></path>
							</svg>
						</button>
					</div>
				</div>
				<!-- Progress -->
				<!-- End Progress -->
			</div>


		</div>




	</div>


</template>


<script>
import TestTimer from "@/Components/TestTimer.vue";

export default {
	name: 'sliderSecond',
	components: {TestTimer},
	data() {
		return {
			photos: [
				{
					url: 'https://www.ntspi.ru/upload/iblock/d6b/z1xKGOXRrLE.jpg',
					title: 'Студенты ФППО провели занятия для педклассов школ города',
					description: '«Учителем быть престижно!» Под таким девизом в течение трех дней (6, 7 и 10 июня) на факультете психолого-педагогического образования студенты группы Нт-203о ППП (психологический клуб «Форсайт») под руководством Марины Вячеславовны Манаковой проводили познавательные мероприятие для педагогических классов школ города (№№ 61, 44, 75/42)'
				},
				{
					url: 'https://www.ntspi.ru/upload/iblock/eaf/IMG_8259.jpg',
					title: 'Интеллектуальный турнир «Моя страна – моя Россия» для педагогических классов города!',
					description: '11 июня в читальном зале НТГСПИ на базе педагогических классов школ города (№№ 44, 75/42, 61) студенты СГФ под руководством декана Ирины Викторовны Даренской и заместителя декана Анны Саввишны Аникиной провели интеллектуальный турнир в соревновательном формате «Моя страна – моя Россия!»'
				},
				{
					url: 'https://www.ntspi.ru/upload/iblock/ee6/DSC01893.JPG',
					title: 'Филологи 20 лет спустя',
					description: 'Спустя 20 лет на ФФМК встретились выпускники 2004 г. специальности «Русский язык и литература». Приятным и волнительным для филологов было возвращение на свой «третий этаж», ставший родным за пять лет обучения в вузе. Самый трогательный момент − встреча с дорогими преподавателями, которые за прошедшие годы совсем не изменились.'
				},
				{
					url: 'https://www.ntspi.ru/upload/iblock/f04/2.jpg',
					title: 'Старт целины Штаба СО НТ – 2024',
					description: '7 мая в Городском дворце молодежи состоятся творческий старт сезона 2024 года студенческих отрядов города Нижний Тагил. Зажигательные, яркие, творческие бойцы отрядов показали свои выступления в преддверии старта сезона! Выступления отрядов, среди которых были и строительные, и педагогические, проводники и социальные отряды, были энергичными и фантастическими: торжественный выход с флагами отрядов, выступления по профилю работы, поразили выступления смешанных составов!'
				},
				{
					url: 'https://www.ntspi.ru/upload/iblock/fc9/p-dIqCDymRY.jpg',
					title: 'Студенты ФСБЖ – участники летней оздоровительной кампании – 2024',
					description: '3 июня студенты 3 курса факультета спорта и безопасности жизнедеятельности приняли участие в открытии лагеря с дневным пребыванием «Лето НТ» под девизом «Быть в движении!» Для 75 мальчишек и девчонок была подготовлена и проведена насыщенная интересными событиями программа. Открытие лагеря было посвящено Международному Дню защиты детей, где дети приняли участие в концертно-игровой программе «Планета детства».'
				},
			],
			currentIndex: 0,
			percentage: 0,
			intervalId: null,
		}
	},
	methods: {
		next() {
			this.currentIndex = (this.currentIndex + 1) % this.photos.length
			this.resetTimer()
		},
		prev() {
			this.currentIndex = (this.currentIndex - 1 + this.photos.length) % this.photos.length
			this.resetTimer()
		},
		progressStatus() {
			if (this.percentage >= 100) {
				this.resetTimer()
				this.next()
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
}
</script>

<style>

.fade-enter-active,
.fade-leave-active {
	transition: all 0.5s ease;
}

.my-slider-progress-bar {
	transition: width 60ms ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
	transform: translateY(30px);
}

</style>
