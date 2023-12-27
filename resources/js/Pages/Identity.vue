<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";
</script>

<template>
	<FrontLayout title="Identity Overview">
		<template #header>
      <div class="header">
        <img src="images/resources/identity.jpg" alt="Corem Identity" title="Corem Identity" class="w-full object-cover mix-blend-overlay" />
        <div class="absolute left-6 sm:left-8 md:left-12 lg:left-20 xl:left-32 bottom-5 text-shade flex flex-col">
          <h1 class="heading-4">Identity Overview</h1>
        </div>
      </div>
		</template>
		<template #content>
      <div class="flex flex-col px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 py-24 md:py-48 bg-gradient-to-t from-black to-primary text-shade">
        <p class="heading-4">Securely store and list your digital and analog identity information in your personal account. Become, and stay aware of what you share.</p>
      </div>
		</template>
	</FrontLayout>
</template>