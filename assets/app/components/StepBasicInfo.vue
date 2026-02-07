<template>
  <div>
    <h3>Basic Info</h3>
    <input v-model="formData.firstName" placeholder="First Name" />
    <input v-model="formData.lastName" placeholder="Last Name" />
    <input type="date" v-model="formData.birthDate" />
  </div>
</template>

<script>
export default {
  props: ['formData', 'errors']
};
</script>
