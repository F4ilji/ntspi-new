<template>
	<Head>
		<title>Главная</title>
		<meta name="description" content="Your page description">

	</Head>
	<MainPageNavBar :sections="this.navigation"></MainPageNavBar>
	<ClientMainSlider class="" />
	<section class="max-w-screen-xl w-full mx-auto px-4 py-3 pb-10">
		<h2 class="text-brand-primary mb-[50px] mt-[80px] text-2xl font-semibold tracking-tight text-black lg:text-[32px] lg:leading-tight">Последние новости</h2>
		<div class="grid gap-10 pb-10 md:grid-cols-2 lg:gap-10 xl:grid-cols-3">
			<template v-for="post in posts.data" :key="post.id">
				<ClientPost :post="post" />
			</template>
		</div>

		<div class="flex justify-center">
			<Link :href="route('client.post.index')" class="group mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-[#1A5AAF]">
				Все новости
				<svg class="flex-shrink-0 size-4 transition ease-in-out group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
			</Link>
		</div>

		<h2 class="text-brand-primary mb-[50px] mt-[80px] text-2xl font-semibold tracking-tight text-black lg:text-[32px] lg:leading-tight">Мероприятия</h2>

		<!-- Card Blog -->
		<div class="max-w-[85rem] px-4 pb-10 sm:px-6 lg:px-8 lg:pb-14 mx-auto">
			<!-- Title -->
			<!-- End Title -->

			<!-- Grid -->
			<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

				<template v-for="event in events.data">
					<Link class="group hover:bg-gray-100 rounded-xl p-5 transition-all" :href="route('client.event.show', event.slug)">
						<div class="aspect-w-16 aspect-h-10">
							<div class="w-full h-[250px] object-cover rounded-xl bg-[#F8F9FB]">
								<div class="flex flex-col px-5 py-5 w-full h-full">
									<div class="flex flex-col gap-3 mb-4">
										<div class="gap-3 flex items-center">
											<div class="shadow-sm">
												<div class="block w-[35px] h-[8px] bg-red-400 rounded-t" />
												<div class="block w-[35px] h-[27px] bg-white rounded-b text-center font-medium">{{ event.event_date_start.day }}</div>
											</div>
											<span class=" block first-letter:uppercase">{{ event.event_date_start.month }}</span>
											<div class="flex">
												<span class="bg-[#E9F2FE] text-sm text-blue-600 px-2 py-1 rounded block">Начало - {{ event.event_date_start.time }}</span>
											</div>
										</div>

									</div>
									<div class="flex gap-2">
										<span v-if="event.is_online === 1" class="bg-[#E9F2FE] text-sm text-blue-600 px-2 py-1 rounded block">Онлайн</span>
										<div v-if="event.is_online === 0">
											<span class="bg-[#E9F2FE] text-sm text-blue-600 px-2 py-1 rounded block">{{ event.address }}</span>
										</div>

									</div>
								</div>
							</div>
						</div>
						<h3 class="mt-5 text-xl text-gray-800">
							{{ event.title }}
						</h3>
						<p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-gray-800">
							Перейти
							<svg class="flex-shrink-0 size-4 transition ease-in-out group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
						</p>
					</Link>


				</template>

				<!-- End Card -->
			</div>
			<!-- End Grid -->
		</div>

		<div class="flex justify-center">
			<Link :href="route('client.event.index')" class="group mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-[#1A5AAF]">
				Все мероприятия
				<svg class="flex-shrink-0 size-4 transition ease-in-out group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
			</Link>
		</div>

		<!-- End Card Blog -->

		<h2 class="text-brand-primary mb-[50px] mt-[80px] text-2xl font-semibold tracking-tight text-black lg:text-[32px] lg:leading-tight">Образование</h2>

		<div class="grid gap-10 md:grid-cols-1 lg:gap-10 xl:grid-cols-2">
			<div class="w-full bg-[#E9F2FE] h-[300px] hover:opacity-70 duration-300 rounded group px-10 py-8">
				<h3 class="my-3 flex justify-between items-center gap-x-1 text-2xl font-semibold text-gray-800">
					<span class="">Бакалавриат</span>
					<svg class="flex-shrink-0 size-9 transition ease-in-out duration-300 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
				</h3>
				<p class="font-thin">Построй свою индивидуальную траекторию</p>
				<div class="flex mt-[100px] gap-x-4">
					<div class="">
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
				</div>
			</div>
			<div class="w-full bg-[#F5F5F5] h-[300px] hover:opacity-70 duration-300 rounded group px-10 py-8">
				<h3 class="my-3 flex justify-between items-center gap-x-1 text-2xl font-semibold text-gray-800">
					<span class="">Магистратура</span>
					<svg class="flex-shrink-0 size-9 transition ease-in-out duration-300 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
				</h3>
				<p class="font-thin">Построй свою индивидуальную траекторию</p>
				<div class="flex mt-[100px] gap-x-4">
					<div class="">
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
				</div>
			</div>
			<div class="w-full bg-[#F5F5F5] h-[300px] hover:opacity-70 duration-300 rounded group px-10 py-8">
				<h3 class="my-3 flex justify-between items-center gap-x-1 text-2xl font-semibold text-gray-800">
					<span class="">Дополнительное образование</span>
					<svg class="flex-shrink-0 size-9 transition ease-in-out duration-300 group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
				</h3>
				<p class="font-thin">Построй свою индивидуальную траекторию</p>
				<div class="flex mt-[100px] gap-x-4">
					<div class="">
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
				</div>
			</div>
			<div class="w-full bg-[#E9F2FE] h-[300px] hover:opacity-70 duration-300 rounded group px-10 py-8">
				<h3 class="my-3 flex justify-between items-center gap-x-1 text-2xl font-semibold text-gray-800">
					<span class="">Среднее профессиональное</span>
					<svg class="flex-shrink-0 size-9 transition duration-300 ease-in-out group-hover:translate-x-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
				</h3>
				<p class="font-thin">Построй свою индивидуальную траекторию</p>
				<div class="flex mt-[100px] gap-x-4">
					<div class="">
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
					<div>
						<span class="block text-xl font-semibold">30</span>
						<span class="block">Программ</span>
					</div>
				</div>
			</div>

		</div>





	</section>

	<section class="bg-[#F5F5F5] w-full py-10">
		<div class="max-w-screen-xl flex xl:block justify-around w-full mx-auto px-4 py-[50px]">
			<div class="grid xl:grid-cols-3 gap-y-7 grid-cols-1 mb-[50px]">
				<h2 class="font-semibold text-[#1A5AAF] text-lg">Контакты</h2>
				<div>
					<h3 class="font-semibold mb-4">Главный корпус</h3>
					<div class="font-light">
						<p>622031, Нижний Тагил, <br> Красногвардейская 57</p>
					</div>
				</div>
				<div>
					<h3 class="font-semibold mb-4">Свяжитесь с нами</h3>
					<div class="font-light">
						<p>+7(906)-802-55-59</p>
						<p>ntgspi@yandex.ru</p>
					</div>
				</div>
			</div>
			<div class="grid xl:grid-cols-3 grid-cols-1 mb-[50px]">
				<h2 class="font-semibold text-[#1A5AAF] text-lg">Приемная комиссия</h2>
				<div>
					<h3 class="font-semibold mb-4">Главный корпус</h3>
					<div class="font-light">
						<p>Понедельник - Пятница <br> с 08.30 до 17.00</p>
					</div>
				</div>
				<div>
					<h3 class="font-semibold mb-4">Ответственный секретарь <br> приемной комиссии</h3>
					<div class="font-light">
						<p>+7(906)-802-55-59</p>
						<p>ntgspi@yandex.ru</p>
					</div>
				</div>
			</div>
			<div class="grid xl:grid-cols-3 grid-cols-1">
				<h2 class="font-semibold text-[#1A5AAF] text-lg">Полезное</h2>
				<div>
					<h3 class="font-semibold mb-4">Главный корпус</h3>
					<div class="font-light">
						<p>Понедельник - Пятница <br> с 08.30 до 17.00</p>
					</div>
				</div>
				<div>
					<h3 class="font-semibold mb-4">Ответственный секретарь <br> приемной комиссии</h3>
					<div class="font-light">
						<p>+7(906)-802-55-59</p>
						<p>ntgspi@yandex.ru</p>
					</div>
				</div>
			</div>

		</div>
	</section>






	<ClientFooterDown />



</template>

<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import axios from "axios";
import {Head, Link} from "@inertiajs/vue3";
import ClientMainSlider from "@/Components/ClientMainSlider.vue";
import ClientMainSliderSecond from "@/Components/ClientMainSliderSecond.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import MainPageNavBar from "@/Navbars/MainPageNavbar.vue";
import ClientPost from "@/Components/ClientPost.vue";



export default {
	name: "Main",
	data() {
		return {
		}
	},

	props: {
		navigation: {
			type: Array,
		},
		posts: {
			type: Array,
		},
		events: {
			type: Array,
		}
	},

	components: {
		ClientPost,
		MainPageNavBar,
		ClientFooterDown,
		ClientMainSlider,
		ClientMainSliderSecond,
		Head,
		Link,

	},

	methods: {
	},

}


</script>

<style scoped>

</style>
