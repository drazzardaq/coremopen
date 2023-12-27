<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <Head title="Forgot Password" />

  <AuthenticationCard>
    <template #logo>
      <ApplicationLogo />
    </template>

    <div class="mb-4 text-sm text-shade">
      <p>Have you lost your password? We can email you a password reset link and you can choose a new one.</p>
    </div>

    <div v-if="status" class="mb-4 text-sm">
      <p>{{ status }}</p>
    </div>

    <form @submit.prevent="submit">
      <div>
        <InputLabel for="email" value="Email" />
        <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autocomplete="username" />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      
			<div class="flex flex-col sm:flex-row sm:items-center justify-end mt-8">
      	<Link :href="route('register')" class="link">Not registered?</Link>

        <PrimaryButton class="ml-auto sm:ml-4 mt-4 sm:mt-0" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Email Password Reset Link</PrimaryButton>     
      </div>
    </form>
  </AuthenticationCard>
</template>
