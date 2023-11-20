<template>
 <v-btn
  :target="target"
  :href="href"
  :type="type"
  :color="color"
  dark
  class="mb-2 sm10 "
  :class="classes">
  {{label}}
  <v-img
   v-if="image"
   max-width="40px"
   :src="image"></v-img>
  <v-icon
   class="ms-2"
   v-if="icon">
   {{icon}}
  </v-icon>
  <v-fade-transition>
   <Loading
    v-if="!isLoad"
    class="mx-2"
    containerClasses=""
    :size="20"
    color="white"></Loading>
  </v-fade-transition>
 </v-btn>
</template>

<script>
export default {
 props: {
  color: {
   default: "primary"
  },
  label: {
   default: ""
  },
  classes: {
   default: ""
  },
  type: {
   default: ""
  },
  isLoad: {
   default: true
  },
  icon: {
   default: ''
  },
  image: {
   default: ''
  },
  href: {
   default: ''
  },
  target: {
   default: ''
  },
 },
}
</script>
