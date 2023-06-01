<template>
    <div>
      <Bar v-if="chartData" :data="chartData" />
    </div>
  </template>

  <script setup>
  import { Bar } from 'vue-chartjs'
  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
  import { defineProps } from 'vue'

  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

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
