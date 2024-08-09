<template>
	<div class="relative z-0 min-h-[calc(100vh)] items-center">


		<div class="absolute -z-10 h-full w-full before:absolute before:z-10 before:h-full before:w-full before:bg-black/30">
			<img
					alt="Thumbnail"
					loading="eager"
					decoding="async"
					data-nimg="fill"
					class="object-cover brightness-[0.7] transition-opacity duration-1000"
					sizes="100vw"
					v-for="(slider, index) in slidersCarousel.data"
					:key="index"
					:src="'/storage/' + slider.image"
					:class="{ 'opacity-1': currentIndex === index, 'opacity-0': currentIndex !== index }"
					style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;"
			/>
		</div>
		<div :class="{ 'block': currentIndex === index, 'hidden': currentIndex !== index }" v-for="(item, index) in slidersCarousel.data" :key="index" class="mx-auto max-w-screen-md px-5 pt-[150px] pb-0">
			<h1 class="text-brand-primary mb-3 mt-2 text-3xl font-semibold tracking-tight text-white lg:text-5xl lg:leading-tight">
				{{ item.title }}
			</h1>
			<div class="mt-8 flex space-x-3 text-gray-500 mb-8">
				<div class="flex flex-col gap-3 md:flex-row md:items-center">
					<div class="flex gap-3">
						<p class="text-gray-100 line-clamp-3"><a href="/author/erika-oliver">{{ item.content }}</a></p>
					</div>
				</div>
			</div>
			<a :href="item.link" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-white text-white hover:border-white/70 hover:text-white/70 disabled:opacity-50 disabled:pointer-events-none">
				{{ item.link_text }}
			</a>
		</div>


		<div v-if="slidersCarousel.data.length >= 2" class="mx-auto max-w-screen-md px-5">
			<div class="mt-8 text-gray-500 text-white absolute bottom-[100px]">
				<div class="">
					<div class="flex space-x-3 items-center justify-between">
						<button @click="prev" class="bg-gray-200 w-8 h-8 hover:bg-gray-300 text-gray-800 font-bold rounded-full">
							<svg class="w-4 h-4 mx-auto my-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
							</svg>
						</button>



						<div class="flex space-x-3 w-[100px] items-center font-semibold text-xl">
							<span>{{ this.currentIndex + 1 }}</span>
							<div class="flex w-full h-1 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700 " role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
								<div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500 my-slider-progress-bar" :style="{ 'width': `${percentage}%` }"></div>
							</div>
							<span> {{ slidersCarousel.data.length }}</span>
						</div>


						<button @click="next" class="bg-gray-200 w-8 h-8 hover:bg-gray-300 text-gray-800 font-bold rounded-full">
							<svg class="w-4 h-4 mx-auto my-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
import {Link} from "@inertiajs/vue3";

export default {
	name: 'slider',
	components: {Link},
	props: {
		slidersCarousel: {
			type: Object,
		},
	},
	data() {
		return {
			currentIndex: 0,
			percentage: 0,
			intervalId: null,
		}
	},
	methods: {
		next() {
			this.currentIndex = (this.currentIndex + 1) % this.slidersCarousel.data.length
			this.resetTimer()
		},
		prev() {
			this.currentIndex = (this.currentIndex - 1 + this.slidersCarousel.data.length) % this.slidersCarousel.data.length
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
