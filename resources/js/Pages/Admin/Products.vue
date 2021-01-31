<template>
    <app-layout>
        <div class="flex justify-end mr-10 mt-4">
            <button @click="createProduct()" class="bg-gray-800 py-2 px-4 uppercase text-sm text-gray-200 rounded focus:outline-none">
                Create New Product
            </button>
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
            <form v-if="create == true" @submit.prevent="storeProduct()" class="flex flex-col">
                <div class="flex flex-col">
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="createProductForm.name">
                </div>

                <div class="flex flex-col">
                    <label for="sku">SKU:</label>
                    <input type="text" id="sku" v-model="createProductForm.sku">
                </div>

                <div class="flex flex-col">
                    <label for="brand_id">Brand:</label>
                    <input type="text" id="brand_id" v-model="createProductForm.brand_id">
                </div>

                <div class="flex flex-col">
                    <label for="color">Color:</label>
                    <input type="text" id="color" v-model="createProductForm.color">
                </div>

                <div class="flex flex-col">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" v-model="createProductForm.quantity">
                </div>

                <div class="flex flex-col">
                    <label for="weight">Weight:</label>
                    <input type="number" id="weight" v-model="createProductForm.weight">
                </div>

                <div class="flex flex-col">
                    <label for="price">Price:</label>
                    <input type="number" id="price" v-model="createProductForm.price">
                </div>

                <div class="flex flex-col">
                    <label for="sale_price">Sale:</label>
                    <input type="number" id="sale_price" v-model="createProductForm.sale_price">
                </div>

                <div class="flex flex-col">
                    <label for="description">Description:</label>
                    <input type="text" id="description" v-model="createProductForm.description">
                </div>

                <div class="flex flex-col">
                    <label for="status">Status:</label>
                    <input type="checkbox" id="status" v-model="createProductForm.status">
                </div>

                <div class="flex flex-col">
                    <label for="featured">Featured:</label>
                    <input type="checkbox" id="featured" v-model="createProductForm.featured">
                </div>
                <button type="submit">Save</button>
                <div class="xyz-in" xyz="fade-100% duration-20">
                    <span v-if="storeConfirmed" class="xyz-out" xyz="fade-100% out-delay-6 duration-6">Saved.</span>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
    export default {
        components: {
            AppLayout,
        },

        data () {
            return {
                create: false,

                storeConfirmed: false,

                createProductForm: {
                    name: null,
                    slug: null,
                    sku: null,
                    brand_id: null,
                    color: null,
                    quantity: null,
                    weight: null,
                    price: null,
                    sale_price: null,
                    description: null,
                    status: 0,
                    featured: 0,
                },

            }
        },

        methods: {
            createProduct() {
                this.create = true;
            },
            storeProduct() {
                this.slug();
                this.$inertia.post(route('store-product'), this.createProductForm, {
                    onSuccess: () => {
                        this.storeConfirmed = true;
                    }
                });
            },
            slug() {
                this.createProductForm.slug = this.createProductForm.name.toLowerCase().replace(/\s/g, '-');
                // this.createProductForm.slug = this.createProductForm.slug.replace(/\s/g, '-');
            }
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
