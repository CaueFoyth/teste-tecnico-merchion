<template>
  <StatusCard>
    <template #icon>
      <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
    </template>
    <template #title>
      Parabéns! 🎉
    </template>
    <template #description>
      Sua conta foi criada com sucesso! Agora você pode fazer login e acessar o sistema.
    </template>
    <template #actions>
      <BaseButton to="/login">
        Fazer Login
      </BaseButton>
      <BaseButton to="/" variant="secondary">
        Voltar ao Início
      </BaseButton>
    </template>
  </StatusCard>
</template>

<script setup lang="ts">
import StatusCard from '~/components/ui/StatusCard.vue';
import BaseButton from '~/components/ui/BaseButton.vue';

definePageMeta({
  title: 'Cadastro Realizado'
});

const { isLoggedIn } = useAuth();
watchEffect(() => {
  if (isLoggedIn.value) {
    navigateTo('/dashboard');
  }
});
</script>
