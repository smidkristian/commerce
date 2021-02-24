<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-baseline">
                <h2 class="font-semibold text-xl text-gray-800">
                    Manage Products
                </h2>
                <div class="flex justify-end">
                    <inertia-link :href="route('admin-products')" class="btn-header mr-4">Back</inertia-link>
                </div>
            </div>
        </template>


        <h1 class="text-gray-500 text-md p-4 uppercase lg:flex lg:justify-center">{{ form.name ? form.name :'New Product' }}</h1>


        <div class="flex flex-col lg:flex-row">
            <div class="bg-white w-full md:w-3/5 lg:w-2/5 p-6 mx-auto my-2 rounded-md shadow-md">
                <form @submit.prevent="store()" class="flex flex-col lg:grid lg:grid-cols-2 xyz-in" xyz="fade-100% duration-10">
                    <div class="flex flex-col">
                        <label for="name">Name:</label>
                        <input type="text" id="name" v-model="form.name"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.name }}</span>

                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="sku">SKU:</label>
                        <input type="text" id="sku" v-model="form.sku"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.sku }}</span>
                    </div>

                    <div class="flex flex-col">
                        <label for="brand_id">Brand:</label>
                        <select id="brand_id" v-model="form.brand_id"
                        class="input">
                            <option :key="brand.id" v-for="brand in brands" :value="brand.id">{{brand.name}}</option>
                        </select>
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.brand_id }}</span>
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="color">Color:</label>
                        <input type="text" id="color" v-model="form.color"
                        class="input" />
                    </div>

                    <div class="flex flex-col">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" v-model="form.quantity"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.quantity }}</span>
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="weight">Weight:</label>
                        <input type="number" id="weight" v-model="form.weight"
                        class="input" />
                    </div>

                    <div class="flex flex-col">
                        <label for="price">Price:</label>
                        <input type="number" id="price" v-model="form.price"
                        class="input" />
                        <span class="text-xs text-red-700 uppercase mt-2">{{ errors.price }}</span>
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="sale_price">Sale:</label>
                        <input type="number" id="sale_price" v-model="form.sale_price"
                        class="input" />
                    </div>

                    <div class="flex flex-col lg:grid lg:col-span-2">
                        <label for="description">Description:</label>
                        <textarea type="text" rows="2" cols="30" id="description" v-model="form.description"
                        class="input" />
                    </div>

                    <div class="flex flex-col">
                        <label for="status">Status:</label>
                        <input type="checkbox" id="status" v-model="form.status"
                        class="input" />
                    </div>

                    <div class="flex flex-col lg:ml-4">
                        <label for="featured">Featured:</label>
                        <input type="checkbox" id="featured" v-model="form.featured"
                        class="input" />
                    </div>
                    <div class="flex lg:grid lg:col-span-2">
                        <div v-if="form.id != null" class="flex w-full justify-between lg:col-span-2">
                            <div>
                                <button @click="remove(form.id)" type="button" class="btn-danger">Delete</button>
                            </div>
                            <div>
                                <button @click="update()" type="button" class="btn">Update</button>
                            </div>
                        </div>
                        <div v-else class="flex w-full justify-end lg:col-span-2">
                            <button type="submit" class="btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div v-if="product" class="w-full md:w-2/3 lg:w-1/3 mx-auto my-8">
                <product-images :product="product.id" :images="images" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ProductImages from '@/Components/products/ProductImages.vue';

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

                form: {
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

        mounted() {
            if(this.product) {
                this.fetch();
            }
        },

        methods: {

            fetch () {
                Object.keys(this.form).forEach( key => {
                        this.form[key] = this.product[key]
                });
            },

            store() {

                if (this.form.name != null) {
                    this.slug();
                }
                this.$inertia.post(route('store-product'), this.form, {
                    onSuccess: () => {
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            update() {

                if (this.form.name != null) {
                    this.slug();
                }
                this.$inertia.post(route('update-product'), this.form, {
                    onSuccess: () => {
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            remove(id) {

                this.$inertia.post(route('delete-product'), { id: id }, {
                    onSuccess: () => {
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            slug() {
                let diacritics = this.form.name.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                this.form.slug = diacritics.toLowerCase().replace(/\s/g, '-');
            },

            resetForm() {
                Object.keys(this.form).forEach( key => {
                    if (key == 'status' || key == 'featured') {
                        this.form[key] = 0
                    } else {
                        this.form[key] = null
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
