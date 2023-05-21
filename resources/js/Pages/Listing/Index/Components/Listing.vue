<template>
    <Box>
        <div>
            <Link :href="route('listing.show', {listing: listing.id})">
                    <div>Biển số xe: {{ listing.car.registration_no }}</div>
                    <div>Chủ xe: {{ listing.car.owner.name }}</div>
                    <div>Ngày đăng kiểm: {{ new Date(listing.inspection_date).toLocaleDateString('en-GB') }}</div>
            </Link>
        </div>
        <div class="flex mt-2">
            <Link :href="route('listing.edit', {listing: listing.id})">Chỉnh sửa</Link>
        </div>
    </Box>
</template>

<script setup>
    import {Link} from '@inertiajs/inertia-vue3'
    import Box from '@/Components/UI/Box.vue'

    const props = defineProps({
        listing: Object,
    })
</script>
