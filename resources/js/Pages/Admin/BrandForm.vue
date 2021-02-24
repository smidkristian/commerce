<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-baseline">
                <h2 class="font-semibold text-xl text-gray-800">
                    Manage Brands
                </h2>
                <div class="flex justify-end">
                    <inertia-link :href="route('admin-brands')" class="btn-header mr-4">Back</inertia-link>
                </div>
            </div>
        </template>


        <h1 class="text-gray-500 text-md p-4 uppercase lg:flex lg:justify-center">{{ form.name ? form.name :'New Product' }}</h1>

        <div class="mx-auto w-full md:w-2/5 bg-white py-8 px-4 rounded-md shadow-md xyz-in"
            xyz="fade-100% up">
            <form @submit.prevent="store()" class="flex flex-col">

                <div class="flex flex-col">
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="form.name" class="input max-w-sm">
                    <span class="text-xs text-red-700 uppercase mt-2">{{ errors.name }}</span>
                </div>

                <div class="flex flex-col mt-4">
                    <label for="description">Description:</label>
                    <textarea type="text" rows="2" cols="30" id="description" v-model="form.description" class="input" />
                    <span class="text-xs text-red-700 uppercase mt-2">{{ errors.description }}</span>
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
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'

    export default {
        props: [
            'brand',
            'errors'
        ],
        components: {
            AppLayout
        },

        data() {
            return {
                form: {
                    id: null,
                    name: null,
                    description: null
                },
            }
        },

        mounted() {
            if(this.brand) {
                this.fetch();
            }
        },

        methods: {

            fetch () {
                Object.keys(this.form).forEach( key => {
                        this.form[key] = this.brand[key]
                });
            },

            store() {
                this.$inertia.post(route('store-brand'), this.form, {
                    onSuccess: () => {
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },

            update() {
                this.$inertia.post(route('update-brand'), this.form, {
                    onSuccess: () => {
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },
            remove(id) {
                this.$inertia.post(route('delete-brand'), { id: id }, {
                    onSuccess: () => {
                        this.resetForm();
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },
            resetForm() {
                Object.keys(this.form).forEach( key => {
                    this.form[key] = null
                });
            },
        }

    }
</script>

<style scoped>

</style>
