<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: Array,
});
</script>

<template>
  <div class="mt-8 flex items-center justify-center pb-3 mx-auto paginator">
    <template v-for="(link, i) in links" :key="i">
      <Link v-if="link.url" :href="link.url" v-html="link.label.includes('Previous') ? '&#10094;' : link.label.includes('Next') ? '&#10095;' : link.label" class="border border-shade/20 h-[31px] md:h-[40px] px-3 w-[31px] md:w-[40px] text-shade flex items-center justify-center text-xs uppercase font-medium" :class="link.active ? 'bg-accent' : 'bg-accent/50 hover:bg-accent'" />
      <span v-else :href="link.url" v-html="link.label.includes('Previous') ? '&#10094;' : link.label.includes('Next') ? '&#10095;' : link.label" class="bg-primary/10 pointer-events-none border border-shade/20 h-[31px] md:h-[40px] px-3 w-[31px] md:w-[40px] text-primary/50 flex items-center justify-center text-xs uppercase font-medium" />
    </template>
  </div>
</template>

<style scoped>
.paginator *:first-child {
  @apply rounded-l-lg;
}

.paginator *:last-child {
  @apply rounded-r-lg;
}
</style>
