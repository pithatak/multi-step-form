<template>
  <div>
    <h3 class="text-xl font-semibold mb-2">Basic Info</h3>
    <input v-model="model.user.name" placeholder="First Name" class="input-field" />
    <input v-model="model.user.surname" placeholder="Last Name" class="input-field" />
    <label>Birthday</label>
    <input type="date" v-model="model.user.birthday" class="input-field" />
  </div>
</template>

<script setup>
defineProps({
  model: Object
})
</script>
