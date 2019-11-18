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
      <template v-slot:cell(code)="data">
        <a :href="`/manage/products/${data.item.id}`">{{ data.value }}</a>
      </template>

      <template v-slot:cell(buy_price)="data">{{ currencyFormat(data.value) }}</template>
      <template v-slot:cell(sell_price)="data">{{ currencyFormat(data.value) }}</template>
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
      link: "/api/products",
      createLink: "/manage/products/create",
      fields: [
        { key: "code", sortable: true },
        { key: "name", sortable: true },
        { key: "buy_price", sortable: true },
        { key: "sell_price", sortable: true },
        { key: "lead_time", sortable: true },
        { key: "weight", label: "Weight (gr)", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

