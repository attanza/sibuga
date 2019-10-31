<template>
  <div>
    <b-modal
      v-model="modalShow"
      title="Add a Price"
      centered
      size="lg"
      header-bg-variant="primary"
      header-text-varian="light"
      hide-footer
    >
      <div>
        <b-form @submit="onSubmit" @reset="onReset">
          <b-form-group label="Quantity" label-for="qty">
            <b-form-input id="qty" v-model="form.qty" type="number" required></b-form-input>
          </b-form-group>

          <b-form-group label="Price" label-for="price">
            <b-form-input id="price" v-model="form.price" type="number" required></b-form-input>
          </b-form-group>

          <b-form-group label="Lead Time" label-for="lead_time">
            <b-form-input id="lead_time" v-model="form.lead_time" type="number"></b-form-input>
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
      url: "/api/product-prices",
      form: {
        qty: "",
        price: "",
        lead_time: ""
      },
      loading: false
    };
  },
  props: ["show", "productId", "editData"],
  watch: {
    show() {
      this.modalShow = this.show;
    },
    editData() {
      if (this.editData) this.form = this.editData;
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
        this.form.product_id = this.productId;
        let resp;
        if (this.editData) {
          resp = await axios
            .put(this.url + "/" + this.editData.id, this.form)
            .then(res => res.data);
          this.$emit("onUpdate", resp);
        } else {
          resp = await axios.post(this.url, this.form).then(res => res.data);
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
