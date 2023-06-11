<template>
    <!-- monthly chart -->
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

    <!-- quarter chart -->
    <div class="flex gap-5 mb-10">
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

    <!-- yearly chart -->
    <div class="flex gap-5 mb-10">
        <Box class="w-1/4">
            <label class="label">Thống kê theo năm</label>
        </Box>
        <Box class="w-3/4">
            <label class="label">Số lượng xe được đăng kiểm theo năm</label>
            <MonthlyBarChart :chartData="chartDataYearly" />
        </Box>
    </div>

    <div class="gap-5 mb-10">
        <Box class="w-full">
            <div class="mb-8">
                <label class="label">Thống kê Số lượng xe sắp hết hạn đăng kiểm trong 30 ngày tới</label>
                <MonthlyBarChart :chartData="chartDataExpiring" />
            </div>
            <div class="mb-5">
                Tổng số lượng xe sẽ hết hạn đăng kiểm trong 30 ngày tới sẽ là {{ expiringTotal }} xe. <br>
                Tổng số xe đã được đăng ký nhưng chưa được đăng kiểm trong tỉnh là {{ registeredTotal }} xe.
            </div>
            <div>
                Trong 30 ngày tới, dự báo sẽ có {{ expiringTotal + registeredTotal }} xe tiến hành đăng kiểm, trong đó có {{ registeredTotal }} xe đăng kiểm mới và {{ expiringTotal }} xe tái đăng kiểm.
            </div>
            <div>
                <PieChart :chartData="pieChartData"></PieChart>
            </div>
        </Box>
    </div>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue';
import MonthlyBarChart from '@/Components/MonthlyBarChart.vue'
import PieChart from '@/Components/PieChart.vue';
import { ref, watch, onMounted } from 'vue';

const selectedYearMonthly = ref(new Date().getFullYear().toString());
const selectedYearQuarterly = ref(new Date().getFullYear().toString());
const maxYear = ref(getMaxYear());
const chartDataMonthly = ref(null);
const chartDataQuarterly = ref(null);
const chartDataYearly = ref(null);
const chartDataExpiring = ref(null);
const pieChartData = ref(null);
const expiringTotal = ref(0);
const registeredTotal = ref(0);

// Compute the years for the select options
const years = Array.from({ length: new Date().getFullYear() - 2010 + 1 }, (_, index) => (2010 + index).toString());

// Get the max possible years for options
function getMaxYear() {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    return `${year}-${month}`;
}

// update the max year if neccessary
function updateMaxYear() {
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    maxYear.value = `${selectedYearMonthly.value}-${month}`;
    maxYear.value = `${selectedYearQuarterly.value}-${month}`;
}

watch(selectedYearMonthly, updateMaxYear);
watch(selectedYearQuarterly, updateMaxYear);

// Fetch data for monthly chart
async function fetchDataMonthly() {
    try {
        const response = await fetch(`/user-statistics/monthly-count/${selectedYearMonthly.value}`);
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

// fetch data for quarterly chart
async function fetchDataQuarterly() {
    try {
        const response = await fetch(`/user-statistics/quarterly-count/${selectedYearQuarterly.value}`);
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

// fetch data for yearly chart
async function fetchDataYearly() {
    try {
        const response = await fetch(`/user-statistics/yearly-count`);
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

// fetch data for expiring listings
async function fetchDataExpiring() {
    try {
        const response = await fetch(`/user-statistics/expiring-count`);
        if (response.ok) {
            const { labels, data, total } = await response.json();
            chartDataExpiring.value = {
                labels: labels,
                datasets: [
                    {
                        label: 'Số lượng xe sắp hết hạn đăng kiểm',
                        backgroundColor: '#f87979',
                        data: data
                    }
                ]
            };
            expiringTotal.value = total;
        } else {
            throw new Error('Failed to fetch data');
        }
    } catch (error) {
        console.error(error);
    }
}

async function fetchDataRegistered() {
    try {
        const response = await fetch(`/user-statistics/registered-count`);
        if (response.ok) {
            const { count } = await response.json();
            registeredTotal.value = count;
        } else {
            throw new Error('Failed to fetch data');
        }
    } catch (error) {
        console.error(error);
    }
}

async function updatePieChart() {
    try {
        pieChartData.value = {
                labels: ['Xe đăng kiểm mới', 'Xe tái đăng kiểm'],
                datasets: [
                    {
                        label: 'Xe dự kiến đăng kiểm',
                        backgroundColor: ['#f87979', '#5f9ea0'],
                        data: [registeredTotal.value, expiringTotal.value]
                    }
                ]
            };
    } catch (error) {
        console.error(error);
    }
}


watch(selectedYearMonthly, fetchDataMonthly, { immediate: true });
watch(selectedYearQuarterly, fetchDataQuarterly, { immediate: true });
fetchDataYearly();
fetchDataExpiring();
fetchDataRegistered();

watch(expiringTotal, updatePieChart, { immediate: true});
watch(registeredTotal, updatePieChart, { immediate: true });
</script>
