<script setup>
import { onMounted, ref } from "vue";

defineProps({
  modelValue: String,
  placeholder: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input ref="input" class="border-gray-300 focus:border-blue-500 focus:ring-0 rounded-lg shadow focus:shadow-sm duration-500" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" :placeholder="placeholder" />
</template>

<style scoped>
::placeholder {
  @apply text-sm;
}
::-webkit-input-placeholder {
  @apply text-sm;
}
:-ms-input-placeholder {
  @apply text-sm;
}
::-ms-input-placeholder {
  @apply text-sm;
}
:-moz-placeholder {
  @apply text-sm;
}
:-moz-placeholder {
  @apply text-sm;
}
:-moz-placeholder {
  @apply text-sm;
}
::-moz-placeholder {
  @apply text-sm;
}
</style>
