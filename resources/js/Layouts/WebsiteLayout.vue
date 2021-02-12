<template>
    <div class="min-h-screen bg-gray-100">

        <!-- HEADER -->
        <nav-bar />

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
