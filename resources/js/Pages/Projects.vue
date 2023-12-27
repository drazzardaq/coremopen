<script setup>
import FrontLayout from "@/Layouts/FrontLayout.vue";
</script>

<template>
	<FrontLayout title="Projects Management">
		<template #header>
      <div class="header">
        <img src="images/resources/projects.jpg" alt="Corem Projects" title="Corem Projects" class="w-full object-cover mix-blend-overlay" />
        <!-- <img src="images/resources/projects.jpg" alt="Corem Projects" title="Corem Projects" class="w-full object-cover mix-blend-overlay blur-lg" /> -->
        <div class="absolute left-6 sm:left-8 md:left-12 lg:left-20 xl:left-32 bottom-5 text-shade flex flex-col">
          <!-- <h1 class="heading-4 max-w-min">Projects Management</h1> -->
          <h1 class="heading-4">Projects Management</h1>
        </div>
      </div>
		</template>
		<template #content>
      <div class="flex flex-col px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 py-24 md:py-48 bg-gradient-to-t from-black to-primary text-shade">
			<!-- <div class="flex flex-col px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 py-24 md:py-48 bg-gradient-to-r from-accent to-primary text-shade"> -->
        <!-- <h3 class="heading-3">Qui veniam laborum mollit aliqua.</h3> -->
        <p class="heading-4">Use Corem simplification, unification, and focus as a success key for any plan or project. Outpace your competition here and now.</p>
      </div>
		</template>
	</FrontLayout>
</template>