<template>
    <span>
    Biển số xe: {{ car.registration_no }}
    </span>
</template>

<script setup>
defineProps({
    listing: Object,
    car: Object
})
</script>
