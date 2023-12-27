<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  active: Boolean,
  href: String,
  as: String,
});

const classes = computed(() => {
  return props.active ? "block w-full pl-4 md:pl-5 py-2 text-xs uppercase font-medium text-shade bg-accent transition duration-150 ease-in-out" : "block w-full pl-4 md:pl-5 py-2 text-xs uppercase font-medium text-primary focus:bg-transparent transition duration-150 ease-in-out";
});
</script>

<template>
  <div>
    <button v-if="as == 'button'" :class="classes" class="w-full text-left">
      <slot />
    </button>

    <Link v-else :href="href" :class="classes">
      <slot />
    </Link>
  </div>
</template>
