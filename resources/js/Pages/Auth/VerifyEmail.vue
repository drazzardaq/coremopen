<script setup>
import { computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  status: String,
});

const form = useForm({});

const submit = () => {
  form.post(route("verification.send"));
};

const verificationLinkSent = computed(() => props.status === "verification-link-sent");
</script>

<template>
  <Head title="Email Verification" />

  <AuthenticationCard>
    <template #logo>
      <ApplicationLogo />
    </template>

    <div class="mb-4 text-sm">
      <p>Before continuing, please verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
    </div>

    <div v-if="verificationLinkSent" class="mb-4 text-sm">
      <p>A new verification link has been sent to the email address you provided in your profile settings.</p>
    </div>

    <form @submit.prevent="submit">
      <div class="mt-8 flex items-center justify-between">
        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Resend Email</PrimaryButton>

        <div>
          <Link :href="route('profile.show')" class="link">Edit Profile</Link>
          <Link :href="route('logout')" method="post" as="button" class="link ml-2">Logout</Link>
        </div>
      </div>
    </form>
  </AuthenticationCard>
</template>
