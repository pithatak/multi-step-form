<template>
  <div>
    <h3 class="text-xl font-semibold mb-2">Contact</h3>
    <input v-model="model.contact.email" placeholder="Email" class="input-field" />
    <input v-model="model.contact.phone" placeholder="Phone" class="input-field" />
  </div>
</template>

<script setup>
defineProps({
  model: Object
})
</script>
