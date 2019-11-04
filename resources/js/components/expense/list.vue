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
        <a :href="`/manage/expenses/${data.item.id}`">{{ data.value }}</a>
      </template>

      <template
        v-slot:cell(project_id)="data"
      >{{ data.item.project ? data.item.project.code : data.value }}</template>
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
      link: "/api/expenses",
      createLink: "/manage/expenses/create",
      fields: [
        { key: "code", sortable: true },
        { key: "project_id", label: "Project", sortable: true },
        { key: "item", sortable: true },
        { key: "amount", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

