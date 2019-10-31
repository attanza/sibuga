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
      <template v-slot:cell(name)="data">
        <a :href="`/manage/contacts/${data.item.id}`">{{ data.value }}</a>
      </template>

      <template
        v-slot:cell(company_id)="data"
      >{{ data.item.company ? data.item.company.name : data.item.id}}</template>
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
      link: "/api/contacts",
      createLink: "/manage/contacts/create",
      fields: [
        { key: "company_id", label: "Company", sortable: true },
        { key: "name", sortable: true },
        { key: "phone", sortable: true },
        { key: "email", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

