<script setup>
defineProps({
  value: String,
	dark: Boolean,
});
</script>

<template>
  <label class="block mb-1 ml-px font-medium text-xs uppercase" :class="dark ? 'text-primary' : 'dark:text-shade text-shade'">
    <span v-if="value">{{ value }}</span>
    <span v-else>
      <slot />
    </span>
  </label>
</template>
