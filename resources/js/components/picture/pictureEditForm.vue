<template>
  <div>
    <b-modal
      v-model="modalShow"
      title="Edit a Price"
      centered
      size="lg"
      header-bg-variant="primary"
      header-text-varian="light"
      hide-footer
      no-stacking
    >
      <div>
        <b-form @submit="onSubmit" @reset="onReset">
          <b-img v-if="editData" :src="editData.url" fluid alt="sibuga" class="mb-3"></b-img>

          <b-form-group label="Caption" label-for="caption">
            <b-form-input id="caption" v-model="form.caption" type="text"></b-form-input>
          </b-form-group>

          <b-form-group label="Description" label-for="description">
            <b-form-textarea id="description" v-model="form.description"></b-form-textarea>
          </b-form-group>

          <div class="d-flex justify-content-end">
            <b-button type="reset" @click="onReset">Cancel</b-button>
            <b-button variant="danger" class="mr-3 ml-3" @click="confirmShow = true">
              <i class="fa fa-trash"></i>
            </b-button>
            <b-button type="submit" variant="primary" :loading="loading">Submit</b-button>
          </div>
        </b-form>
      </div>
    </b-modal>
    <confirm-dialog :show="confirmShow" @onConfirm="processDelete" @onClose="confirmShow = false"></confirm-dialog>
  </div>
</template>

<script>
import confirmDialog from "../commons/confirmDialog";
export default {
  components: { confirmDialog },
  data() {
    return {
      modalShow: false,
      url: "/api/pictures",
      form: {
        caption: "",
        description: ""
      },
      loading: false,
      confirmShow: false
    };
  },
  props: ["show", "editData"],

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
        if (!this.form.caption && !this.form.description) {
          this.onReset();
          this.loading = false;
          return;
        }
        delete this.form["url"];
        const resp = await axios
          .put(`${this.url}/${this.editData.id}`, this.form)
          .then(res => res.data);
        this.$emit("onUpdate", resp);
        this.onReset();
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
    processDelete() {
      this.confirmShow = false;
      this.$emit("onDelete", this.editData.id);
    },
    onReset() {
      this.form = {};
      this.close();
    }
  }
};
</script>
