import "./style.scss";
import { createApp } from "vue";

import "./components/HelloWorld/index";

import Icon from "@/components/vue/Icon/index.vue";
import HelloWorld from "@/components/vue/Helloworld/index.vue";

const app = createApp({
  components: {
    Icon,
    HelloWorld,
  },
});

app.mount("#app");
