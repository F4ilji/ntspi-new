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

    };
  },
  props: {
		journals: {
        type: Array,
    },
  },
  methods: {

  },

	mounted() {
  }
};
</script>

<template>
  <Head>
    <title>Научные периодические издания НТГСПИ</title>
    <meta name="description" content="Your page description"/>
  </Head>
  <ClientScrollTimeline/>
  <MainNavbar class="border-b" :sections="$page.props.navigation"></MainNavbar>
  <div class="relative mx-auto mt-[67px] max-w-screen-xl px-4 py-10 md:flex md:flex-row md:py-10">
    <div class="px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
      <div>
        <!-- Avatar Media -->
        <!-- End Avatar Media -->
        <!-- Content -->
        <div class="space-y-5 md:space-y-4">
          <div class="space-y-5 md:space-y-4">
						<!-- Card Section -->
						<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

							<div class="max-w-2xl text-center mx-auto mb-10 lg:mb-14">
								<h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Научные периодические издания НТГСПИ</h2>
								<p class="mt-1 text-gray-600 dark:text-neutral-400">We've helped some great companies brand, design and get to market.</p>
							</div>
							<!-- Grid -->
							<div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-3 sm:gap-6">
								<template v-for="journal in journals.data">
									<Link :href="route('client.academicJournals.show', journal.slug)" class="group flex items-center bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition" >
										<div class="p-4 md:p-5 w-full">
											<div class="flex justify-between items-center gap-x-3">
												<div class="grow">
													<h3 class="group-hover:text-blue-600 font-semibold text-gray-800">
														{{ journal.title }}
													</h3>
												</div>
												<div>
													<svg class="shrink-0 size-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
												</div>
											</div>
										</div>
									</Link>
								</template>

							</div>
							<!-- End Grid -->
						</div>
						<!-- End Card Section -->
          </div>
        </div>
        <!-- End Content -->
      </div>
    </div>
  </div>
  <ClientFooterDown/>
</template>

<style scoped></style>
