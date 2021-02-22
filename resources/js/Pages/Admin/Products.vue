<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-baseline">
                <h2 class="font-semibold text-xl text-gray-800">
                    Manage Products
                </h2>
                <div class="flex justify-end">

                    <span v-if="flash != null"
                        class="flex items-end text-md text-gray-700 mr-8 xyz-out"
                        xyz="fade-100% out-delay-6 duration-6">
                        {{ flash }}
                    </span>

                    <button v-if="table" @click="createProduct()" class="btn-header">
                        Create New Product
                    </button>
                </div>
            </div>
        </template>

        <!-- TABLE OF PRODUCTS -->

        <div class="mt-10">
            <product-table v-if="table"
                :products="products"
                :brands="brands"
            />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ProductTable from '@/Components/ProductTable'


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
                table: true,
                flash: null,
            }
        },

        methods: {

            message() {

                // displaying success message from the server

                let urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('message')) {
                    this.flash = urlParams.get('message');
                    setTimeout(() => this.flash = null, 2000);
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
