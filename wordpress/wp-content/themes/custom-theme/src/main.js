import "vite/modulepreload-polyfill";
import "virtual:svg-icons-register";
import "@/styles/main.scss";

import WebFont from "webfontloader";

import.meta.glob([
  "@/assets/global/**",
]);

WebFont.load({
  google: {
    families: ["Noto Sans TC:300,400,700&display=swap"],
  },
});
