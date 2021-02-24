<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-baseline">
                <h2 class="font-semibold text-xl text-gray-800">
                    Manage Categories
                </h2>
                <div class="flex justify-end">

                    <span v-if="flash != null"
                        class="flex items-end text-md text-gray-700 mr-8 xyz-out"
                        xyz="fade-100% out-delay-6 duration-6">
                        {{ flash }}
                    </span>

                    <button v-if="table" @click="createCategory()" class="btn-header">
                        Create New Category
                    </button>
                </div>
            </div>
        </template>

        <!-- TABLE OF CATEGORIES -->

        <category-table :categories="categories" />

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CategoryTable from '@/Components/categories/CategoryTable';

    export default {
        props: [
            'categories'
        ],
        components: {
            AppLayout,
            CategoryTable
        },

        data () {
            return {
                flashMessage: null
            }
        },

        methods: {

            message() {

                // displaying success message from the server

                let urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('message')) {
                    this.flashMessage = urlParams.get('message');
                    setTimeout(() => this.flashMessage = null, 2000);
                }
            }
        }
    }
</script>

<style scoped>

</style>
