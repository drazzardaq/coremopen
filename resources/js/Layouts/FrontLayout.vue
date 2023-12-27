<script setup>
import { Head } from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";
import FrontBanner from "@/Components/FrontBanner.vue";
import FrontFooter from "@/Components/FrontFooter.vue";

defineProps({
  title: String,
});
</script>

<template>
  <Head :title="title" />
	<div class="flex flex-col items-start justify-start">
		<Navigation :canRegister="true" :canLogin="true" />

		<div class="page">
			<slot name="header" />
			<slot name="content" />

			<FrontBanner />
			<FrontFooter />
		</div>
	</div>
</template>
