<template>
    <div class="flex gap-5 mb-10">
        <Box class="w-1/4">
            <label for="month" class="label">Chọn năm:</label>
            <div class="flex">
                <select class="input" v-model="selectedYearMonthly" @change="updateMaxYear">
                    <option v-for="year in years" :value="year" :key="year">{{ year }}</option>
                </select>
            </div>
        </Box>
        <Box class="w-3/4">
            <label class="label">Thống kê theo tháng</label>
            <MonthlyBarChart :year="selectedYearMonthly" :chartData="chartDataMonthly" />
        </Box>
    </div>

    <div class="flex gap-5">
        <Box class="w-1/4">
            <label for="quarter" class="label">Chọn năm:</label>
            <div class="flex">
                <select class="input" v-model="selectedYearQuarterly" @change="updateMaxYear">
                    <option v-for="year in years" :value="year" :key="year">{{ year }}</option>
                </select>
            </div>
        </Box>
        <Box class="w-3/4">
            <label class="label">Thống kê theo quý</label>
            <MonthlyBarChart :year="selectedYearQuarterly" :chartData="chartDataQuarterly" />
        </Box>
    </div>

    <div class="flex gap-5">
        <Box class="w-1/4">
            <label class="label">Thống kê theo năm</label>
        </Box>
        <Box class="w-3/4">
            <label class="label">Số lượng xe được đăng kiểm theo năm</label>
            <MonthlyBarChart :chartData="chartDataYearly" />
        </Box>
    </div>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue';
import MonthlyBarChart from '@/Components/MonthlyBarChart.vue'
import { ref, watch } from 'vue';

const selectedYearMonthly = ref(new Date().getFullYear().toString());
const selectedYearQuarterly = ref(new Date().getFullYear().toString());
const maxYear = ref(getMaxYear());
const chartDataMonthly = ref(null);
const chartDataQuarterly = ref(null);
const chartDataYearly = ref(null);

// Compute the years for the select options
const years = Array.from({ length: new Date().getFullYear() - 2010 + 1 }, (_, index) => (2010 + index).toString());


function getMaxYear() {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    return `${year}-${month}`;
}

function updateMaxYear() {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    maxYear.value = `${selectedYearMonthly.value}-${month}`;
    maxYear.value = `${selectedYearQuarterly.value}-${month}`;
}

watch(selectedYearMonthly, updateMaxYear);
watch(selectedYearQuarterly, updateMaxYear);

// Fetch data function
async function fetchDataMonthly() {
    try {
        const response = await fetch(`/api/user-statistics/monthly-count/${selectedYearMonthly.value}`);
        if (response.ok) {
            const { labels, data } = await response.json();
            chartDataMonthly.value = {
                labels: labels,
                datasets: [
                    {
                        label: 'Số lượng xe được đăng kiểm',
                        backgroundColor: '#f87979',
                        data: data
                    }
                ]
            };
        } else {
            throw new Error('Failed to fetch data');
        }
    } catch (error) {
        console.error(error);
    }
}

async function fetchDataQuarterly() {
    try {
        const response = await fetch(`/api/user-statistics/quarterly-count/${selectedYearQuarterly.value}`);
        if (response.ok) {
            const { labels, data } = await response.json();
            chartDataQuarterly.value = {
                labels: labels,
                datasets: [
                    {
                        label: 'Số lượng xe được đăng kiểm',
                        backgroundColor: '#f87979',
                        data: data
                    }
                ]
            };
        } else {
            throw new Error('Failed to fetch data');
        }
    } catch (error) {
        console.error(error);
    }
}

async function fetchDataYearly() {
  try {
    const response = await fetch(`/api/user-statistics/yearly-count`);
    if (response.ok) {
      const { labels, data } = await response.json();
      chartDataYearly.value = {
        labels: labels,
        datasets: [
          {
            label: 'Số lượng xe được đăng kiểm',
            backgroundColor: '#f87979',
            data: data
          }
        ]
      };
    } else {
      throw new Error('Failed to fetch data');
    }
  } catch (error) {
    console.error(error);
  }
}

watch(selectedYearMonthly, fetchDataMonthly, { immediate: true });
watch(selectedYearQuarterly, fetchDataQuarterly, { immediate: true });
fetchDataYearly();

</script>
