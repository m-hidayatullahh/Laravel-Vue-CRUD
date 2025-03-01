<template>
    <form @submit.prevent="submit">
      <input v-model="form.nama" placeholder="Nama" required />
      <input v-model="form.nik" placeholder="NIK" required />
      <input v-model="form.alamat" placeholder="Alamat" required />
      <input type="file" @change="handleFile" required />
      <button type="submit">Daftar</button>
    </form>
  </template>

  <script setup>
  import { ref } from "vue";
  import api from "../api";

  const form = ref({ nama: "", nik: "", alamat: "", ktp_path: null });

  const handleFile = (event) => {
    form.value.ktp_path = event.target.files[0];
  };

  const submit = async () => {
    let formData = new FormData();
    formData.append("nama", form.value.nama);
    formData.append("nik", form.value.nik);
    formData.append("alamat", form.value.alamat);
    formData.append("ktp_path", form.value.ktp_path);

    await api.post("/warga", formData);
    alert("Pendaftaran berhasil!");
  };
  </script>
