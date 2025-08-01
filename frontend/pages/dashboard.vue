<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
          </h1>
          <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-600">
              Logado como: <strong>{{ user?.name }}</strong>
            </span>
            <button
              @click="handleLogout"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
            >
              Sair
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Conteúdo principal -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-6 py-8">
            <div class="text-center">
              <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              
              <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Bem-vindo, {{ user?.name }}! 👋
              </h2>
              
              <p class="text-gray-600 mb-6">
                Você está logado no sistema com sucesso.
              </p>
              
              <div class="bg-gray-50 rounded-lg p-6 max-w-md mx-auto">
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                  Suas informações:
                </h3>
                <div class="space-y-3 text-left">
                  <div>
                    <span class="text-sm font-medium text-gray-500">ID:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ user?.id }}</span>
                  </div>
                  <div>
                    <span class="text-sm font-medium text-gray-500">Nome:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ user?.name }}</span>
                  </div>
                  <div>
                    <span class="text-sm font-medium text-gray-500">Email:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ user?.email }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
definePageMeta({
  title: 'Dashboard',
  middleware: 'auth'
});

const { user, logout, isLoggedIn } = useAuth();

watchEffect(() => {
  if (!isLoggedIn.value) {
    navigateTo('/login');
  }
});

const handleLogout = () => {
  logout();
};
</script>
