<template>
  <div>
    <button class="btn btn-danger circle" @click="modalShow = true">
      <i class="fa fa-trash"></i>
    </button>
    <b-modal
      v-model="modalShow"
      title="Are you sure want to delete ?"
      centered
      header-bg-variant="primary"
      header-text-varian="light"
      @ok="handleOk"
    >This process cannot be un done</b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modalShow: false
    };
  },
  props: {
    deleteUrl: {
      type: String,
      required: true
    },
    backUrl: {
      type: String,
      required: true
    }
  },

  methods: {
    async handleOk() {
      try {
        const resp = await axios.delete(this.deleteUrl);
        window.location.href = this.backUrl;
      } catch (e) {
        if (e.response.status === 400) {
          this.$bvToast.toast(e.response.data, {
            title: "Delete Failed",
            autoHideDelay: 5000,
            variant: "danger"
          });
        }
      }
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
