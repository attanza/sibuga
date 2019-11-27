<template>
  <b-container fluid>
    <b-row>
      <b-col md="4" class="mb-2">
        <b-input-group prepend="Show">
          <b-form-select :options="pageOptions" v-model="perPage"></b-form-select>
        </b-input-group>
      </b-col>
      <b-col md="4" class="mb-2">
        <b-form-group class="mb-0">
          <b-input-group>
            <b-form-input v-model="search" placeholder="Type to Search"></b-form-input>
            <b-input-group-append>
              <b-button :disabled="search === ''" @click="search = ''">
                <i class="fa fa-times"></i>
              </b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-col md="4">
        <div class="d-sm-flex">
          <a v-if="exportLink != ''" :href="exportLink" class="btn btn-success mr-3">Export</a>
          <b-button variant="primary" block @click="create">
            <i class="fa fa-plus"></i>
          </b-button>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import debounce from "lodash/debounce";
export default {
  data() {
    return {
      selected: null,
      pageOptions: [
        { value: 10, text: 10 },
        { value: 25, text: 25 },
        { value: 50, text: 50 },
        { value: 100, text: 100 }
      ],
      perPage: 10,
      search: ""
    };
  },
  props: {
    createLink: {
      type: String,
      required: true
    },
    exportLink: {
      type: String,
      required: false,
      default: ""
    }
  },
  mounted() {
    console.log("EXPORT LINK", this.exportLink);
  },
  watch: {
    perPage() {
      this.$emit("onPerPageChange", this.perPage);
    },
    search: {
      handler: debounce(function() {
        this.$emit("onSearch", this.search);
      }, 500)
    }
  },
  methods: {
    create() {
      window.location.href = this.createLink;
    }
  }
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  flex-wrap: wrap;
}
</style>
