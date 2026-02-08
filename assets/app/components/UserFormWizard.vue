<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-100 to-blue-200 flex items-center justify-center">
    <div class="wizard bg-white p-8 rounded-xl shadow-xl w-full max-w-lg font-sans">
      <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Profile registration form</h2>
      <div v-if="step === 1">
        <h3 class="text-xl font-semibold mb-2 text-gray-700">Basic Info</h3>
        <input v-model="formData.user.name" placeholder="First Name" class="input-field"/>
        <input v-model="formData.user.surname" placeholder="Last Name" class="input-field"/>
        <label class="block text-sm text-gray-600">Birthday</label>
        <input type="date" v-model="formData.user.birthday" class="input-field"/>
      </div>

      <div v-if="step === 2">
        <h3 class="text-xl font-semibold mb-2 text-gray-700">Contact Info</h3>
        <input v-model="formData.contact.email" placeholder="Email" class="input-field"/>
        <input v-model="formData.contact.phone" placeholder="Phone" class="input-field"/>
      </div>

      <div v-if="step === 3">
        <h3 class="text-xl font-semibold mb-2 text-gray-700">Work Experience</h3>
        <div v-for="(work, index) in formData.workExperiences" :key="index" class="mb-4 border p-4 rounded">
          <input v-model="work.company" placeholder="Company" class="input-field"/>
          <input v-model="work.position" placeholder="Position" class="input-field"/>
          <label class="block text-sm text-gray-600">From</label>
          <input type="date" v-model="work.dateFrom" class="input-field"/>
          <label class="block text-sm text-gray-600">To</label>
          <input type="date" v-model="work.dateTo" class="input-field"/>
          <button
              v-if="formData.workExperiences.length > 1"
              @click="removeWorkExperience(index)"
              class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mt-2"
          >
            Remove
          </button>
        </div>
        <button @click="addWorkExperience" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded">
          Add Work Experience
        </button>
      </div>

      <div v-if="step === 4">
        <h3 class="text-xl font-bold mb-4">Submitted data</h3>
        <pre class="bg-gray-100 p-4 rounded text-sm">
          {{ submittedData }}
        </pre>
      </div>

      <div v-if="errors">
        <div v-for="(messages, field) in errors" :key="field" class="mt-6 border p-4 rounded">
          <p class="text-red-600">{{ field }}: {{ messages[0] }}</p>
        </div>
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
            @click="submitForm"
            class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded text-lg font-medium"
        >
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import {reactive, ref} from 'vue';
import axios from 'axios';

export default {
  setup() {
    const step = ref(1);
    const formData = reactive({
      user: {
        name: '',
        surname: '',
        birthday: ''
      },
      contact: {
        email: '',
        phone: ''
      },
      workExperiences: [
        {
          company: '',
          position: '',
          dateFrom: '',
          dateTo: ''
        }
      ]
    });
    const errors = ref(null)
    const submittedData = ref(null)

    const nextStep = () => {
      if (step.value === 3) {
        for (const w of formData.workExperiences) {
          if (!w.company || !w.position) {
            errors.value = {
              'workExperiences': ['All work experience fields are required']
            }
            return
          }
        }
      }

      step.value++
    }
    const prevStep = () => step.value--;
    const addWorkExperience = () => formData.workExperiences.push({
      company: '',
      position: '',
      dateFrom: '',
      dateTo: ''
    });
    const removeWorkExperience = (index) => {
      if (formData.workExperiences.length > 1) formData.workExperiences.splice(index, 1);
    };

    const submitForm = async () => {
      try {
        const res = await axios.post('/api/user', formData);
        submittedData.value = res.data;
        errors.value = '';
        step.value = 4;
      } catch (err) {
        if (err.response?.status === 422) {
          errors.value = err.response.data;
        }
      }
    };

    return {
      step,
      formData,
      errors,
      submittedData,
      nextStep,
      prevStep,
      addWorkExperience,
      removeWorkExperience,
      submitForm
    }
  }
};
</script>
