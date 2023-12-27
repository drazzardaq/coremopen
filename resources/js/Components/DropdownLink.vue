<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  href: String,
  as: String,
});
</script>

<template>
  <div>
    <button v-if="as" type="submit" class="font-medium block w-full px-4 py-2 text-left text-xs uppercase leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out last:rounded-b-lg">
      <slot />
    </button>

    <Link v-else :href="href" class="font-medium block w-full px-4 py-2 text-left text-xs uppercase leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out last:rounded-b-lg" :class="{ 'bg-gray-100': $page.url.includes('/user/profile') }">
      <slot />
    </Link>
  </div>
</template>
