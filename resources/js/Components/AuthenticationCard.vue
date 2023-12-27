<template>
  <div class="h-[100dvh] flex flex-col sm:justify-center items-center auth overflow-y-hidden">
    

    <div class="w-full sm:max-w-md p-10 shadow-xl landscape:overflow-y-scroll overflow-x-hidden sm:rounded-lg bg-gradient-to-bl from-accent to-primary relative z-40">
			<div class="flex items-center justify-center w-full mb-10">
				<slot name="logo" />
			</div>
      <slot />
    </div>
  </div>
</template>
