<template>
    <div>
        <p>{{label}}</p>
 <v-date-picker

  full-width
  v-model="value"

  class="mt-4"></v-date-picker>
    <span  style="color:red;">{{errorMessages}}</span>
    </div>
</template>

<script>
export default {
    props:{
        label:'',
        errorMessages:'',
        model: {
            default: "",
        },
    },
 data() {
  return {
   value: '',

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
