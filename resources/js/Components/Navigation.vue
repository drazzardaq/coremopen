<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

const mobileMenu = ref(false);
const toggleMenu = () => {
  mobileMenu.value = !mobileMenu.value;
};

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <div class="flex items-center justify-start px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 w-full shadow-xl shadow-primary/10 fixed top-0 bg-gradient-to-r from-40% from-primary/70 via-60% via-accent/70 to-primary/70 backdrop-blur-lg max-h-[80px] min-h-[80px] z-50">
    <ApplicationLogo />
    <nav class="hidden lg:flex items-center w-full ml-8">
      <!-- <p href="#" class="link disabled mb-0">Life</p>
      <p href="#" class="link ml-4 disabled mb-0">Businesses</p> -->
      <!-- <Link :href="route('projects')" class="link ml-4" :class="{ active: $page.url.includes('/projects') }">Projects</Link> -->
      <Link :href="route('tasks')" class="link ml-4" :class="{ active: $page.url.includes('/tasks') }">Tasks</Link>
      <!-- <Link :href="route('finances')" class="link ml-4" :class="{ active: $page.url.includes('/finances') }">Finances</Link> -->
      <!-- <Link :href="route('identity')" class="link ml-4" :class="{ active: $page.url.includes('/identity') }">Identity</Link> -->
      <div v-if="canLogin" class="ml-auto mr-1">
        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="link">Dashboard</Link>

        <div v-else class="flex items-center">
          <Link :href="route('login')" class="link">Login</Link>
          <SecondaryButton v-if="canRegister" href="register" type="link" class="ml-4">Register</SecondaryButton>
        </div>
      </div>
    </nav>
    <SecondaryButton @click="toggleMenu()" class="ml-auto inline-flex lg:hidden">
      <FontAwesomeIcon size="lg" fixed-width :icon="mobileMenu ? 'times' : 'bars'" class="transition" />
    </SecondaryButton>
    <Transition name="menu">
      <nav v-if="mobileMenu" class="lg:hidden flex flex-col w-full absolute left-0 bg-white shadow-xl top-[80px] font-medium text-sm uppercase">
        <!-- <p href="#" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-black/5 disabled mb-0">Life</p> -->
        <!-- <p href="#" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-black/5 disabled mb-0">Businesses</p> -->
        <!-- <Link :href="route('projects')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-white hover:bg-accent hover:text-shade" :class="{ active: $page.url.includes('/projects') }">Projects</Link> -->
        <Link :href="route('tasks')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-white hover:bg-accent hover:text-shade" :class="{ active: $page.url.includes('/tasks') }">Tasks</Link>
        <!-- <Link :href="route('finances')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-white hover:bg-accent hover:text-shade" :class="{ active: $page.url.includes('/finances') }">Finances</Link> -->
        <!-- <Link :href="route('identity')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-white hover:bg-accent hover:text-shade" :class="{ active: $page.url.includes('/identity') }">Identity</Link> -->
        <div v-if="canLogin" class="flex items-center w-full">
          <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-white hover:bg-accent hover:text-shade">Dashboard</Link>

          <div v-else class="flex flex-col w-full">
            <Link :href="route('login')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-accent hover:saturate-[1.3] hover:text-shade text-shade">Login</Link>
            <Link v-if="canRegister" :href="route('register')" class="py-3 px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 bg-primary hover:saturate-200 hover:text-shade text-shade">Register</Link>
          </div>
        </div>
      </nav>
    </Transition>
  </div>
</template>
