<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="flex justify-center h-60 items-center">
            <a @click="f" :href="portfolio">Ola</a>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },

        data() {
            return {
                portfolio: '#click'
            }
        },

        methods: {
            f() {
                console.log('ola')
            }
        }
    }
</script>
