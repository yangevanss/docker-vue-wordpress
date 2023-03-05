import "./style.scss";
import { createApp } from "vue";
import { webFont } from "@/plugins/webFont";
import { globalComponents } from "@/plugins/globalComponents";
import { emitter } from "@/plugins/emitter";
import { breakpoints } from "@/plugins/breakpoints";

import "./components/HelloWorld/index";

import HelloWorld from "@/components/vue/Helloworld/index.vue";

const app = createApp({
  delimiters: ["{$", "$}"],
  components: {
    HelloWorld,
  },
});

app.use(webFont);
app.use(globalComponents);
app.use(emitter);
app.use(breakpoints);

app.mount("#app");
