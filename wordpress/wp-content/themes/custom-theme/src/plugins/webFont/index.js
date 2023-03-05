import WebFont from "webfontloader";
import deepmerge from "deepmerge";

export const webFont = {
  install(app, options = {}) {
    WebFont.load(deepmerge({}, options));
  },
};
