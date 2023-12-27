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
	disabled: {
		type: Boolean,
		default: false,
	},
});
</script>

<template>
  <Link v-if="type === 'link'" :href="route(href)" class="button bg-gradient-to-r from-blue-700 to-blue-800 hover:from-primary hover:to-accent hover:saturate-150">
    <slot />
  </Link>
  <button v-else :type="type" class="button bg-gradient-to-r from-blue-700 to-blue-800 hover:from-primary hover:to-accent hover:saturate-150" :class="disabled && 'disabled'">
    <slot />
  </button>
</template>
