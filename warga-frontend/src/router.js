import { createRouter, createWebHistory } from "vue-router";
import WargaForm from "./components/WargaForm.vue";
import WargaList from "./components/WargaList.vue";

const routes = [
  { path: "/", component: WargaForm },
  { path: "/warga", component: WargaList },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
