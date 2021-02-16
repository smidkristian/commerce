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

                    <button v-if="!tab" @click="tab = true, resetForm()" class="btn-header mr-4">
                        Back
                    </button>

                    <button v-if="tab" @click="createProduct()" class="btn-header">
                        Create New Product
                    </button>
                </div>
            </div>
        </template>



        <div class="lg:flex">
            <!-- PRODUCT FORM -->

            <div class="lg:w-2/5 mx-auto my-4">
                <product-form v-if="!tab"
                    @finished="tab = false, message()"
                    :brands="brands"
                    :products="products"
                    :productForm="productForm"
                    :errors="errors"
                />
            </div>

            <!-- PRODUCT IMAGES -->

            <div class="lg:w-1/3 mx-auto my-8">
                <product-images v-if="!tab"
                    :product="productForm.id"
                />
            </div>
        </div>

        <!-- TABLE OF PRODUCTS -->

        <div class="mt-10">
            <product-table v-if="tab"
                @edit="editForm($event)"
                :productForm="productForm"
                :products="products"
                :brands="brands"
            />
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import ProductForm from '../../Components/ProductForm'
    import ProductImages from '@/Components/ProductImages'
    import ProductTable from '@/Components/ProductTable'


    export default {
        props: {
            brands: Array,
            products: Array,
            errors: Object
        },

        components: {
            AppLayout,
            ProductForm,
            ProductImages,
            ProductTable,
        },

        data () {
            return {
                tab: true,
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
                this.tab = false;

            },

            editForm(product) {

                // writing values to form so that user can edit them
                Object.keys(this.productForm).forEach( key => {
                    this.productForm[key] = product[key];
                });

                // this gets us to the edit form
                this.tab = false;

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
