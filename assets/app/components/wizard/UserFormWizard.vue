<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-100 to-blue-200 flex items-center justify-center">
    <div class="wizard bg-white p-8 rounded-xl shadow-xl w-full max-w-lg font-sans">
      <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Profile registration form</h2>
      <StepBasicInfo v-if="step === 1" :model="formData"/>
      <StepContact v-if="step === 2" :model="formData"/>
      <StepWorkExperience
          v-if="step === 3"
          :model="formData"
          @add="addWorkExperience"
          @remove="removeWorkExperience"
      />

      <div v-if="step === 4">
        <h3 class="text-xl font-bold mb-4">Submitted data</h3>
        <pre class="bg-gray-100 p-4 rounded text-sm">
          {{ submittedData }}
        </pre>
      </div>

      <div v-if="errors">
        <p v-for="(msg, key) in errors" :key="key" class="text-red-500">
          {{ msg[0] }}
        </p>
      </div>

      <div class="actions mt-6 flex justify-between">
        <button
            v-if="step > 1"
            @click="prevStep"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded text-lg font-medium"
        >
          Previous
        </button>
        <button
            v-if="step < 3"
            @click="nextStep"
            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded text-lg font-medium"
        >
          Next
        </button>
        <button
            v-if="step === 3"
            @click="submit"
            class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded text-lg font-medium"
        >
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import StepBasicInfo from './StepBasicInfo.vue'
import StepContact from './StepContact.vue'
import StepWorkExperience from './StepWorkExperience.vue'
import {useUserWizard} from '@/composables/useUserWizard'

const {
  step,
  formData,
  errors,
  submittedData,
  nextStep,
  prevStep,
  addWorkExperience,
  removeWorkExperience,
  submit
} = useUserWizard()
</script>
