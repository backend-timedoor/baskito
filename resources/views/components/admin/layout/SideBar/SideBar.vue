<template>
  <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <Link :href="$route('admin.dashboard')"
          ><img src="@/images/logo-black.svg" alt="logo" class="w-75"
        /></Link>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <Link :href="$route('admin.dashboard')"
          ><img src="@/images/logo-black-square.svg" alt="logo" class="w-50"
        /></Link>
      </div>
      <ul class="sidebar-menu">
        <SideBarHeader>Example</SideBarHeader>
        <SideBarLink
          icon="fas fa-fire"
          :href="$route('admin.dashboard')"
          :active="routeIs('admin.dashboard')"
        >
          Dashboard
        </SideBarLink>
        <SideBarDropdown
          title="Other Page"
          icon="fas fa-columns"
          :active="false"
        >
          <SideBarLink :href="$route('admin.login')" :active="false">
            Login Page
          </SideBarLink>
          <SideBarLink :href="$route('admin.login-2')" :active="false">
            Login Page 2
          </SideBarLink>
        </SideBarDropdown>
        <SideBarDropdown
          title="Components"
          icon="fas fa-columns"
          :active="routeIs('admin.component.*')"
        >
          <SideBarLink
            :href="$route('admin.component.select2')"
            :active="routeIs('admin.component.select2')"
          >
            Select2
          </SideBarLink>
          <SideBarLink
            :href="$route('admin.component.modal')"
            :active="routeIs('admin.component.modal')"
          >
            Modal
          </SideBarLink>
          <SideBarLink
            :href="$route('admin.component.pagination')"
            :active="routeIs('admin.component.pagination')"
          >
            Pagination
          </SideBarLink>
          <SideBarLink
            :href="$route('admin.component.sweet-alert')"
            :active="routeIs('admin.component.sweet-alert')"
          >
            Sweet Alert
        </SideBarLink>
          <SideBarLink
            :href="$route('admin.component.input')"
            :active="routeIs('admin.component.input')"
          >
            Input
          </SideBarLink>
          <SideBarLink
            :href="$route('admin.component.card')"
            :active="routeIs('admin.component.card')">
            Card
          </SideBarLink>
        </SideBarDropdown>
      </ul>
    </aside>
  </div>
</template>

<script setup lang="ts">
import { nextTick, onMounted } from "vue";
import initStisla from "@/scripts/utils/stisla";
import SideBarLink from "./SideBarLink.vue";
import SideBarHeader from "./SideBarHeader.vue";
import SideBarDropdown from "./SideBarDropdown.vue";
import { Link } from "@inertiajs/vue3";
import { useRoute } from "@/scripts/utils/ziggy/useRoute";

const { routeIs } = useRoute();

onMounted(() => {
  nextTick(() => {
    initStisla();
  });
});

if (import.meta.hot) {
  import.meta.hot.accept(() => {
    nextTick(() => {
      initStisla();
    });
  });
}
</script>

<style scoped></style>
