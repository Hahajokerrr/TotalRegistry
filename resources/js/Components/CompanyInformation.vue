<template>
    <div v-if="listing">
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
    </div>
    <div v-else>
        <div>
            Doanh nghiệp
        </div>
        <div>
            Tên: {{ car.owner.name }}
        </div>
        <div>
            Địa chỉ: {{ car.owner.address }}
        </div>
        <div>
            Số điện thoại: {{ car.owner.phone }}
        </div>
        <div>
            E-mail: {{ car.owner.email }}
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
