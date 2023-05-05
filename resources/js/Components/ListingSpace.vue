<template>
<div>
    <span class ="font-bold">{{ listing.beds }} bds </span> <span class = "text-gray-400">|&nbsp;</span>

    <span class ="font-bold">{{ listing.baths }} ba </span> <span class = "text-gray-400">|&nbsp;</span>

    <span class ="font-bold">{{ listing.area }}m²</span>



</div>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>
