<template>
  <div>
    <h3>Work experience Info</h3>
    <input v-model="formData.company" placeholder="Company name"/>
    <input v-model="formData.position" placeholder="Position name"/>
    <input type="date" v-model="formData.dateFrom"/>
    <input type="date" v-model="formData.dateTo"/>
  </div>
</template>

<script>
export default {
  props: ['formData', 'errors']
};
</script>
