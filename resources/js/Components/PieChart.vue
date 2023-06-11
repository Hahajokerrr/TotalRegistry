<template>
    <div>
        <Pie v-if="chartData" :data="chartData" :options="options"/>
    </div>
</template>

<script setup>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement } from 'chart.js'
import { defineProps } from 'vue'

ChartJS.register(Title, Tooltip, Legend, ArcElement)

var options = {
    maintainAspectRatio: false,
    responsive: true,
};

const props = defineProps({
    chartData: {
        type: Object,
        required: true
    }
})
</script>
