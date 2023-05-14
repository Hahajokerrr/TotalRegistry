<template>
    <div v-if="listing">
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
    </div>
    <div v-else>
        <div>
            Cá nhân
        </div>
        <div>
            Tên: {{ car.owner.name }}
        </div>
        <div>
            Giới tính: {{ car.owner.gender }}
        </div>
        <div>
            CCCD: {{ car.owner.citizen_id }}
        </div>
        <div>
            Ngày sinh: {{ new Date(car.owner.dob).toLocaleDateString('en-GB') }}
        </div>
        <div>
            Số điện thoại: {{ car.owner.phone }}
        </div>
        <div>
            E-mail: {{ car.owner.email }}
        </div>
        <div>
            Địa chỉ thường trú: {{ car.owner.address }}
        </div>
        <div>
            Quê quán: {{ car.owner.hometown }}
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    car: {
        type: Object,
        default: null
    },
    listing: {
        type: Object,
        default: null
    }
})
</script>
