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

                    <inertia-link :href="$route('admin/products')" class="btn-header mr-4">Back</inertia-link>

                </div>
            </div>
        </template>
        <div class="flex flex-col lg:flex-row mt-8">
            <div class="bg-white w-full md:w-3/5 lg:w-2/5 p-6 mx-auto my-2 rounded-md shadow-md">
                <h1 class="text-gray-500 text-md py-4">{{ productForm.name ? productForm.name :'New Product' }}</h1>
                <form @submit.prevent="storeProduct()" class="flex flex-col lg:grid lg:grid-cols-2 xyz-in" xyz="fade-100% duration-10">
                    <div class="flex flex-col">
                        <label for="name">Name:</label>
                        <input type="text" id="name" v-model="productForm.name"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.name }}</span>

                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="sku">SKU:</label>
                        <input type="text" id="sku" v-model="productForm.sku"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.sku }}</span>
                    </div>

                    <div class="flex flex-col">
                        <label for="brand_id">Brand:</label>
                        <select id="brand_id" v-model="productForm.brand_id"
                        class="input">
                            <option :key="brand.id" v-for="brand in brands" :value="brand.id">{{brand.name}}</option>
                        </select>
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.brand_id }}</span>
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="color">Color:</label>
                        <input type="text" id="color" v-model="productForm.color"
                        class="input" />
                    </div>

                    <div class="flex flex-col">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" v-model="productForm.quantity"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.quantity }}</span>
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="weight">Weight:</label>
                        <input type="number" id="weight" v-model="productForm.weight"
                        class="input" />
                    </div>

                    <div class="flex flex-col">
                        <label for="price">Price:</label>
                        <input type="number" id="price" v-model="productForm.price"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.price }}</span>
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="sale_price">Sale:</label>
                        <input type="number" id="sale_price" v-model="productForm.sale_price"
                        class="input" />
                    </div>

                    <div class="flex flex-col lg:grid lg:col-span-2">
                        <label for="description">Description:</label>
                        <textarea type="text" rows="2" cols="30" id="description" v-model="productForm.description"
                        class="input" />
                    </div>

                    <div class="flex flex-col">
                        <label for="status">Status:</label>
                        <input type="checkbox" id="status" v-model="productForm.status"
                        class="input" />
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="featured">Featured:</label>
                        <input type="checkbox" id="featured" v-model="productForm.featured"
                        class="input" />
                    </div>
                    <div class="flex lg:grid lg:col-span-2">
                        <div v-if="productForm.id != null" class="flex w-full justify-between lg:col-span-2">
                            <div>
                                <button @click="deleteProduct(productForm.id)" type="button" class="btn-danger">Delete</button>
                            </div>
                            <div>
                                <button @click="updateProduct()" type="button" class="btn">Update</button>
                            </div>
                        </div>
                        <div v-else class="flex w-full justify-end lg:col-span-2">
                            <button type="submit" class="btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-2/3 lg:w-1/3 mx-auto my-8">
                <product-images :product="product.id" :images="images" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ProductImages from '@/Components/ProductImages.vue';

    export default {
        components: {
            AppLayout,
            ProductImages
        },

        props: {
            brands: Array,
            product: Object,
            images: Array,
            errors: Object,
        },

        data() {
            return {
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

        created() {
            if(this.product) {
                this.fetchProduct();
            }
        },

        methods: {

            fetchProduct () {
                Object.keys(this.productForm).forEach( key => {
                        this.productForm[key] = this.product[key]
                });
            },

            storeProduct() {

                if (this.productForm.name != null) {
                    this.slug();
                }
                this.$inertia.post(route('store-product'), this.productForm, {
                    onSuccess: () => {
                        this.$emit('finished')
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            updateProduct() {

                if (this.productForm.name != null) {
                    this.slug();
                }
                this.$inertia.post(route('update-product'), this.productForm, {
                    onSuccess: () => {
                        this.$emit('finished')
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            deleteProduct(id) {

                this.$inertia.post(route('delete-product'), { id: id }, {
                    onSuccess: () => {
                        this.$emit('finished')
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            slug() {
                let diacritics = this.productForm.name.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                this.productForm.slug = diacritics.toLowerCase().replace(/\s/g, '-');
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

        }
    }
</script>

<style scoped>
    form div {
        margin-top: 1rem;
    }
    form div label {
        margin-bottom: 0.25rem;
    }
</style>
