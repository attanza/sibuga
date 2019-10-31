<template>
  <div>
    <b-modal
      v-model="modalShow"
      title="Are you sure want to delete ?"
      centered
      header-bg-variant="primary"
      header-text-varian="light"
      @ok="handleOk"
      @cancel="close"
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
    show: {
      type: Boolean
    }
  },

  watch: {
    show() {
      this.modalShow = this.show;
    }
  },

  methods: {
    close() {
      this.$emit("onClose");
    },
    async handleOk() {
      try {
        this.$emit("onConfirm");
      } catch (e) {
        console.log("e", e);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
