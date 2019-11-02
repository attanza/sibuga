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
        <a :href="`/manage/projects/${data.item.id}`">{{ data.value }}</a>
      </template>

      <template
        v-slot:cell(quotation_id)="data"
      >{{ data.item.quotation && data.item.quotation.customer ? data.item.quotation.customer.name : data.value }}</template>

      <template v-slot:cell(amount)="data">{{ currencyFormat(data.value) }}</template>
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
      link: "/api/projects",
      createLink: "/manage/projects/create",
      fields: [
        { key: "code", sortable: true },
        { key: "title", sortable: true },
        { key: "quotation_id", label: "Company", sortable: true },
        { key: "amount", sortable: true },
        { key: "status", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

