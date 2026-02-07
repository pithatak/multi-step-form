<template>
  <div>
    <h3>Contact Info</h3>
    <input v-model="formData.phone" placeholder="Phone number"/>
    <input v-model="formData.email" placeholder="Email"/>
  </div>
</template>

<script>
export default {
  props: ['formData', 'errors']
};
</script>
