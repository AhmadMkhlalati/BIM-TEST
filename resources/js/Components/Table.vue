<template>
  <div>
    <Title :title="title" class="text-center"></Title>
    <v-data-table
      :headers="headers"
      :items="tableData.data"
      :loading="loading"
      :search="search"
      sort-by="calories"
      class="elevation-1 pt-10"
      :page.sync="tableData.current_page"
      hide-default-footer

    >

      <template v-slot:[`item.created_at`]="{ item }">
        {{ formatDate(item.created_at) }}
      </template>


      <template v-slot:top>
        <div>
          <v-toolbar flat>
            <Input
              :model="search"
              class="mx-4"
              label="Search"
            ></Input>

            <div v-if="create" @click="openForm()">
              <Button
                v-if="newItemLabel"
                :label="`New ${newItemLabel}`"
                color="primary"
              >
              </Button>
            </div>
          </v-toolbar>
        </div>
      </template>


      <template v-slot:[`item.actions`]="{ item }">
        <div class="text-center">
          <v-menu offset-y>
            <template
              v-slot:activator="{ on }"
              v-if="edit || del || show || payment"
            >
              <v-btn small dark color="primary" v-on="on"> Actions</v-btn>
            </template>
            <v-list>
              <v-list-item v-if="edit" @click="openForm(item)">
                <v-list-item-title> Edit </v-list-item-title>
                <v-list-item-icon>
                  <v-icon small> mdi-pencil</v-icon>
                </v-list-item-icon>
              </v-list-item>

              <v-list-item v-if="del" @click="openDeleteDialog(item)">
                <v-list-item-title>{{ titleDeleteButton }} </v-list-item-title>
                <v-list-item-icon>
                  <v-icon small> mdi-delete</v-icon>
                </v-list-item-icon>
              </v-list-item>
                <v-list-item v-if="payment" @click="openFormPayment(item)">
                    <v-list-item-title>payment </v-list-item-title>
                    <v-list-item-icon>
                        <v-icon small> mdi-plus</v-icon>
                    </v-list-item-icon>
                </v-list-item>

              <v-list-item
                  v-if="show"  @click="openUrl(api.show + item.id)"
              >
                <v-list-item-title>show </v-list-item-title>
                <v-list-item-icon>
                  <v-icon small> mdi-eye</v-icon>
                </v-list-item-icon>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
      </template>
    </v-data-table>
    <v-card class="mt-3 align-left">
      <v-row wrap>
        <v-col cols="12" md="6">
          <v-pagination
            total-visible="6"
            :value="parseInt(current_page)"
            :model="parseInt(current_page)"
            color="#2170B4"
            :length="tableData.last_page"
            prev-icon="mdi-arrow-left"
            next-icon="mdi-arrow-right"
            @input="updatePage"
          >
          </v-pagination>
        </v-col>
        <v-col cols="12" md="2">
          <Input
            :model="current_page"
            label="Page"
            hide-details
            @changeValue="updatePage"
          ></Input>
        </v-col>
      </v-row>
    </v-card>
    <DialogAlert
      :title="titleDelete"
      :isPopup="dialogDelete"
      :page="parseInt(current_page)"
      :model="model"
      @confirmDialog="deleteItemConfirm"
    ></DialogAlert>

  </div>
</template>

<script>

import { mapGetters, mapActions } from "vuex";

export default {
  props: {
    headers: Array,
    title: String,
    titleDelete: {
      type: String,
      default: "Are you sure you want to delete this item ?",
    },
    inventoryTitle: {
      type: String,
      default: "Inventory Title",
    },
    titleDeleteButton: {
      type: String,
      default: "Delete",
    },
    api: Object,

    queryParam: {
      default: "",
    },
    newItemLabel: {
      default: "item",
    },
    route_name: {
      default: "",
    },
    create: {
      default: true,
    },
    block: {
      default: false,
    },
    edit: {
      default: true,
    },
    del: {
      default: true,
    },
    download: {
      default: false,
    },
    inventory: {
      default: false,
    },
    edit_rate_to_sy: {
      default: false,
    },
    show: {
      default: false,
    },
      payment: {
          default: false,
      },
    isSlots: {
      default: false,
    },
    subscribe: {
      default: false,
    },
    resend: {
      default: false,
    },
    message: {
      default: false,
    },
    exchange_sim: {
      default: false,
    },
    pay: {
      default: false,
    },
    TypeInventory: {
      default: "Money",
    },
  },
  data: () => ({
    editRateToSyTitle: "black",
    color: "black",
    current_page: 1,
    model: {},
    inventoryModel: {},
    editRateToSyModel: {},
    slots: [],
    search: null,
    dialog: false,
    dialogOrder: false,
    dialogEditRateToSy: false,
    dialogInventory: false,
    dialogDelete: false,
    tempData: [],
    per_page: 10,
  }),
  computed: {
    ...mapGetters(["getTableData","getLoading"]),
    loading() {
      return this.getLoading;
    },
    tableData() {
      return this.getTableData;
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    per_page() {
      this.getData();
    },
    search(val) {
      if (val == null) {
        this.getData;
      }
    },
  },
  methods: {
    ...mapActions(["fetchTableData", "deleteItem", "setForm"]),
    updatePage(val) {
      this.current_page = val;
      this.$emit("update_page", parseInt(val));

      this.getData(val);
    },
      openUrl(link) {
          window.open(link);
      },
    getData(page = 1) {
      this.tempData = this.tableData;
      this.fetchTableData({
        api: this.api,
        per_page: this.per_page,
        page: page,
      });
    },
    formatDate(val, on_time) {
      var data = new Date(val);
      var string =
        data.getUTCFullYear() +
        "-" +
        (data.getUTCMonth() + 1) +
        "-" +
        data.getDate();

      if (on_time == null) {
        string +=
          " " +
          data.getHours() +
          ":" +
          data.getMinutes() +
          ":" +
          data.getSeconds();
      }
      return string;
    },

    openForm(item = null) {
      this.$emit("openForm", item);
    },


    openDeleteDialog(item) {
      this.model = item;
      this.dialogDelete = !this.dialogDelete;
    },

    openFormPayment(item = null) {
        this.$emit("openFormPayment", item);
    },

    deleteItemConfirm() {
      this.deleteItem({
        api: this.api,
        id: this.model.id, // item id
        page: this.current_page,
      });
    },
    close() {
      this.dialog = false;
    },
    closeDelete() {
      this.dialogDelete = false;
    },

  },
  async mounted() {
    await this.getData();
    if (this.isSlots) {
      this.slots = this.headers;
    }
  },
};
</script>
