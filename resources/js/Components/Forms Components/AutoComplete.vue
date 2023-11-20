<template>
 <v-autocomplete
     outlined
  v-model="model"
  :items="items"
  :loading="isLoading"
  :search-input.sync="search"
  hide-no-data
  hide-selected
  item-text="text"
  item-value="value"
  :label="label"
  placeholder="Start typing to Search"
  prepend-icon="mdi-database-search"
  :error-messages="errorMessages"
    @input="changeData"
  return-object></v-autocomplete>
</template>

<script>
import axios from "axios";

export default {
  props:{
      model: {
          default: "",
      },
      label:{
      default:''
    },
    api:{
      default:''
    },
  errorMessages: {
      type: Array,
  },
  },
 data: () => ({
  isLoading: false,
  search: '',
     items:[],
     inputTimer: null,

 }),
methods:{
      changeData(val){
          this.$emit("changeValue", val.value);
      },
    SearchData() {

        if (this.items.length > 0 ) return

        // Items have already been requested
        if (this.isLoading) return

        this.isLoading = true

        // Lazily load input items
        axios.get(this.api)
            .then(res => {
                this.items = res.data} )
            .catch(err => {
            })
            .finally(() => (this.isLoading = false))
    },
},
     watch: {
         model(val) {
             this.value = val.value;
         },
         value(val) {
             console.log(val)
         },
         search(){
             this.SearchData()
         }

 },


    mounted() {
      this.SearchData()
    }
}
</script>
