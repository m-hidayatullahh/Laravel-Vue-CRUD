<template>
    <div>
      <h2>Daftar Warga</h2>
      <input v-model="search" @input="fetchWarga" placeholder="Cari Nama / NIK" />
      <ul>
        <li v-for="w in warga" :key="w.id">
          {{ w.nama }} - {{ w.nik }}
          <button @click="hapusWarga(w.id)">Hapus</button>
        </li>
      </ul>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from "vue";
  import api from "../api";

  const warga = ref([]);
  const search = ref("");

  const fetchWarga = async () => {
    const response = await api.get("/warga", { params: { search: search.value } });
    warga.value = response.data.data;
  };

  const hapusWarga = async (id) => {
    if (confirm("Yakin hapus warga ini?")) {
      await api.delete(`/warga/${id}`);
      fetchWarga();
    }
  };

  onMounted(fetchWarga);
  </script>

  <style scoped>
  button {
    margin-left: 10px;
  }
  </style>
