<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800">
                    Manage Products
                </h2>
                <div class="flex justify-end">

                    <span v-if="flashMessage != null"
                        class="flex text-lg text-gray-800 mr-8 xyz-out"
                        xyz="fade-100% out-delay-10 duration-10">
                        {{ flashMessage }}
                    </span>

                    <inertia-link :href="route('create-product')" class="btn-header">
                        Create New Product
                    </inertia-link>
                </div>
            </div>
        </template>

        <!-- TABLE OF PRODUCTS -->

        <product-table :products="products" :brands="brands" />

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ProductTable from '@/Components/products/ProductTable'


    export default {
        props: {
            brands: Array,
            products: Array,
            errors: Object
        },

        components: {
            AppLayout,
            ProductTable,
        },

        data () {
            return {
                flashMessage: null,
            }
        },

        mounted() {
            this.message();
        },

        methods: {

            message() {

                // displaying success message from the server

                let urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('message')) {
                    this.flashMessage = urlParams.get('message');
                    setTimeout(() => this.flashMessage = null, 2000);
                }
            }
        }
    }
</script>

<style scoped>
    tr {
        border-bottom: solid 0.5px rgb(209, 209, 209);
    }
    th {
        padding-left: 1rem;
    }
    td {
        padding-left: 1rem;
    }
    td:hover {
        background-color: rgb(235, 235, 235);
    }
    .description {
        max-width: 5vw !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
