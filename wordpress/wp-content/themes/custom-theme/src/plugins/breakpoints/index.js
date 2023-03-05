import { useBreakpoints as useBreakpointsCore } from "@vueuse/core";

export const breakpoints = {
  install(app, options) {
    const breakpoints = useBreakpointsCore({
      xs: 0,
      sm: 576,
      md: 768,
      lg: 992,
      xl: 1200,
      xxl: 1400,
    });

    app.provide("breakpoints", breakpoints);
  },
};
