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
          <b-form-group label="Code" label-for="code">
            <b-form-input id="code" v-model="form.code" type="text" required></b-form-input>
          </b-form-group>

          <b-form-group label="Name" label-for="name">
            <b-form-input id="name" v-model="form.name" type="text" required></b-form-input>
          </b-form-group>

          <b-form-group label="Buy Price" label-for="buy_price">
            <b-form-input id="buy_price" v-model="form.buy_price" type="number"></b-form-input>
          </b-form-group>

          <b-form-group label="Sell Price" label-for="sell_price">
            <b-form-input id="sell_price" v-model="form.sell_price" type="number"></b-form-input>
          </b-form-group>

          <b-form-group label="Weight (gr)" label-for="weight">
            <b-form-input id="weight" v-model="form.weight" type="number"></b-form-input>
          </b-form-group>

          <b-form-group label="Stock" label-for="stock">
            <b-form-input id="stock" v-model="form.stock" type="number"></b-form-input>
          </b-form-group>

          <b-form-group label="Lead Time" label-for="lead_time">
            <b-form-input id="lead_time" v-model="form.lead_time" type="number"></b-form-input>
          </b-form-group>

          <b-form-group label="Description" label-for="description">
            <b-form-textarea v-model="form.description"></b-form-textarea>
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
      url: "/api/products",
      form: {
        company_id: "",
        code: "",
        name: "",
        buy_price: "",
        sell_price: "",
        stock: "",
        weight: "",
        lead_time: "",
        description: ""
      },
      loading: false
    };
  },
  props: ["show", "companyId", "editData"],
  watch: {
    show() {
      this.modalShow = this.show;
    },
    editData() {
      if (this.editData) this.form = this.editData;
    }
  },
  mounted() {
    this.form.code = `SBGP${Math.floor(Date.now() / 1000)}`;
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
        this.form.company_id = this.companyId;
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
