import View from "./components/View.vue";

panel.plugin("vendor/plugin", {
  views: {
    example: {
      component: View,
      icon: "preview",
      label: "Example"
    }
  }
});
