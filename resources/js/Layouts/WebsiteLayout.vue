<template>
    <div class="min-h-screen bg-gray-100">

        <!-- HEADER -->
        <nav-bar />

        <header class="bg-white shadow-sm" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <div class="w-full flex justify-center">
            <div class="w-full mt-4">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import NavBar from '../Components/NavBar'

  export default {
    components: {
          NavBar
      },

  }
</script>

<style>
</style>
