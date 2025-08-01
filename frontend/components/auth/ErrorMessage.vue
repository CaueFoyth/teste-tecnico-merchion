<template>
  <div v-if="error" class="bg-red-50 border border-red-200 rounded-md p-4">
    <div class="text-sm text-red-600">
      {{ error.message }}
      <ul v-if="error.errors" class="mt-2 space-y-1">
        <li v-for="(messages, field) in error.errors" :key="field" class="text-xs">
          <strong>{{ field }}:</strong> {{ messages.join(', ') }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { ApiError } from '~/types/user';

defineProps<{
  error: ApiError | null
}>();
</script>
