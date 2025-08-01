<template>
  <AuthLayout title="Criar nova conta">
    <template #subtitle>
      Ou
      <NuxtLink to="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
        faça login na sua conta existente
      </NuxtLink>
    </template>

    <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
      <div class="space-y-4">
        <BaseInput
          id="name"
          v-model="form.name"
          name="name"
          label="Nome completo"
          placeholder="Seu nome lindo"
          :disabled="loading"
          required
        />
        <BaseInput
          id="email"
          v-model="form.email"
          name="email"
          type="email"
          label="Email"
          placeholder="seu_melhor_email@email.com"
          :disabled="loading"
          required
        />
        <BaseInput
          id="password"
          v-model="form.password"
          name="password"
          type="password"
          label="Senha"
          placeholder="uma_senha_forte"
          :disabled="loading"
          required
        />
      </div>

      <ErrorMessage :error="error" />

      <div>
        <BaseButton type="submit" :loading="loading" loading-text="Criando conta...">
          Criar conta
        </BaseButton>
      </div>
    </form>
  </AuthLayout>
</template>

<script setup lang="ts">
import type { RegisterRequest, ApiError } from '~/types/user';
import AuthLayout from '~/components/auth/AuthLayout.vue';
import BaseInput from '~/components/ui/BaseInput.vue';
import BaseButton from '~/components/ui/BaseButton.vue';
import ErrorMessage from '~/components/auth/ErrorMessage.vue';

definePageMeta({
  title: 'Cadastro',
  middleware: 'guest'
});

const { register, isLoggedIn } = useAuth();

const form = reactive<RegisterRequest>({
  name: '',
  email: '',
  password: ''
});

const loading = ref(false);
const error = ref<ApiError | null>(null);

const handleSubmit = async () => {
  loading.value = true;
  error.value = null;
  try {
    await register(form);
  } catch (err: any) {
    error.value = err;
  } finally {
    loading.value = false;
  }
};

watchEffect(() => {
  if (isLoggedIn.value) {
    navigateTo('/dashboard');
  }
});
</script>
