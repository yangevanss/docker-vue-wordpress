import mitt from "mitt";

export const emitter = {
  install(app, options) {
    const emitter = mitt();

    app.provide("emitter", emitter);
  },
};
