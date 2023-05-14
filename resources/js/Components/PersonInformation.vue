<template>
    <div>
        Cá nhân
    </div>
    <div>
        Tên: {{ listing.car.owner.name }}
    </div>
    <div>
        Giới tính: {{ listing.car.owner.gender }}
    </div>
    <div>
        CCCD: {{ listing.car.owner.citizen_id }}
    </div>
    <div>
        Ngày sinh: {{ new Date(listing.car.owner.dob).toLocaleDateString('en-GB') }}
    </div>
    <div>
        Số điện thoại: {{ listing.car.owner.phone }}
    </div>
    <div>
        E-mail: {{ listing.car.owner.email }}
    </div>
    <div>
        Địa chỉ thường trú: {{ listing.car.owner.address }}
    </div>
    <div>
        Quê quán: {{ listing.car.owner.hometown }}
    </div>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>
