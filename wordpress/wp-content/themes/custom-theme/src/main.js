import "vite/modulepreload-polyfill";
import "virtual:svg-icons-register";
import "@/styles/main.scss";

import.meta.glob([
  "@/assets/global/**",
]);
