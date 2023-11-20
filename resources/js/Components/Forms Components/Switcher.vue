<template>
 <v-switch
  flat
  inset
  v-model="value"
  :label="label"
  :error-messages="errorMessages"
  class="mx-2 mt-3 d-flex">
 </v-switch>
</template>

<script>
export default {
 props: {
  label: String,
  attr: String,
  model: {
   default: 0
  },
 errorMessages: {
     type: Array,
 },
 },
 data() {
  return {
   value: false
  }

 },
 watch: {
  value(val) {
   this.$emit('switcher',  val === true ? 1 : 0)
  },
  model(val) {
   this.value = val === 1

  }
 },
 mounted() {
  this.value = this.model === 1
 }

}
</script>
