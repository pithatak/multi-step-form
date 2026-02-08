<template>
  <div>
    <h3 class="text-xl font-semibold mb-2">Work Experience</h3>

    <div v-for="(w, i) in model.workExperiences" :key="i" class="border p-4 mb-4">
      <input v-model="w.company" placeholder="Company" class="input-field" />
      <input v-model="w.position" placeholder="Position" class="input-field" />
      <input type="date" v-model="w.dateFrom" class="input-field" />
      <input type="date" v-model="w.dateTo" class="input-field" />

      <button v-if="model.workExperiences.length > 1"
              @click="$emit('remove', i)"
              class="bg-red-500 text-white px-3 py-1 mt-2">
        Remove
      </button>
    </div>

    <button @click="$emit('add')" class="bg-blue-500 text-white px-4 py-2">
      Add
    </button>
  </div>
</template>

<script setup>
defineProps({
  model: Object
})

defineEmits(['add', 'remove'])
</script>
