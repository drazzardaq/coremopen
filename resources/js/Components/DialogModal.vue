<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
  show: {
    type: Boolean,
    default: false,
  },
  maxWidth: {
    type: String,
    default: "2xl",
  },
  closeable: {
    type: Boolean,
    default: true,
  },
});

const close = () => {
  emit("close");
};
</script>

<template>
  <Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
		<div class="font-medium text-gray-700 text-sm bg-gray-100 uppercase px-6 py-4 rounded-t-lg">
			<slot name="title" />
		</div>

		<template v-if="$slots.content && $slots.footer">
			<div class="my-4 text-sm text-gray-600 px-6 py-4">
				<slot name="content" />
			</div>

			<div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right h-max max-h-max rounded-b-lg">
				<slot name="footer" />
			</div>
		</template>
		<template v-else>
			<slot />
		</template>
  </Modal>
</template>
