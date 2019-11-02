<template>
  <div>
    <b-table
      hover
      :items="items"
      :fields="fields"
      responsive
      stacked="sm"
      primary-key="id"
      :busy="loading"
    >
      <template v-slot:cell(product_id)="data">{{ data.item.product.name || data.value}}</template>
      <template v-slot:cell(price)="data">{{ currencyFormat(data.value) }}</template>
    </b-table>
  </div>
</template>

<script>
import { tableMixin } from "../../mixins";
import { tablePagination, tableHeader } from "../commons";
export default {
  components: { tablePagination, tableHeader },
  mixins: [tableMixin],
  data() {
    return {
      link: "/api/quotation-products",
      createLink: "/manage/quotation-products/create",
      fields: [
        { key: "product_id", label: "Product", sortable: true },
        { key: "qty", sortable: true },
        { key: "price", sortable: true },
        { key: "note", sortable: false }
      ]
    };
  },

  props: {
    products: {
      type: Array,
      required: true
    }
  },

  mounted() {
    console.log("this.products", this.products);
    this.items = this.products;
  }
};
</script>
