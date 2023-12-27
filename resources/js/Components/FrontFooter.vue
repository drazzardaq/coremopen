<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-center w-full bg-black text-shade px-6 sm:px-8 md:px-12 lg:px-20 xl:px-32 max-h-[80px] min-h-[80px] sm:max-h-[50px] sm:min-h-[50px] text-xs">
    <!-- <p class="sm:mb-0 mt-2 sm:mt-0">&copy; Corem 2023. All rights reserved.</p> -->
    <p class="sm:mb-0 mt-2 sm:mt-0 mx-auto hidden sm:block">v1.0.2 (beta)</p>
    <!-- <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="flex items-center mt-2 sm:mt-0">
      <Link :href="route('terms')" class="text-shade text-xs hover:text-shade">Terms Of Service</Link>
      <Link :href="route('policy')" class="text-shade text-xs hover:text-shade ml-4">Privacy Policy</Link>
    </div> -->
  </div>
</template>
