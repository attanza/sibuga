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
      <template v-slot:cell(no)="data">
        <a :href="`/manage/quotations/${data.item.id}`">{{ data.value }}</a>
      </template>

      <template
        v-slot:cell(company_id)="data"
      >{{ data.item.customer ? data.item.customer.name : data.value }}</template>
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
      link: "/api/quotations",
      createLink: "/manage/quotations/create",
      fields: [
        { key: "no", sortable: true },
        { key: "company_id", label: "Customer", sortable: true },
        { key: "title", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

