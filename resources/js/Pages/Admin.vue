<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const props = defineProps({
  items: Object,
});
</script>

<template>
  <AppLayout title="Administration">
    <template #header>
      <div class="flex flex-row-reverse items-center justify-between w-full flex-wrap">
        <h2 class="font-medium text-xl text-primary">User Administration</h2>
      </div>
    </template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12 overflow-x-hidden">
      <div class="h-[240px] min-h-[240px]">
        <table v-if="$props.items.length > 0" class="table-auto shadow-xl shadow-black/5 border-separate border-spacing-0 text-sm rounded-b-lg">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Items Count</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="item in $props.items" :key="item.id">
              <tr>
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.created_at }}</td>
                <td>{{ item.updated_at }}</td>
                <td>{{ item.items.length }}</td>
              </tr>
            </template>
          </tbody>
        </table>
        <template v-else>
          <p class="text-center mb-10">No items found.</p>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
