<template>
    <app-layout>
        <div class="flex justify-end mr-10 mt-4">
            <button v-if="create == false" @click="createProduct()" class="btn">
                Create New Product
            </button>
            <button v-else @click="create = false" class="btn">Back</button>
        </div>
        <div class="flex justify-center mt-10">
            <table v-if="create == false">
                <thead>
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Product
                        </th>
                        <th>
                            Quantity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            22
                        </td>
                        <td>
                            Apple
                        </td>
                        <td>
                            23
                        </td>
                    </tr>
                </tbody>
            </table>
            <product-form :brands="brands" :products="products" :errors="errors" v-if="create == true" />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ProductForm from '../../Components/ProductForm'

    export default {
        props: [
            'brands',
            'products',
            'errors'
        ],

        components: {
            AppLayout,
            ProductForm
        },

        data () {
            return {
                create: false,
            }
        },

        methods: {
            createProduct() {
                this.create = true;
            },
        }
    }
</script>

<style scoped>
    th {
        padding-right: 2rem;
        padding-top: 1rem;
    }
    td {
        padding-right: 2rem;
        padding-top: 1rem;
    }
</style>
