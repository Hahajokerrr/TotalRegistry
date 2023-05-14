<template>
    <div>
    Biển số xe: {{ listing.car.registration_no }}
    </div>
    <div>
        Dòng xe: {{listing.car.series.series_name}} <br>
        Hãng xe: {{listing.car.series.brand.brand_name}} <br>
        Xuất xứ: {{ listing.car.series.country.country_name }} <br>
        Thông số kỹ thuật:
        <div class="ml-3">
            Chiều dài: {{ listing.car.series.length }} cm<br>
            Chiều rộng: {{ listing.car.series.width }} cm<br>
            Chiều cao: {{ listing.car.series.height }} cm<br>
            Khối lượng: {{ listing.car.series.weight }} kg<br>
            Trọng tải: {{ listing.car.series.payload }} kg<br>
            Số ghế: {{ listing.car.series.seat }} ghế<br>
            Công suất động cơ: {{ listing.car.series.output }} kW
        </div>
    </div>
</template>

<script setup>
defineProps({
    listing: Object
})
</script>
