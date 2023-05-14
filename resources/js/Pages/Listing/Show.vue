<template>
    <div class ="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class = "md:col-span-7 flex items-center w-full">
            <div class = "w-full text-center font-medium text-gray-500">No images</div>
        </Box>

        <div class = "md:col-span-5 flex flex-col gap-4">
            <Box>
                <!--using slot named header-->
                <template #header>
                    Thông tin về xe
                </template>
                <div>
                    <CarInformation :listing="listing"></CarInformation>
                </div>
            </Box>
            <Box>
                <template #header>
                    <!-- use a ternary operator to determine the component to render -->
                    <div>Thông tin về chủ sở hữu</div>
                    </template>
                    <div>
                        <component :is="ownerTypeComponent" :listing="listing"></component>
                    </div>
            </Box>
        </div>
    </div>
</template>


<script setup>
import Box from '@/Components/UI/Box.vue';
import {shallowRef} from 'vue';
import CarInformation from '@/Components/CarInformation.vue';
import CompanyInformation from '@/Components/CompanyInformation.vue';
import PersonInformation from '@/Components/PersonInformation.vue';

const props = defineProps({
    listing: Object,
})

const ownerTypeComponent = shallowRef(null);

if (props.listing.car.owner_type == 'App\\Models\\Company') {
  ownerTypeComponent.value = CompanyInformation;
} else {
  ownerTypeComponent.value = PersonInformation;
}
</script>
