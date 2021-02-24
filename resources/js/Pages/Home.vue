<template>
    <website-layout>
            <!-- <template #header>
                <div>
                    Header
                </div>
            </template> -->
            <div class="flex flex-col lg:grid lg:grid-cols-6">

                <!-- SIDE PANEL -->
                <div class="flex lg:grid lg:col-span-1">

                    <div class="flex flex-col items-center px-10 lg:fixed">

                        <h1 class="lg:mt-20 text-2xl">Kategorie</h1>

                        <ul class="mt-10">
                            <li class="pb-4 text-xl">Trika</li>
                            <li class="pb-4 text-xl">Košile</li>
                            <li class="pb-4 text-xl">Kabáty</li>
                            <li class="pb-4 text-xl">Bundy</li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col lg:grid lg:col-span-4">

                    <!-- TOP BANNER -->
                    <div class="flex lg:grid lg:col-span-3 justify-center my-8">
                        <img src="https://picsum.photos/1200/300" alt="cover.img" class="object-contain">
                    </div>

                    <!-- PRODUCT GRID -->
                    <div class="flex flex-col lg:grid lg:col-span-3">

                        <div class="flex flex-col justify-center px-10 lg:grid lg:grid-cols-4 lg:gap-x-6 lg:gap-y-4">
                            <div v-for="product in products" :key="product.id" class="my-20">

                                <div v-if="product.images[0]" class="flex justify-center items-center">
                                    <img :src="'/storage/' + product.images[0].url" alt="product.img"
                                        class="object-contain" style="height: 400px; width: auto;">
                                </div>

                                <div v-else class="flex justify-center items-center">
                                    <img src="https://picsum.photos/400/400" alt="product.img">
                                </div>

                                <div class="flex flex-col mt-4 ml-4">
                                    <span>{{ product.name }}</span>
                                    <span class="font-bold">{{ product.price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </website-layout>
</template>

<style scoped>
</style>

<script>
import WebsiteLayout from '../Layouts/WebsiteLayout.vue';

    export default {
        props: [
            'products'
        ],

        components: {
            WebsiteLayout
        }
    }
</script>
