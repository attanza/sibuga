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
      <template v-slot:cell(product_id)="data">
        <a
          :href="`/manage/product-prices/${data.item.id}`"
        >{{ data.item.product ? data.item.product.name : data.value }}</a>
      </template>

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
      link: "/api/product-prices",
      createLink: "/manage/product-prices/create",
      fields: [
        { key: "product_id", label: "Product", sortable: true },
        { key: "qty", sortable: true },
        { key: "price", sortable: true },
        { key: "lead_time", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

