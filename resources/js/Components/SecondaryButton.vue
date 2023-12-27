<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  type: {
    type: String,
    default: "submit",
  },
  href: {
    type: String,
    default: "#",
  },
});
</script>

<template>
  <Link v-if="type === 'link'" :href="route(href)" class="button bg-gradient-to-r from-blue-700 to-blue-800 hover:to-primary hover:saturate-200">
    <slot />
  </Link>
  <button v-else class="button bg-gradient-to-r from-blue-700 to-blue-800 hover:to-primary hover:saturate-200">
    <slot />
  </button>
</template>
