<template>
  <div>
    <b-modal
      v-model="modalShow"
      title="Add a Contact"
      centered
      size="lg"
      header-bg-variant="primary"
      header-text-varian="light"
      hide-footer
    >
      <div>
        <b-form @submit="onSubmit" @reset="onReset">
          <b-form-group label="Name" label-for="name">
            <b-form-input id="name" v-model="form.name" type="text" required></b-form-input>
          </b-form-group>

          <b-form-group label="Phone" label-for="phone">
            <b-form-input id="phone" v-model="form.phone" type="text" required></b-form-input>
          </b-form-group>

          <b-form-group label="Email" label-for="email">
            <b-form-input id="email" v-model="form.email" type="email" required></b-form-input>
          </b-form-group>

          <b-form-group label="Gender" label-for="gender">
            <b-form-select v-model="form.gender" :options="genders"></b-form-select>
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
      url: "/api/contacts",
      form: {
        name: "",
        phone: "",
        email: "",
        gender: ""
      },
      genders: [
        { value: "Male", text: "Male" },
        { value: "Female", text: "Female" }
      ],
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
