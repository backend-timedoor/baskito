<template layout="admin">
  <Head title="Dashboard" />

  <PageSection header="Dashboard Page" :back-link="$route('admin.dashboard')">
    <PageTitle>Card</PageTitle>
    <PageDescription>Description for the page.</PageDescription>
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <CardSlot>
          <template #title>
            <h5>Card Title</h5>
          </template>
          <template #body>
            <p>Card Body</p>
          </template>
          <template #button>
            <button class="btn btn-primary">Button</button>
          </template>
        </CardSlot>
      </div>
    </div>
  </PageSection>
</template>

<script setup lang="ts">
import PageDescription from "@components/admin/layout/Page/PageDescription.vue";
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import PageTitle from "@components/admin/layout/Page/PageTitle.vue";
import CardSlot from "@/views/components/admin/ui/Card/CardSlot.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const name = ref("");

</script>

<style scoped></style>
