<template>
    <div>
        <input type="file" @change="handleFileChange" accept=".xls, .xlsx"> <br>
        <button @click="importCars" :disabled="!file">Import Cars</button>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const file = ref(null);

function handleFileChange(event) {
    file.value = event.target.files[0];
}

function importCars() {
    const formData = new FormData();
    formData.append('excel_file', file.value);

    axios.post(route('car-import'), formData)
        .then(response => {
            console.log('Cars imported successfully');
        })
        .catch(error => {
            console.error('Error importing cars', error);
        });
}
</script>
