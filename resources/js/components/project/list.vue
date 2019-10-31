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
        v-slot:cell(company_id)="data"
      >{{ data.item.company ? data.item.company.name : data.value }}</template>

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
        { key: "company_id", label: "Company", sortable: true },
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

