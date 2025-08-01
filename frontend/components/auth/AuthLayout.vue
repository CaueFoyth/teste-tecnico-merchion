<template>
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
          {{ title }}
        </h2>
        <p v-if="$slots.subtitle" class="mt-2 text-center text-sm text-gray-600">
          <slot name="subtitle" />
        </p>
      </div>
      <slot />
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps({
  title: {
    type: String,
    required: true
  }
});
</script>
