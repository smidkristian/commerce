<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Products
            </h2>
        </template>

        <div class="flex justify-end mr-10 mt-4">

            <span v-if="flash != null" class="flex items-end text-md text-gray-700 mr-8 xyz-out" xyz="fade-100% out-delay-6 duration-6">{{flash}}</span>

            <button v-if="create || productForm.id != null" @click="create = false, resetForm()" class="btn">Back</button>

            <button v-if="create == false" @click="createProduct()" class="btn">
                Create New Product
            </button>
        </div>
        <div class="flex justify-center mt-10">
            <product-form @finished="create = false, message()" :brands="brands" :products="products" :form="productForm" :errors="errors"
            v-if="create == true || productForm.id != null" />
        </div>
        <div class="mx-auto my-4 w-full p-2 md:w-4/5 bg-gray-200 py-8 px-4 overflow-x-auto rounded-md mt-10 shadow-inner">
            <table class="table-auto w-full mx-auto md:w-4/5">
                <thead class="bg-gray-100 shadow-sm mb-4">
                    <tr>
                        <th class="text-center py-4 px-2">
                            ID
                        </th>
                        <th class="text-left py-4 px-2">
                            Name
                        </th>
                        <th class="text-left py-4 px-2">
                            SKU
                        </th>
                        <th class="text-left py-4 px-2">
                            Brand
                        </th>
                        <th class="text-left py-4 px-2">
                            Color
                        </th>
                        <th class="text-left py-4 px-2">
                            Quantity
                        </th>
                        <th class="text-left py-4 px-2">
                            Weight
                        </th>
                        <th class="text-left py-4 px-2">
                            Price
                        </th>
                        <th class="text-left py-4 px-2">
                            Sale
                        </th>
                        <th class="text-left py-4 px-2">
                            Descritpion
                        </th>
                        <th class="text-left py-4 px-2">
                            Status
                        </th>
                        <th class="text-left py-4 px-2">
                            Featured
                        </th>
                        <th class="text-center py-4 px-2">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr :key="product.id" v-for="product in products" :id="product.name">
                        <td class="text-center py-4 px-2">
                            {{product.id}}
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.name}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.sku}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">
                                <span :key="brand.id" v-for="brand in brands">
                                    <span v-if="brand.id == product.brand_id">{{brand.name}}</span>
                                </span>
                            </span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.color}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.quantity}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.weight}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.price}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.sale_price}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2 description">
                            <span v-if="productForm.id != product.id">{{product.description}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.status}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="productForm.id != product.id">{{product.featured}}</span>
                            <span v-else>...</span>
                        </td>
                        <td class="text-center px-2">
                            <div v-if="productForm.id != product.id" class="flex justify-center items-center">
                                <button @click="editForm(product)" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Edit</button>
                            </div>
                            <div v-else>
                                <span class="uppercase font-semibold text-gray-500 text-xs py-2 px-4">Editing</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ProductForm from '../../Components/ProductForm'

    export default {
        props: {
            brands: Array,
            products: Array,
            errors: Object
        },

        components: {
            AppLayout,
            ProductForm
        },

        data () {
            return {
                create: false,
                flash: null,

                productForm: {
                    id: null,
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

                this.resetForm();
                this.create = true;

            },

            editForm(product) {

                Object.keys(this.productForm).forEach( key => {
                    this.productForm[key] = product[key];
                });

            },

            resetForm() {

                Object.keys(this.productForm).forEach( key => {
                    if (key == 'status' || key == 'featured') {
                        this.productForm[key] = 0
                    } else {
                        this.productForm[key] = null
                    }
                });
            },

            message() {

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
