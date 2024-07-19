<template>
  <!-- ========== MAIN CONTENT ========== -->
  <!-- Sidebar Toggle -->
  <div
      class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center py-4">
      <!-- Navigation Toggle -->
      <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#application-sidebar"
              aria-controls="application-sidebar" aria-label="Toggle navigation">
        <span class="sr-only">Toggle Navigation</span>
        <svg class="w-5 h-5" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
      </button>
      <!-- End Navigation Toggle -->

      <!-- Breadcrumb -->
      <!-- End Breadcrumb -->
    </div>
  </div>
  <!-- End Sidebar Toggle -->

  <!-- Sidebar -->
  <div id="application-sidebar"
       class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-white border-r border-gray-200 pt-7 pb-10 overflow-y-auto scrollbar-y lg:block lg:translate-x-0 lg:right-auto lg:bottom-0 dark:scrollbar-y dark:bg-gray-800 dark:border-gray-700">
    <div class="px-6 flex justify-between">
      <a class="flex-none text-xl font-semibold dark:text-white" href="#" aria-label="Brand">NTGSPI</a>
    </div>

    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
      <ul class="space-y-1.5">
        <AdminSubListItem :title="'Главная'" :route-name="'admin.index'"/>
        <hr>
        <AdminListItem :title="'Подразделения института'">
          <AdminSubListItem :title="'Все подразделения'" :route-name="'admin.division.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.division.create'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Факультеты'">
          <AdminSubListItem :title="'Все факультеты'" :route-name="'admin.faculty.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.faculty.create'"/>
        </AdminListItem>
        <AdminListItem :title="'Кафедры'">
          <AdminSubListItem :title="'Все кафедры'" :route-name="'admin.department.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.department.create'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Разделы'">
          <AdminSubListItem :title="'Все разделы'" :route-name="'admin.mainSection.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.mainSection.create'"/>
        </AdminListItem>
        <AdminListItem :title="'Подразделы'">
          <AdminSubListItem :title="'Все подразделы'" :route-name="'admin.subSection.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.subSection.create'"/>
        </AdminListItem>
        <AdminListItem :title="'Страницы'">
          <AdminSubListItem :title="'Все страницы'" :route-name="'admin.page.index'"/>
          <AdminSubListItem :title="'Зарезервированные страницы'" :route-name="'admin.registered.page.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.page.create'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Новости'">
          <AdminSubListItem :title="'Все новости'" :route-name="'admin.post.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.post.create'"/>
        </AdminListItem>
        <AdminListItem :title="'Категории'">
          <AdminSubListItem :title="'Все категории'" :route-name="'admin.category.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.category.create'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Мероприятия'">
          <AdminSubListItem :title="'Все мероприятия'" :route-name="'admin.event.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.event.create'"/>
        </AdminListItem>
        <AdminListItem class="hidden" :title="'Тэги'">
          <AdminSubListItem :title="'Все тэги'" :route-name="'admin.category.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.category.index'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Расписание'">
          <AdminSubListItem :title="'Все расписание'" :route-name="'admin.schedule.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.schedule.create'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Вопросы абитуриентов'">
          <AdminSubListItem :title="'Все вопросы'" :route-name="'admin.applicantQuestion.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.applicantQuestion.create'"/>
        </AdminListItem>
        <hr>
        <AdminListItem :title="'Пользователи'">
          <AdminSubListItem :title="'Все пользователи'" :route-name="'admin.user.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.user.create'"/>
        </AdminListItem>
        <AdminListItem :title="'Студенты'">
          <AdminSubListItem :title="'Все пользователи'" :route-name="'admin.student.index'"/>
          <AdminSubListItem :title="'Добавить'" :route-name="'admin.student.create'"/>
        </AdminListItem>

      </ul>
    </nav>
  </div>
  <!-- End Sidebar -->
  <!-- Content -->

  <div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <slot/>
  </div>

  <!-- End Content -->
  <!-- ========== END MAIN CONTENT ========== -->

</template>

<script>
import AdminListItem from "@/Components/AdminListItem.vue";

document.addEventListener('click', function (e) {
  if (e.target.tagName === 'A') {
    HSOverlay.close(document.querySelector('#application-sidebar'));
  }
})

import {Link} from "@inertiajs/vue3";
import AdminSubListItem from "@/Components/AdminSubListItem.vue";

export default {
  name: "AdminLayout",
  components: {
    AdminSubListItem,
    AdminListItem,
    Link,
  },
  methods: {
    getRelativeURL(routeName) {
      const fullURL = route(routeName);
      const relativeURL = new URL(fullURL).pathname;
      return relativeURL;
    },
    closeSide() {
      HSOverlay.close(document.querySelector('#application-sidebar'));
    }
  },
}
</script>

<style scoped>

</style>
