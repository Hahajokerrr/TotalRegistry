<template>
    <Box class="flex flex-col h-full">
        <div class="flex-grow">
            <div>Biển số xe: {{ listing.car.registration_no }}</div>
            <div>Dòng xe: {{ listing.car.series.series_name }}</div>
            <div>Nơi đăng ký: {{ listing.car.province.full_name }}</div>
            <div>Chủ xe: {{ listing.car.owner.name }}</div>
            <div>Ngày đăng kiểm: {{ new Date(listing.inspection_date).toLocaleDateString('en-GB') }}</div>
            <div>Trung tâm đăng kiểm: {{ listing.user.name }}</div>
            <div v-if="listing.user.province">Nơi thực hiện đăng kiểm: {{ listing.user.province.full_name }}</div>
        </div>
        <div class="flex mt-5 gap-5 ">
            <Link :href="route('listing.show', { listing: listing.id })">Thông tin chi tiết</Link>
            <Link :href="route('listing.edit', { listing: listing.id })">Chỉnh sửa</Link>
            <div>Xóa</div>
        </div>
    </Box>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import Box from '@/Components/UI/Box.vue'

const props = defineProps({
    listing: Object,
})
</script>
