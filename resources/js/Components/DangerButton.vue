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
  <Link v-if="type === 'link'" :href="route(href)" class="button bg-gradient-to-br from-warning to-red-500 hover:saturate-200">
    <slot />
  </Link>
  <button v-else :type="type" class="button bg-gradient-to-br from-warning to-red-500 hover:saturate-200">
    <slot />
  </button>
</template>
