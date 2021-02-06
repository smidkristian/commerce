<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Brands
            </h2>
        </template>

        <div class="flex justify-end mt-6 mr-2 md:mr-10" id="editing">

            <div v-if="create == false">
                <span v-if="storeConfirmed || updateConfirmed" class="mr-6 xyz-out text-md" xyz="fade-100% out-delay-6 duration-6">Saved.</span>

                <button @click="createBrand()" class="btn">
                    Create New Brand
                </button>
            </div>
            <div v-else>
                <button @click="create = false" class="btn">
                    Back
                </button>
            </div>
        </div>

        <!-- _______________________________________________________________________________________________________________ CREATE NEW BRAND -->

        <div v-if="create == true"
            class="mx-auto w-full md:w-2/5 bg-white py-8 px-4 rounded-md mt-10 shadow-sm xyz-in"
            xyz="fade-100% up">
            <form @submit.prevent="storeBrand()" class="flex flex-col">

            <div class="flex flex-col">
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="createBrandForm.name" class="input max-w-sm">
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.name }}</span>
            </div>

            <div class="flex flex-col mt-4">
                <label for="description">Description:</label>
                <textarea type="text" rows="2" cols="30" id="description" v-model="createBrandForm.description" class="input" />
                <span class="text-xs text-red-700 uppercase mt-2">{{ errors.description }}</span>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn">Save</button>
            </div>
            </form>
        </div>

        <!-- _______________________________________________________________________________________________________________ UPDATE BRAND -->

        <div v-if="editing != null && create == false"
            class="mx-auto w-full md:w-2/5 bg-white py-8 px-4 rounded-md mt-10 shadow-sm xyz-in"
            xyz="fade-100% up">
            <form @submit.prevent="updateBrand(editBrandForm.name);" class="flex flex-col">
                <div class="flex flex-col">
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="editBrandForm.name" class="input max-w-sm">
                    <span class="text-xs text-red-700 uppercase mt-2">{{ errors.name }}</span>
                </div>
                <div class="flex flex-col mt-4">
                    <label for="description">Description:</label>
                    <textarea type="text" rows="2" cols="30" id="description" v-model="editBrandForm.description" class="input" />
                    <span class="text-xs text-red-700 uppercase mt-2">{{ errors.description }}</span>
                </div>
                <div class="flex w-full justify-between">
                    <button type="button" @click="deleteBrand(editBrandForm.id)" class="btn-danger">Delete</button>
                    <button type="submit" class="btn">Save</button>
                </div>
            </form>
        </div>

         <!-- _______________________________________________________________________________________________________________ TABLE -->

        <div v-if="create == false"
            class="mx-auto w-full p-2 md:w-4/5 bg-gray-200 py-8 flex justify-center rounded-md mt-10 shadow-inner">
            <table class="table-auto w-full mx-auto md:w-4/5 overflow-x-auto xyz-in" xyz="fade-100% duration-10">
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
                    <tr :key="brand.id" v-for="brand in brands" :id="brand.name">
                        <td class="text-center py-4 px-2">
                            {{brand.id}}
                        </td>
                        <td class="text-left py-4 px-2">
                            <span v-if="editing != brand.id">{{brand.name}}</span>
                            <span v-else>Editing</span>
                        </td>
                        <td class="text-left py-4 px-2 description">
                            <span v-if="editing != brand.id">{{brand.description}}</span>
                            <span v-else>Editing</span>
                        </td>
                        <td class="text-center action">
                            <div v-if="editing != brand.id" class="flex justify-center items-center">
                                <button @click="editBrand(brand)" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Edit</button>
                            </div>
                            <div v-else>
                                <button @click="resetEditForm()" class="bg-gray-800 uppercase font-semibold text-gray-100 text-xs rounded-md py-2 px-4">Cancle</button>
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
    export default {
        props: {
            brands: Array,

            errors: Object
        },

        components: {
            AppLayout,
        },

        data () {
            return {

                create: false,
                editing: null,

                storeConfirmed: false,
                updateConfirmed: false,
                deleteConfirmed: false,

                createBrandForm: {
                    name: null,
                    description: null
                },
                editBrandForm: {
                    id: null,
                    name: null,
                    description: null
                },

            }
        },

        methods: {
            createBrand() {
                this.create = true;
                this.editing = null;
            },
            storeBrand() {
                this.$inertia.post(route('store-brand'), this.createBrandForm, {
                    onSuccess: () => {
                        this.resetCreateForm();
                        this.storeConfirmed = true;
                        setTimeout(() => this.storeConfirmed = false, 2000);
                    },
                    onError: () => {
                        console.log(this.errors);
                    }
                });
            },
            editBrand(brand) {
                this.editing = this.editBrandForm.id = brand.id;
                this.editBrandForm.name = brand.name;
                this.editBrandForm.description = brand.description;

                document.querySelector('#editing').scrollIntoView({
                behavior: 'smooth'
                });
            },
            updateBrand(id) {
                this.$inertia.post(route('update-brand'), this.editBrandForm, {
                    onSuccess: () => {
                        this.updateConfirmed = true;
                        setTimeout(() => this.updateConfirmed = false, 2000);

                        document.querySelector('#' + id).scrollIntoView({
                        behavior: 'smooth'
                        });

                        this.resetEditForm();
                    }
                });
            },
            deleteBrand(id) {
                this.$inertia.post(route('delete-brand'), { id: id }, {
                    onSuccess: () => {
                        this.resetEditForm();
                        this.deleteConfirmed = true;
                        setTimeout(() => this.deleteConfirmed = false, 2000);
                    }
                });
            },
            resetCreateForm() {
                this.createBrandForm.name = this.createBrandForm.description = null;
                this.create = false;
            },
            resetEditForm() {
                this.editBrandForm.id = this.editing = this.editBrandForm.name = this.editBrandForm.description = null;
            },

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
    .action {
        padding: 0;
    }
    .description {
        max-width: 5vw !important;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
