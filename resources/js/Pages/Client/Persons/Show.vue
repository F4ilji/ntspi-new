<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";

export default {
	name: "Show",
	components: {ClientFooterDown, MainNavbar},
	props: {
		userDetail: {
			type: Array
		},
		mainSections: {
			type: Array
		}
	},
	methods: {
		getFullName() {
			const fullName = [this.userDetail.surname, this.userDetail.name, this.userDetail.middleName]
			return fullName.join(' ')
		}
	}
}
</script>

<template>
	<MainNavbar :sections="this.mainSections"></MainNavbar>
	<div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
		<div class="sticky top-[121px] hidden h-[calc(100vh-121px)] min-w-[20%] md:flex md:shrink-0 md:flex-col md:justify-between">
		</div>
		<nav class="order-last hidden w-56 shrink-0 lg:block">
			<div class="sticky top-[126px] h-[calc(100vh-121px)]">
			</div>
		</nav>
		<article class="w-full min-w-0 mt-4 max-w-6xl px-1 md:px-6" style="">
			<div class="space-y-5 md:space-y-5">

				<div class="space-y-3">
					<h1 class="text-2xl font-bold md:text-3xl">{{ this.getFullName() }}</h1>
					<img :src="this.userDetail.photo" alt="">
				</div>



			</div>
		</article>
	</div>

	<ClientFooterDown />



</template>

<style scoped>

</style>