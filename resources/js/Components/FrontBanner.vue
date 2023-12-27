<script setup>
import { onBeforeUnmount, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const resources = [
  { id: 5, title: "Life Prosperity" },
  { id: 0, title: "Businesses Organization" },
  { id: 1, title: "Projects Management" },
  { id: 2, title: "Tasks Execution" },
  { id: 3, title: "Finances Tracking" },
  { id: 4, title: "Identity Overview" },
];

const titles = [
  { id: 0, text: "Simplified" },
  { id: 1, text: "Unified" },
  { id: 2, text: "Integrated" },
];

const currentTitle = ref(0);
const updateCurrentTitle = () => {
  if (currentTitle.value === titles.length - 1) currentTitle.value = 0;
  else currentTitle.value = ++currentTitle.value;
  return currentTitle;
};

const currentResource = ref(0);
const updateCurrentResource = () => {
  if (currentResource.value === resources.length - 1) currentResource.value = 0;
  else currentResource.value = ++currentResource.value;
  return currentResource;
};

const updateResourceInterval = setInterval(updateCurrentResource, 5000);
const updateTitleInterval = setInterval(updateCurrentTitle, 30000);

onBeforeUnmount(() => {
  clearInterval(updateResourceInterval);
  clearInterval(updateTitleInterval);
});
</script>

<template>
  <div class="banner">
    <template v-for="resource in resources" :key="resource.id">
      <transition name="resource">
        <h2 v-if="resource.id == currentResource" class="absolute top-10 heading-3">{{ resource.title }}</h2>
      </transition>
    </template>
    <template v-for="title in titles" :key="title.id">
      <transition name="title">
        <h4 v-if="title.id == currentTitle" class="absolute bottom-5 heading-4">{{ title.text }}</h4>
      </transition>
    </template>
		<Link :href="route('register')" class="ml-auto mt-5">
			<PrimaryButton>Start Now</PrimaryButton>
		</Link>
  </div>
</template>
