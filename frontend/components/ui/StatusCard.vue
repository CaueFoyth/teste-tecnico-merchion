<template>
  <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full text-center space-y-8">
      <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
        <slot name="icon" />
      </div>
      <h2 class="text-3xl font-bold text-gray-900 mb-4">
        <slot name="title" />
      </h2>
      <p class="text-gray-600 mb-8">
        <slot name="description" />
      </p>
      <div class="space-y-4">
        <slot name="actions" />
      </div>
    </div>
  </div>
</template>