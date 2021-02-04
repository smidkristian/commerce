<template>
    <div class="bg-white p-6 my-4 rounded-md shadow-md">
        <h1 class="text-gray-500 text-md py-4">New Product</h1>
        <form @submit.prevent="storeProduct()" class="flex flex-col lg:grid lg:grid-cols-2">
            <div class="flex flex-col">
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="createProductForm.name"
                class="input" />
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.name }}</span>

            </div>

            <div class="flex flex-col lg:ml-4">
                <label for="sku">SKU:</label>
                <input type="text" id="sku" v-model="createProductForm.sku"
                class="input" />
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.sku }}</span>
            </div>

            <div class="flex flex-col">
                <label for="brand_id">Brand:</label>
                <select id="brand_id" v-model="createProductForm.brand_id"
                class="input">
                    <option :key="brand.id" v-for="brand in brands" :value="brand.id">{{brand.name}}</option>
                </select>
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.brand_id }}</span>
            </div>

            <div class="flex flex-col lg:ml-4">
                <label for="color">Color:</label>
                <input type="text" id="color" v-model="createProductForm.color"
                class="input" />
            </div>

            <div class="flex flex-col">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" v-model="createProductForm.quantity"
                class="input" />
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.quantity }}</span>
            </div>

            <div class="flex flex-col lg:ml-4">
                <label for="weight">Weight:</label>
                <input type="number" id="weight" v-model="createProductForm.weight"
                class="input" />
            </div>

            <div class="flex flex-col">
                <label for="price">Price:</label>
                <input type="number" id="price" v-model="createProductForm.price"
                class="input" />
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.price }}</span>
            </div>

            <div class="flex flex-col lg:ml-4">
                <label for="sale_price">Sale:</label>
                <input type="number" id="sale_price" v-model="createProductForm.sale_price"
                class="input" />
            </div>

            <div class="flex flex-col lg:grid lg:col-span-2">
                <label for="description">Description:</label>
                <textarea type="text" rows="2" cols="30" id="description" v-model="createProductForm.description"
                class="input" />
            </div>

            <div class="flex flex-col lg:ml-4">
                <label for="status">Status:</label>
                <input type="checkbox" id="status" v-model="createProductForm.status"
                class="input" />
            </div>

            <div class="flex flex-col">
                <label for="featured">Featured:</label>
                <input type="checkbox" id="featured" v-model="createProductForm.featured"
                class="input" />
            </div>
            <div class="flex justify-end lg:grid lg:col-span-2">
                <div>
                    <span v-if="storeConfirmed" class="mr-8 xyz-out" xyz="fade-100% out-delay-6 duration-6">Saved.</span>
                    <button type="submit" class="btn">Save</button>
                </div>
            </div>
        </form>
        <!-- <div v-if="create == false"
            class="mx-auto w-full p-2 md:w-4/5 bg-gray-200 py-8 flex justify-center rounded-md mt-10 shadow-inner">
            <table class="table-auto w-full md:w-4/5">
                <thead class="bg-gray-100 shadow-sm mb-4">
                    <tr>
                        <th class="text-center py-4 px-2">
                            ID
                        </th>
                        <th class="text-left py-4 px-2">
                            Name
                        </th>
                        <th class="text-left py-4 px-2">
                            Description
                        </th>
                        <th class="text-center py-4 px-2 action">
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
                            <span v-if="editing != product.id">{{product.name}}</span>
                            <span v-else>Editing</span>
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="editing != product.id">{{product.description}}</span>
                            <span v-else>Editing</span>
                        </td>
                        <td class="text-center action">
                            <div v-if="editing != product.id" class="flex justify-center items-center">
                                <button @click="editProduct(product)" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Edit</button>
                            </div>
                            <div v-else>
                                <button @click="resetEditForm()" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Cancle</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> -->
    </div>
</template>

<script>

    export default {
        props: [
            'brands',
            'products',
            'errors'
        ],

        data() {

            return {
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

            storeProduct() {
                if (this.createProductForm.name != null) {
                    this.slug();
                }
                this.$inertia.post(route('store-product'), this.createProductForm, {
                    onSuccess: () => {
                        this.storeConfirmed = true;
                        setTimeout(() => this.storeConfirmed = false, 2000);
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },
            slug() {
                this.createProductForm.slug = this.createProductForm.name.toLowerCase().replace(/\s/g, '-');
            },
            resetForm() {
                Object.keys(this.createProductForm).forEach( key => {
                    if (key == 'status' || key == 'featured') {
                        this.createProductForm[key] = 0
                    } else {
                        this.createProductForm[key] = null
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
</style>
