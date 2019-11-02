<template>
  <div>
    <b-button variant="success" class="mb-3" @click="formShow=!formShow">Add</b-button>
    <b-table
      hover
      :items="products"
      :fields="fields"
      responsive
      stacked="sm"
      primary-key="id"
      :busy="loading"
    >
      <template v-slot:cell(code)="data">
        <a :href="`/manage/products/${data.item.id}`">{{ data.value }}</a>
      </template>

      <template v-slot:cell(edit)="data">
        <b-button variant="danger" size="sm" @click="showConfirm(data.item.id)">
          <i class="nav-icon fas fa-trash"></i>
        </b-button>
      </template>
    </b-table>
    <product-form
      :show="formShow"
      @onClose="formClose"
      :company-id="companyId"
      :edit-data="dataToEdit"
      @onAdd="onAdd"
      @onUpdate="onUpdate"
    ></product-form>
    <confirm-dialog :show="confirmShow" @onConfirm="processDelete" @onClose="confirmShow = false"></confirm-dialog>
  </div>
</template>

<script>
import { tableMixin } from "../../mixins";
import { tablePagination, tableHeader } from "../commons";
import productForm from "./productForm";
import confirmDialog from "../commons/confirmDialog";
export default {
  components: { tablePagination, tableHeader, productForm, confirmDialog },
  mixins: [tableMixin],
  data() {
    return {
      link: "/api/products",
      fields: [
        { key: "code", sortable: true },
        { key: "name", sortable: true },
        { key: "buy_price", sortable: true },
        { key: "sell_price", sortable: true },
        { key: "edit", sortable: false }
      ],
      products: [],
      formShow: false,
      confirmShow: false,
      idToDelete: "",
      dataToEdit: null
    };
  },

  props: {
    companyId: {
      type: String,
      required: true
    }
  },

  mounted() {
    this.pagination.per_page = 50;
    this.pagination.filterBy = "company_id";
    this.pagination.filterValue = this.companyId;
    this.populateData("products");
  },

  methods: {
    onAdd(data) {
      this.products.unshift(data);
      this.formClose();
    },

    onUpdate(data) {
      const index = this.products.findIndex(i => i.id === data.id);
      if (index != -1) {
        this.products.splice(index, 1, data);
      }
      this.formClose();
    },

    showConfirm(id) {
      this.idToDelete = id;
      this.confirmShow = !this.confirmShow;
    },

    formClose() {
      this.idToDelete = "";
      this.dataToEdit = null;
      this.formShow = false;
    },

    edit(data) {
      this.dataToEdit = data;
      this.formShow = !this.formShow;
    },

    async processDelete() {
      try {
        const resp = await axios
          .delete(`${this.link}/${this.idToDelete}`)
          .then(res => res.data);

        const index = this.products.findIndex(i => i.id === this.idToDelete);
        if (index != -1) {
          this.products.splice(index, 1);
        }
        this.idToDelete = "";
        this.confirmShow = false;
      } catch (e) {
        console.log("e", e);
      }
    }
  }
};
</script>
