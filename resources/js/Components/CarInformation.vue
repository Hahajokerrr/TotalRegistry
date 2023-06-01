<template>
    <div v-if="listing">
        <div>
        Biển số xe: {{ listing.car.registration_no }}
        </div>
        <div>
            Dòng xe: {{listing.car.series.series_name}} <br>
            Hãng xe: {{listing.car.series.brand.brand_name}} <br>
            Xuất xứ: {{ listing.car.series.country.country_name }} <br>
            Nơi đăng ký: {{ listing.car.province.full_name }} <br>
            Thông số kỹ thuật:
            <div class="ml-3">
                Số khung: {{ listing.car.chasis_no }} <br>
                Số máy: {{ listing.car.engine_no }} <br>
                Chiều dài: {{ listing.car.series.length }} cm<br>
                Chiều rộng: {{ listing.car.series.width }} cm<br>
                Chiều cao: {{ listing.car.series.height }} cm<br>
                Khối lượng: {{ listing.car.series.weight }} kg<br>
                Trọng tải: {{ listing.car.series.payload }} kg<br>
                Số ghế: {{ listing.car.series.seat }} ghế<br>
                Công suất động cơ: {{ listing.car.series.output }} kW
            </div>
        </div>
    </div>
    <div v-else>
        <div>
        Biển số xe: {{ car.registration_no }}
        </div>
        <div>
            Số khung: {{ car.chasis_no }} <br>
            Số máy: {{ car.engine_no }} <br>
            Dòng xe: {{car.series.series_name}} <br>
            Hãng xe: {{car.series.brand.brand_name}} <br>
            Xuất xứ: {{ car.series.country.country_name }} <br>
            Nơi đăng ký: {{ car.province.full_name }} <br>
            Thông số kỹ thuật:
            <div class="ml-3">
                Chiều dài: {{ car.series.length }} cm<br>
                Chiều rộng: {{ car.series.width }} cm<br>
                Chiều cao: {{ car.series.height }} cm<br>
                Khối lượng: {{ car.series.weight }} kg<br>
                Trọng tải: {{ car.series.payload }} kg<br>
                Số ghế: {{ car.series.seat }} ghế<br>
                Công suất động cơ: {{ car.series.output }} kW
            </div>
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
