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
      <template v-slot:cell(project_id)="data">
        <a :href="`/manage/expenses/${data.item.id}`">{{ data.item.project.code || data.value }}</a>
      </template>
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
        { key: "project_id", lable: "Project", sortable: true },
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

