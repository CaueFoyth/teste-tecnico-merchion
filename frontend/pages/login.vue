<template>
  <AuthLayout title="Faça login na sua conta">
    <template #subtitle>
      Ou
      <NuxtLink to="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
        crie uma nova conta
      </NuxtLink>
    </template>

    <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
      <div class="space-y-4">
        <BaseInput
          id="email"
          v-model="form.email"
          name="email"
          type="email"
          label="Email"
          placeholder="seu@email.com"
          :disabled="loading"
          required
        />
        <BaseInput
          id="password"
          v-model="form.password"
          name="password"
          type="password"
          label="Senha"
          placeholder="Sua senha"
          :disabled="loading"
          required
        />
      </div>

      <ErrorMessage :error="error" />

      <div>
        <BaseButton type="submit" :loading="loading" loading-text="Fazendo login...">
          Entrar
        </BaseButton>
      </div>
    </form>
  </AuthLayout>
</template>

<script setup lang="ts">
import type { LoginRequest, ApiError } from '~/types/user';
import AuthLayout from '~/components/auth/AuthLayout.vue';
import BaseInput from '~/components/ui/BaseInput.vue';
import BaseButton from '~/components/ui/BaseButton.vue';
import ErrorMessage from '~/components/auth/ErrorMessage.vue';

definePageMeta({
  title: 'Login',
  middleware: 'guest'
});

const { login, isLoggedIn } = useAuth();

const form = reactive<LoginRequest>({
  email: '',
  password: ''
});

const loading = ref(false);
const error = ref<ApiError | null>(null);

const handleSubmit = async () => {
  loading.value = true;
  error.value = null;
  try {
    await login(form);
    await navigateTo('/dashboard');
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
