<template>
    <website-layout>
        <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0 mt-20">
            <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <inertia-link v-if="$page.props.user" href="/admin/dashboard" class="text-sm text-gray-700 underline">
                    Profile
                </inertia-link>

                <template v-else>
                    <inertia-link :href="route('login')" class="text-sm text-gray-700 underline">
                        Login
                    </inertia-link>

                    <inertia-link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                        Register
                    </inertia-link>
                </template>
            </div>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-gray-800 text-7xl my-10">Ola</h1>
                <div
                    class="grid grid-cols-4 gap-4 bg-gray-200 rounded-md text-gray-600 my-10 shadow-inner"
                    >
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>

                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                    <div><img class="p-8" src="https://picsum.photos/640/720" alt=""></div>
                </div>
            </div>
        </div>
    </website-layout>
</template>

<style scoped>
</style>

<script>
import WebsiteLayout from '../Layouts/WebsiteLayout.vue';

    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },

        components: {
            WebsiteLayout
        }
    }
</script>
