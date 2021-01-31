<template>
    <app-layout>
        <div class="flex flex-row justify-end mr-10 mt-4">

            <span v-if="storeConfirmed" class="mr-6 xyz-in" xyz="fade-100% duration-10">Saved.</span>

            <button @click="createBrand()" class="bg-gray-800 py-2 px-4 uppercase text-sm text-gray-200 rounded focus:outline-none">
                Create New Brand
            </button>
        </div>
        <div class="flex justify-center mt-10">
            <table v-if="create == false" class="table-auto p-2 md:w-3/5">
                <thead>
                    <tr>
                        <th class="text-left pb-4 px-2">
                            ID
                        </th>
                        <th class="text-left pb-4 px-2">
                            Name
                        </th>
                        <th class="text-left pb-4 px-2">
                            Description
                        </th>
                        <th class="text-left pb-4 px-2">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr :key="brand.id" v-for="brand in brands">
                        <td class="rowID">
                            {{brand.id}}
                        </td>
                        <td class="rowName">
                            {{brand.name}}
                        </td>
                        <td class="rowDesc">
                            {{brand.description}}
                        </td>
                        <td class="flex flex-col pl-6 md:flex-row">
                            <button>Edit</button>
                            <button class="pt-4 md:pl-6 md:pt-0">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <form v-if="create == true" @submit.prevent="storeBrand()" class="flex flex-col">

                <div class="flex flex-col">
                    <label for="name">Name:</label>
                    <input type="text" id="name" v-model="createBrandForm.name">
                </div>

                <div class="flex flex-col">
                    <label for="description">Description:</label>
                    <input type="text" id="description" v-model="createBrandForm.description">
                </div>
                <button type="submit">Save</button>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
    export default {
        props: [
            'brands',
        ],

        components: {
            AppLayout,
        },

        data () {
            return {

                create: false,

                storeConfirmed: false,

                createBrandForm: {
                    name: null,
                    description: null
                },

            }
        },

        methods: {
            createBrand() {
                this.create = true;
                console.log(this.createBrandForm);
            },
            storeBrand() {
                this.$inertia.post(route('store-brand'), this.createBrandForm, {
                    onSuccess: () => {
                        this.resetForm();
                        this.storeConfirmed = true;
                        setTimeout(() => this.storeConfirmed = false, 2000);
                    }
                });
            },
            resetForm() {
                this.createBrandForm.name = this.createBrandForm.description = null;
                this.create = false;
            }
        }
    }
</script>

<style scoped>

    tr {
        border-bottom: solid 1px;
    }
    td {
        padding: 8px 6px ;
    }
    td:hover {
        background-color: aqua;
    }
    @media screen and (max-width: 768px) {

    }
</style>
