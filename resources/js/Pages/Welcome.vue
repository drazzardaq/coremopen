<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FrontLayout from "@/Layouts/FrontLayout.vue";

const canRegister = ref(true);

const resources = [
  { id: 5, image: "life", badge: true, title: "Life Prosperity", text: "Connecting with like-minded people, socializing, tracking health, and fitness has never been easier. Pursue your goals from an advantage point.", icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />' },
  { id: 0, image: "businesses", badge: true, title: "Businesses Organization", text: "A comprehensive business hierarchy and structure organization offering cutting-edge CRM and ERP solutions and gives leverage.", icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />' },
  { id: 1, image: "projects", badge: true, title: "Projects Management", text: "Use Corem simplification, unification, and focus as a success key for any plan or project. Outpace your competition here and now.", icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9" />' },
  { id: 2, image: "tasks", badge: false, title: "Tasks Execution", text: "Never miss an important event or task that you have to handle. Track the status of execution, save time, and finally reach peace of mind.", icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />' },
  { id: 3, image: "finances", badge: true, title: "Finances Tracking", text: "Get ahead of costly expenses and stay tuned to your income and balances. Achieve long-term happiness, and prosperity at scale.", icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />' },
  { id: 4, image: "identity", badge: true, title: "Identity Overview", text: "Securely store and list your digital and analog identity information in your personal account. Become, and stay aware of what you share.", icon: '<path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />' },
];
</script>

<template>
  <FrontLayout title="A Professional Management and Organization">
    <template #header>
      <div class="bg-gradient-to-tr from-black to-primary py-28 md:py-48 lg:py-80 text-shade px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 relative z-40">
        <div class="flex flex-col items-start justify-start md:items-center md:text-center">
          <h1 class="heading-4">Welcome to Corem!</h1>
          <h2 class="heading-2 mt-10">A flexible, item-based, and interconnected platform for all organizing.</h2>
          <h2 class="heading-2">Focus on what's the most important to you - but never again lose a big picture.</h2>
          <!-- <h2 class="heading-2">Integrate with social media platforms, financial institutions, and more.</h2> -->
          <Link v-if="canRegister" :href="route('register')" class="mt-10">
            <PrimaryButton>Get Free Early Access</PrimaryButton>
          </Link>
        </div>
      </div>
    </template>
    <template #content>
      <div class="flex flex-col px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 py-12 md:py-24 lg:py-34 bg-primary bg-gradient-to-b from-accent/50 to-black">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 mt-6 text-shade">
          <Link v-for="resource in resources" :key="resource.image" :href="route(resource.image)" class="flex bg-accent flex-col rounded-lg shadow-md transition duration-500 relative" :class="resource.badge ? 'pointer-events-none' : 'cursor-pointer'">
            <!-- <div class="w-full bg-gradient-to-b rounded-lg from-primary to-accent relative h-[233px] min-h-[233px] z-30">
              <img :src="'images/services/' + resource.image + '.jpg'" :alt="'Corem ' + resource.image.toUpperCase()" class="w-full h-[233px] rounded-t-lg object-cover hover:saturate-150 transition-all absolute opacity-90 z-20" />
            </div> -->
            <div v-if="resource.badge" class="absolute -bottom-4 right-5 bg-gradient-to-br from-blue-500 via-accent to-primary badge z-30">Coming Soon</div>
            <div class="flex flex-col p-10">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mb-3 mr-2 -ml-1" v-html="resource.icon"></svg>
                <h3 class="heading-3">{{ resource.title }}</h3>
              </div>
              <p class="heading-2">{{ resource.text }}</p>
            </div>
          </Link>
        </div>
      </div>
    </template>
  </FrontLayout>
</template>
