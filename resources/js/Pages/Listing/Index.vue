<template>
    <div class = "grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
         <div v-for="listing in listings.data" :key="listing.id" :listing="listing">
            <Box>
                {{ listing.car.id }}, {{listing.inspection_date}}
            </Box>
        </div>
    </div>

    <div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links">

        </Pagination>
    </div>
</template>

<script>
// import Pagination from 'resources/Components/UI/Pagination.vue';
import Box from '@/Components/UI/Box.vue';
import Pagination from '@/Components/UI/Pagination.vue';
</script>

<script setup>

defineProps({
    listings: Object,
    // filters: Object,
})
</script>

