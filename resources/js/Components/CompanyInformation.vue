<template>
    <div>
        Doanh nghiệp
    </div>
    <div>
        Tên: {{ listing.car.owner.name }}
    </div>
    <div>
        Địa chỉ: {{ listing.car.owner.address }}
    </div>
    <div>
        Số điện thoại: {{ listing.car.owner.phone }}
    </div>
    <div>
        E-mail: {{ listing.car.owner.email }}
    </div>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>
