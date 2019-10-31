<template>
  <div>
    <b-button variant="success" class="mb-3" @click="createFormShow=!createFormShow">Add</b-button>
    <b-row>
      <b-col v-for="item in items" :key="item.id" cols="6" md="3" class="mb-2">
        <div class="product-image-wrapper" @click="edit(item)">
          <b-img
            :src="item.url"
            :alt="item.caption || item.id"
            class="product-image"
            :style="{maxHeight: '30vh'}"
          ></b-img>
        </div>
      </b-col>
    </b-row>
    <picture-form
      :show="createFormShow"
      @onClose="formClose"
      :pictureable-id="pictureableId"
      :pictureable-type="pictureableType"
      @onAdd="onAdd"
    ></picture-form>

    <picture-edit-form
      :show="updateFormShow"
      @onClose="formClose"
      :edit-data="dataToEdit"
      @onUpdate="onUpdate"
      @onDelete="processDelete"
    ></picture-edit-form>
  </div>
</template>

<script>
import { tableMixin } from "../../mixins";
import pictureForm from "./pictureForm";
import pictureEditForm from "./pictureEditForm";
export default {
  components: {
    pictureForm,
    pictureEditForm
  },
  mixins: [tableMixin],
  data() {
    return {
      link: "/api/pictures",
      createFormShow: false,
      updateFormShow: false,
      idToDelete: "",
      dataToEdit: null
    };
  },

  props: {
    pictureableId: {
      type: String,
      required: true
    },
    pictureableType: {
      type: String,
      required: true
    }
  },

  mounted() {
    this.pagination.per_page = 50;
    this.pagination.pictureableId = this.pictureableId;
    this.pagination.pictureableType = this.pictureableType;
    this.populateData();
  },

  methods: {
    onAdd(data) {
      this.items.unshift(data);
      this.formClose();
    },

    onUpdate(data) {
      const index = this.items.findIndex(i => i.id === data.id);
      if (index != -1) {
        this.items.splice(index, 1, data);
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
      this.createFormShow = false;
      this.updateFormShow = false;
    },

    edit(data) {
      this.dataToEdit = data;
      this.updateFormShow = !this.updateFormShow;
    },
    async processDelete(id) {
      try {
        const resp = await axios
          .delete(`${this.link}/${id}`)
          .then(res => res.data);
        console.log("resp", resp);
        const index = this.items.findIndex(i => i.id === id);
        if (index != -1) {
          this.items.splice(index, 1);
        }
        this.dataToEdit = null;
      } catch (e) {
        console.log("e", e);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.product-image-wrapper {
  cursor: pointer;
}
</style>
