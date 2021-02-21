import Vue from "vue";
import Vue2Filters from 'vue2-filters'

Vue.use(Vue2Filters)

Vue.filter("formatNumber", value => {
    return value.toLocaleString();
  });
