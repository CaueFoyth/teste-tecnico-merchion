<template>
  <NuxtLink
    v-if="to"
    :to="to"
    :class="[commonClasses, variantClasses, disabledClasses]"
    :aria-disabled="disabled || loading"
    @click="handleClick"
  >
    <span v-if="loading">{{ loadingText }}</span>
    <slot v-else />
  </NuxtLink>
  <button
    v-else
    :disabled="disabled || loading"
    :class="[commonClasses, variantClasses, disabledClasses]"
  >
    <span v-if="loading">{{ loadingText }}</span>
    <slot v-else />
  </button>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
  to: {
    type: String,
    default: null
  },
  variant: {
    type: String as () => 'primary' | 'secondary',
    default: 'primary'
  },
  disabled: {
    type: Boolean,
    default: false
  },
  loading: {
    type: Boolean,
    default: false
  },
  loadingText: {
    type: String,
    default: 'Aguarde...'
  }
});

const commonClasses = 'w-full flex justify-center py-3 px-4 border rounded-md shadow-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors select-none';

const variantClasses = computed(() => {
  switch (props.variant) {
    case 'secondary':
      return 'border-gray-300 text-gray-700 bg-white hover:bg-gray-50';
    case 'primary':
    default:
      return 'border-transparent text-white bg-indigo-600 hover:bg-indigo-700';
  }
});

const disabledClasses = computed(() => {
  return (props.disabled || props.loading) ? 'opacity-50 cursor-not-allowed' : '';
});

const handleClick = (event: MouseEvent) => {
  if (props.disabled || props.loading) {
    event.preventDefault();
  }
};
</script>