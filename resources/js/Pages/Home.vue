<template>
    <website-layout>
        <div class="relative flex items-top justify-center bg-gray-100">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-gray-800 text-7xl my-10">Ola</h1>
                <div class="grid grid-cols-4 bg-white rounded-md shadow-sm">
                    <div v-for="product in products" :key="product.id" class="m-4">
                        <div>
                            {{product.name}}
                        </div>
                        <div v-for="image in product.images" :key="image.id">
                            <img :src="'/storage/' + image.url" alt="">
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
        props: {
            products: Array
        },

        components: {
            WebsiteLayout
        }
    }
</script>
