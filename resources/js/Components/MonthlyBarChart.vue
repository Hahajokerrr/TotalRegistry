<template>
    <div>
        <Bar v-if="chartData" :data="chartData" :options="options" />
    </div>
</template>

<script setup>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { defineProps } from 'vue'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
var options = {
    maintainAspectRatio: false,
    responsive: true,
    aspectRatio: 0.5,
    scales: {
        y: {
            stacked: true,
            grid: {
                display: true,
                color: "rgba(255,99,132,0.2)"
            }
        },
        x: {
            grid: {
                display: false
            }
        }
    },
};
const props = defineProps({
    year: {
        type: String,
        required: true
    },
    chartData: {
        type: Object,
        required: true
    }
})
</script>
