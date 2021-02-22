<template>
    <website-layout>
            <template #header>
                <div>
                    Ola
                </div>
            </template>
            <div class="flex flex-col md:grid md:grid-cols-4">
                <div class="flex justify-center md:grid md:col-span-1">
                    <ul>
                        <li>Trika</li>
                        <li>Košile</li>
                        <li>Kabáty</li>
                        <li>Bundy</li>
                    </ul>
                </div>

                <div class="flex flex-col md:grid md:col-span-3 bg-white rounded-md">

                    <div class="grid col-span-3 justify-center my-8">
                        <img src="https://picsum.photos/1200/300" alt="cover.img">
                    </div>

                    <div class="flex flex-col justify-center md:grid md:grid-cols-4 md:gap-x-2 md:gap-y-4">
                        <div v-for="product in products" :key="product.id" class="mt-6">
                            <div>
                                <div v-if="product.images[0]" class="flex justify-center items-center">
                                    <img :src="'/storage/' + product.images[0].url" alt="product.img"
                                        class="object-contain" style="height: 400px; width: auto;">
                                </div>
                                <div v-else class="flex justify-center items-center">
                                    <img src="https://picsum.photos/300/400" alt="product.img">
                                </div>
                            </div>
                            <div class="flex flex-col mt-4 ml-4">
                                <span>{{ product.name }}</span>
                                <span class="font-bold">{{ product.price }}</span>
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
