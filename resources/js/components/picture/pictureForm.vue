<template>
  <div>
    <b-modal
      v-model="modalShow"
      title="Add a Picture"
      centered
      size="lg"
      header-bg-variant="primary"
      header-text-varian="light"
      hide-footer
    >
      <div>
        <vue-dropzone
          ref="myVueDropzone"
          id="dropzone"
          :options="dropzoneOptions"
          v-on:vdropzone-sending="sendingEvent"
          v-on:vdropzone-success="dropzoneSuccess"
          v-on:vdropzone-error="dropzoneError"
          destroyDropzone
        ></vue-dropzone>
      </div>
    </b-modal>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      modalShow: false,

      loading: false,
      dropzoneOptions: {
        url: "/api/pictures",
        thumbnailWidth: 150,
        maxFilesize: 0.5,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        acceptedFiles: "image/*"
      }
    };
  },
  props: ["show", "pictureableId", "pictureableType"],
  watch: {
    show() {
      this.modalShow = this.show;
    }
  },

  methods: {
    sendingEvent(file, xhr, formData) {
      formData.append("pictureable_id", this.pictureableId);
      formData.append("pictureable_type", this.pictureableType);
    },
    dropzoneSuccess(file, response) {
      this.onReset();
      this.$emit("onAdd", response);
    },
    dropzoneError(file, message, xhr) {
      this.$bvToast.toast(message, {
        title: "Error",
        variant: "danger",
        solid: true
      });
    },
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
    onReset() {
      this.form = {};
      this.close();
    }
  }
};
</script>
