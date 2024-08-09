<script>
import MainNavbar from "@/Navbars/MainNavbar.vue";
import {Head, Link} from "@inertiajs/vue3";
import FsLightbox from "fslightbox-vue/v3";
import ClientScrollTimeline from "@/Components/ClientScrollTimeline.vue";
import ClientFooterDown from "@/Components/ClientFooterDown.vue";
import AdminIndexSearch from "@/Components/AdminIndexSearch.vue";
import AdminIndexFilter from "@/Components/AdminIndexFilter.vue";
import AdminIndexHeader from "@/Components/AdminIndexHeader.vue";
import AdminIndexHeaderTitle from "@/Components/AdminIndexHeaderTitle.vue";
import ClientPostFilter from '@/Components/ClientPostFilter.vue';
import ClientPost from '@/Components/ClientPost.vue';
import ClientPostSearch from '@/Components/ClientPostSearch.vue';

export default {
  name: "Index",
  components: {
    AdminIndexHeaderTitle, AdminIndexHeader,
    AdminIndexFilter, AdminIndexSearch,
    ClientFooterDown,
    ClientScrollTimeline,
    ClientPostFilter,
    Link,
    MainNavbar,
    FsLightbox,
    Head,
    ClientPost,
    ClientPostSearch
  },
  data() {
    return {
			direction_id: this.filters.dir_id,
    };
  },
  props: {
		directionAdditionalEducations: {
        type: Object,
    },
		additionalEducations: {
			type: Object
		},
		filters: {
			type: Object
		},
  },
  methods: {
		transformToColumns(originalArray) {
			const chunkArray = (arr, size) => {
				return arr.reduce((acc, _, i) => (i % size ? acc : [...acc, arr.slice(i, i + size)]), []);
			};

			const dividedArrays = chunkArray(originalArray, Math.ceil(originalArray.length / 2));

			return dividedArrays.reverse();
		},
		textLimit(text, symbols) {
			if (text.length > symbols) {
				let LimitedText
				LimitedText = text.substring(0, symbols)
				return LimitedText + "..."
			}
			return text
		},


  },
  mounted() {
  }
};
</script>

<template>
  <Head>
    <title>Дополнительное образование</title>
    <meta name="description" content="Your page description"/>
  </Head>
  <MainNavbar class="border-b" :sections="$page.props.navigation"></MainNavbar>
  <div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:py-10">
    <div class="w-100">
      <div>
        <!-- Avatar Media -->
        <!-- End Avatar Media -->
        <!-- Content -->
        <div class="space-y-5 md:space-y-4">
					<h1 class="text-brand-primary text-center mb-3 mt-2 text-3xl font-semibold tracking-tight dark:text-white lg:text-[40px] lg:leading-tight">
						Дополнительное образование

					</h1>
          <div class="space-y-5 md:space-y-4">
            <div>
							<div class="">
								<nav class="-mb-0.5 flex justify-center space-x-6">
									<Link :class="{ 'border-blue-500 text-blue-600': this.direction_id === null, 'text-gray-500 border-transparent': this.direction_id !== null }"
													:href="route('client.additionalEducation.index')"
													class="py-2 px-1 inline-flex items-center gap-2 border-b text-sm whitespace-nowrap hover:text-blue-600 focus:outline-none focus:text-blue-600">
										Все программы
									</Link>
									<template v-for="direction in directionAdditionalEducations.data">
										<Link :class="{ 'border-blue-500 text-blue-600': direction.id == this.filters.dir_id, 'text-gray-500 border-transparent': direction.id != this.direction_id }"
													:href="route('client.additionalEducation.index', { dir_id: direction.id })"
													class="py-2 px-1 inline-flex items-center gap-2 border-b text-sm whitespace-nowrap hover:text-blue-600 focus:outline-none focus:text-blue-600">
											{{ direction.title }}
										</Link>
									</template>
								</nav>
							</div>
              <div class="container px-8 mx-auto xl:px-5 py-5 lg:py-8">
								<div class="w-4/5 mx-auto flex">
									<template v-for="educations in transformToColumns(this.additionalEducations.data)">
										<div class="w-1/2 flex flex-col">
											<template v-for="education in educations">
												<div style="height: max-content" class="px-2">
													<h1 class="text-brand-primary mb-2 mt-2 text-lg font-semibold upper tracking-tight dark:text-white lg:text-md lg:leading-tight">
														{{ education.title }}
													</h1>
													<template v-for="program in education.additionalEducations" :key="program.id">
														<Link class="block text-[#1E57A3] hover:text-blue-600 duration-200 text-sm underline underline-offset-2 py-1" :href="route('client.additionalEducation.show', program)">{{ program.title }}</Link>
													</template>
												</div>
											</template>
										</div>
									</template>
								</div>
              </div>
            </div>
          </div>
        </div>



        <!-- End Content -->
      </div>
    </div>
  </div>
  <ClientFooterDown/>
</template>

<style scoped></style>
