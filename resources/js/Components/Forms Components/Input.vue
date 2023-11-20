<template>
  <v-text-field
    v-if="debounce"


    :disabled="disabled"
    :placeholder="placeholder"
    :error-messages="errorMessages"
    :type="type"
    v-model.lazy="value"
    v-debounce="500"
    :label="label"
    :min="min"
    :max="max"
    :required="required"
  >
  </v-text-field>

  <v-text-field
    v-else
    outlined
    :disabled="disabled"
    :placeholder="placeholder"
    :error-messages="errorMessages"
    :type="type"
    v-model="value"
    :label="label"
    :min="min"
    :max="max"
    :required="required"


  >
  </v-text-field>
</template>

<script>
export default {
  props: {
    label: {
      default: "",
    },
    model: {
      default: "",
    },
    type: {
      default: "text",
    },
    disabled: {
      default: false,
    },
    debounce: {
      default: false,
    },required: {
      default: false,
    },
    placeholder: {
      default: "",
    },
    min: {
      default: 0,
    },
    max: {
      default: 999999999999,
    },
    errorMessages: {
      type: Array,
    },
  },
  data() {
    return {
      value: "",
      inputTimer: null,
    };
  },
  computed: {},
  watch: {
    model(val) {
      this.value = val;
    },
    value(val) {
      if (val) {
        clearTimeout(this.inputTimer);
      }
      this.inputTimer = setTimeout(() => {
        // Perform your desired action after the debounce time
        // For example, update a data property or make an API call
          console.log(val)
        this.$emit("changeValue", val);
      }, 10); // Set the debounce time in milliseconds
    },
  },
  mounted() {
    this.value = this.model;
  },
};
</script>
