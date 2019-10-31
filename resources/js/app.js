require("./bootstrap");

window.Vue = require("vue");
import BootstrapVue from "bootstrap-vue";
import "./vueComponents";
Vue.use(BootstrapVue);

const app = new Vue({
    el: "#app"
});
