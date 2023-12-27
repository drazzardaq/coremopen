<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: String,
  active: Boolean,
});

const classes = computed(() => {
  return props.active ? "inline-flex items-center px-1 pt-1 text-xs font-medium uppercase leading-5 text-accent transition duration-150 ease-in-out" : "inline-flex items-center px-1 pt-1 text-xs font-medium uppercase leading-5 text-gray-700 hover:text-accent focus:text-gray-700 transition duration-150 ease-in-out";
});
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
