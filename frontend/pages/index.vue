<template>
  <AuthLayout title="Bem-vindo!">
    <template #subtitle>
      Sistema de Autenticação
    </template>

    <div class="space-y-4 mt-8">
      <BaseButton to="/register">
        Criar Conta
      </BaseButton>
      <BaseButton to="/login" variant="secondary">
        Fazer Login
      </BaseButton>
    </div>
  </AuthLayout>
</template>

<script setup lang="ts">
import AuthLayout from '~/components/auth/AuthLayout.vue';
import BaseButton from '~/components/ui/BaseButton.vue';

const { isLoggedIn } = useAuth();

watchEffect(() => {
  if (isLoggedIn.value) {
    navigateTo('/dashboard');
  }
});
</script>
