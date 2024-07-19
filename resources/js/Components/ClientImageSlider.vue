<template>
	<div class="relative">
		<div class="flex">
			<div
					v-for="(item, index) in items"
					:key="index"
					class="w-full"
					:class="{ 'block': currentIndex === index, 'hidden': currentIndex !== index }"
			>
				<img :src="'/storage/' + item" class="mx-auto max-h-[550px] object-cover rounded-lg hover:opacity-95 hover:duration-200 transition" />
			</div>
		</div>
		<button
				class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
				@click="prevSlide"
		>
			&#10094;
		</button>
		<button
				class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
				@click="nextSlide"
		>
			&#10095;
		</button>
	</div>
</template>

<script>
export default {
	data() {
		return {
			currentIndex: 0,
			items: this.images,
		};
	},
	props: {
		images: {
			type: Array,
		},
	},
	methods: {
		prevSlide() {
			if (this.currentIndex > 0) {
				this.currentIndex--
			}
		},
		nextSlide() {
			this.currentIndex++
		},
	},
};
</script>