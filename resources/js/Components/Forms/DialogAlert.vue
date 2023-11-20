<template>
  <v-dialog
    class="rounded-0 bg-white darken-2 "
    v-model="notify"
    max-width="550"
  >
  <div class="pa-4 " style="background-color: white;">
    <v-card   outlined >
      <v-card-title>{{ title }}</v-card-title>

      <v-card-actions class="justify-end">
        <v-btn color="blue darken-1" text @click="confirmDialog(true)"
          >Yes</v-btn
        >
        <v-btn color="red darken-1" text @click="confirmDialog(false)"
          >Cancel</v-btn
        >
      </v-card-actions>
    </v-card>
  </div>
  </v-dialog>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  props: {
    isPopup: {
      default: false,
    },
    color: {
      default: "black",
    },
    model: {
      default: [],
    },
    title: {
      default: "",
    },
    description: {
      default: "",
    },
  },
  computed: {
    ...mapGetters(["getForm"]),
    form() {
      return this.getForm;
    },
  },
  data() {
    return {
      notify: false,
    };
  },
  watch: {
    isPopup() {
      this.notify = true;
    },
  },
  methods: {
    confirmDialog(val) {
      if (val) {
        this.$emit("confirmDialog");
      }
      this.notify = false;
    },
  },
};
</script>
