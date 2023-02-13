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
        <SideBarLink
          icon="fas fa-list"
          :href="$route('admin.select2')"
          :active="routeIs('admin.select2')"
        >
          Select2
        </SideBarLink>
        <SideBarLink
          icon="fas fa-window-maximize"
          :href="$route('admin.modal')"
          :active="routeIs('admin.modal')"
        >
          Modal
        </SideBarLink>
        <SideBarLink
          icon="fas fa-check-square"
          :href="$route('admin.selector')"
          :active="routeIs('admin.selector')"
        >
          Selector
        </SideBarLink>
        <SideBarDropdown
          title="Other Page"
          icon="fas fa-columns"
          :active="false"
        >
          <SideBarLink
            :href="$route('admin.login')"
            :active="false"
          >
            Login Page
          </SideBarLink>
          <SideBarLink
            :href="$route('admin.login-2')"
            :active="false"
          >
            Login Page 2
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
import { Link } from "@inertiajs/inertia-vue3";
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
