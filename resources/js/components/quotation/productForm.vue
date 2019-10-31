<template>
  <div>
    <b-modal
      v-model="modalShow"
      title="Add a Product"
      centered
      size="lg"
      header-bg-variant="primary"
      header-text-varian="light"
      hide-footer
    >
      <div>
        <b-form @submit="onSubmit" @reset="onReset">
          <b-form-group label="Product" label-for="productId">
            <b-form-select v-model="form.product_id" :options="productData" required></b-form-select>
          </b-form-group>

          <b-form-group label="Quantity" label-for="qty">
            <b-form-input id="qty" v-model="form.qty" type="number" required></b-form-input>
          </b-form-group>
          <b-form-group label="Price" label-for="price">
            <b-form-input id="price" v-model="form.price" type="number" required></b-form-input>
          </b-form-group>
          <b-form-group label="Note" label-for="note">
            <b-form-input id="note" v-model="form.note" type="text"></b-form-input>
          </b-form-group>
          <div class="d-flex justify-content-between">
            <b-button type="reset" @click="onReset">Cancel</b-button>
            <b-button type="submit" variant="primary" :loading="loading">Submit</b-button>
          </div>
        </b-form>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modalShow: false,
      productData: [],
      form: {
        product_id: "",
        qty: "",
        price: "",
        note: ""
      },
      loading: false
    };
  },
  props: ["show", "products", "quotationId", "editData"],
  watch: {
    show() {
      this.modalShow = this.show;
    },
    editData() {
      if (this.editData) this.form = this.editData;
    }
  },
  mounted() {
    if (this.products) {
      this.products.map(p =>
        this.productData.push({
          value: p.id,
          text: p.name
        })
      );
    }
  },
  methods: {
    close() {
      this.$emit("onClose");
    },
    makeToast(variant = "danger", text = "", title = "") {
      this.$bvToast.toast(text, {
        title,
        variant,
        solid: true
      });
    },
    async onSubmit(e) {
      try {
        this.loading = true;
        e.preventDefault();
        this.form.quotation_id = this.quotationId;
        let resp;
        if (this.editData) {
          resp = await axios
            .put("/api/quotation-products/" + this.editData.id, this.form)
            .then(res => res.data);
          this.$emit("onUpdate", resp);
        } else {
          resp = await axios
            .post("/api/quotation-products", this.form)
            .then(res => res.data);
          this.$emit("onAdd", resp);
        }

        this.loading = false;
      } catch (e) {
        this.makeToast(
          "danger",
          Object.values(e.response.data.errors)[0],
          "Validation Error"
        );
        this.loading = false;
      }
    },
    onReset() {
      this.form = {};
      this.close();
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
