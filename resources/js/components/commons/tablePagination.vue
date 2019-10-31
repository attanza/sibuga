<template>
  <div class="pagination-wrapper">
    <p>Showing {{ pagination.current_page || 1 }} to {{ pagination.to || 1 }} of {{ pagination.total || 1 }}</p>
    <paginate
      :page-count="pagination.last_page || 1"
      :click-handler="onChangePage"
      container-class="pagination"
      page-class="page-item"
      page-link-class="page-link"
      prev-class="page-item"
      prev-link-class="page-link"
      next-class="page-item"
      next-link-class="page-link"
    ></paginate>
  </div>
</template>

<script>
import Paginate from "vuejs-paginate";
export default {
  components: { paginate: Paginate },
  props: {
    pagination: {
      type: Object,
      required: true
    }
  },
  methods: {
    pageCount(page) {
      this.$emit("onChangePage", page);
    },
    onChangePage(page) {
      this.$emit("onChangePage", page);
    }
  }
};
</script>

<style lang="scss" scoped>
.pagination-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  flex-wrap: wrap;
}
</style>
