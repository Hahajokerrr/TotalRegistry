<template>
    <Box>
    <div>
        <!-- <Link :href="route('listing.show', {listing: listing.id})">
            <div class="flex items-center gap-1">
                <Price :price="listing.price" class ="text-2xl font-bold"/>
                <div class="text-xs text-gray-500">
                    <Price :price="monthlyPayment"/> pm
                </div>
            </div> -->
            <!-- <ListingSpace :listing="listing" class="text-lg">
            </ListingSpace>
            <CarInformation :listing="listing" :car="car" class = "text-gray-500"></CarInformation>
        </Link> -->
        <CarInformation :listing="listing" :car="car" class = "text-gray-500"></CarInformation>
    </div>
    <!-- <div>
        <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
    </div> -->
</Box>
</template>

<script setup>
    import ListingSpace from '@/Components/ListingSpace.vue';
    import {Link} from '@inertiajs/inertia-vue3'
    import Box from '@/Components/UI/Box.vue'
    import Price from '@/Components/Price.vue';
    import { useMonthlyPayment } from '@/Composables/useMonthlyPayment';
    import CarInformation from '@/Components/CarInformation.vue';


    const props = defineProps({
        listing: Object,
        car: Object,
    })

    //const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)
</script>
