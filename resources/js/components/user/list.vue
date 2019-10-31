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
        <a :href="`/manage/users/${data.item.id}`">{{ data.value }}</a>
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
      link: "/api/users",
      createLink: "/manage/users/create",
      fields: [
        { key: "name", sortable: true },
        { key: "email", sortable: true }
      ]
    };
  },

  mounted() {
    this.populateData();
  }
};
</script>

