import Vue from "vue";

/**
 * Common Components
 */

Vue.component(
    "delete-button",
    require("./components/commons/deleteButton.vue").default
);

/**
 * Company
 */
Vue.component("company-list", require("./components/company/list.vue").default);
Vue.component(
    "company-contacts",
    require("./components/company/contacts.vue").default
);
Vue.component(
    "company-products",
    require("./components/company/products.vue").default
);

/**
 * Contact
 */
Vue.component("contact-list", require("./components/contact/list.vue").default);

/**
 * Product
 */
Vue.component("product-list", require("./components/product/list.vue").default);

/**
 * Project
 */
Vue.component("project-list", require("./components/project/list.vue").default);
Vue.component(
    "project-products",
    require("./components/project/products.vue").default
);

/**
 * Quotation
 */
Vue.component(
    "quotation-list",
    require("./components/quotation/list.vue").default
);

Vue.component(
    "quotation-product-list",
    require("./components/quotationProduct/list.vue").default
);

Vue.component(
    "quotation-products",
    require("./components/quotation/products.vue").default
);

/**
 * Picture
 */
Vue.component("picture-list", require("./components/picture/list.vue").default);
Vue.component("user-list", require("./components/user/list.vue").default);
