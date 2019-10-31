<template>
  <b-card>
    <tableHeader @onPerPageChange="onPerPageChange" @onSearch="onSearch" :create-link="createLink"></tableHeader>
    <hr />
    <b-table
      hover
      :items="items"
      :fields="fields"
      responsive
      stacked="sm"
      primary-key="id"
      :busy="loading"
    >
      <template v-slot:cell(quotation_id)="data">
        <a
          :href="`/manage/quotation-products/${data.item.id}`"
        >{{ data.item.quotation ? data.item.quotation.no : data.value }}</a>
      </template>

      <template
        v-slot:cell(product_id)="data"
      >{{ data.item.product ? data.item.product.name : data.value }}</template>

      <template v-slot:cell(price)="data">{{ currencyFormat(data.value) }}</template>
    </b-table>
    <hr />
    <tablePagination :pagination="pagination" @onChangePage="onChangePage"></tablePagination>
  </b-card>
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
        { key: "quotation_id", label: "Quotation", sortable: true },
        { key: "product_id", label: "Product", sortable: true },
        { key: "qty", sortable: true },
        { key: "price", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

