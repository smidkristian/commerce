<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-baseline">
                <h2 class="font-semibold text-xl text-gray-800">
                    Manage Brands
                </h2>
                <div class="flex justify-end">

                    <span v-if="flashMessage != null"
                        class="flex items-end text-md text-gray-700 mr-8 xyz-out"
                        xyz="fade-100% out-delay-6 duration-6">
                        {{ flashMessage }}
                    </span>

                    <inertia-link :href="route('create-brand')" class="btn-header">
                        Create New Brand
                    </inertia-link>

                </div>
            </div>
        </template>

        <!-- TABLE OF BRANDS -->

        <brand-table :brands="brands" />

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import BrandTable from '../../Components/brands/BrandTable';

    export default {
        props: {
            brands: Array,

            errors: Object
        },

        components: {
            AppLayout,
            BrandTable
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
