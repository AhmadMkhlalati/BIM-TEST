<template>
 <v-textarea
     outlined
  :error-messages="errorMessages"
  :rows="rows"
  :type="type"
  v-model="value"
  :label="label"></v-textarea>
</template>

<script>
export default {
 props: {
  label: {
   default: ''
  },
  model: {
   default: ''
  },
  type: {
   default: 'text'
  },
  rows: {
   default: 3
  },
  errorMessages: {
   type: Array
  },

 },
 data() {
  return {
   value: ''
  }
 },
 computed: {

 },
 watch: {
  model(val) {
   this.value = val
  },
  value(val) {

   this.$emit('changeValue',
    val,
   )
  }
 },
 mounted() {
  this.value = this.model
 }
}
</script>
