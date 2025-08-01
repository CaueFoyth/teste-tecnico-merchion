<template>
  <div class="min-h-screen bg-gray-50">
    <NuxtPage />
  </div>
</template>

<script setup lang="ts">
useHead({
  title: 'Desafio Frontend',
  meta: [
    {
      name: 'description',
      content: 'Sistema de autenticação com Vue.js e Nuxt.js'
    }
  ]
})
</script>