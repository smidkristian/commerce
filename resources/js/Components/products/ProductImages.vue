<template>
    <div>
        <vue-glide v-if="numOfImg > 0" :options="glideOptions">
            <vue-glide-slide v-for="image in pictures" :key="image.id">
                <div class="flex justify-center m-4">
                    <img :src="'/storage/' + image.url" alt="product.img"
                    class="object-contain" style="height: 200px; width: auto;">
                </div>
            </vue-glide-slide>

            <template slot="control" class="my-4">
                <button data-glide-dir="<"
                    class="border-r-2 border-gray-300 px-4 py-2 text-xs uppercase text-gray-700 focus:outline-none">
                    prev
                </button>
                <div class="px-4 py-2 text-xs uppercase text-gray-700">
                    {{ numOfImg }} image/s
                </div>
                <button data-glide-dir=">"
                    class="border-l-2 border-gray-300 px-4 py-2 text-xs uppercase text-gray-700 focus:outline-none">
                    next
                </button>
            </template>
        </vue-glide>

        <div v-else class="text-center text-xl text-gray-400 my-10">
            No images...
        </div>
        <div>
            <vue-dropzone
                ref="myVueDropzone"
                id="dropzone"
                :options="dropzoneOptions"
                :useCustomSlot="true"
                @vdropzone-sending="sending"
                class="rounded-md mt-8"
            >
                <h3 class="text-lg text-gray-400 uppercase">Upload images!</h3>
            </vue-dropzone>
            <div class="flex justify-end">
                <button @click="reload()" class="btn">Confirm</button>
            </div>
        </div>
    </div>
</template>

<script>
    import VueDropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    import { Glide, GlideSlide } from 'vue-glide-js'

    export default {
        props: [
            'product',
            'images'
        ],

        components: {
            VueDropzone,
            [Glide.name]: Glide,
            [GlideSlide.name]: GlideSlide
        },

        data() {

            return {
                pictures: null,
                numOfImg: null,
                glideOptions: {
                    type: 'carousel',
                    gap: 10,
                    perView: 1,
                },

                dropzoneOptions: {
                    url: route('store-image'),
                    thumbnailWidth: 150,
                    maxFilesize: 3,
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content
                    }
                }
            }
        },

        created() {
            this.loadImages();
        },

        methods: {

            // DROPZONE

            sending(file, xhr, formData) {
                formData.append('product_id', this.product);
            },

            loadImages() {
                axios.post(route('load-images'), { id: this.product })
                .then(response => {
                    this.pictures = response.data;
                    this.numOfImg = this.pictures.length;
                    console.log(this.pictures, this.numOfImg);
                })
                .catch(error => {
                    console.log(error);
                });
            },

            reload() {
                location.reload();
            }
        }
    }
</script>

<style>

    /* you cannot wrap control slot in a div, you have to check
        what the browser is rendering, select that div and customize it here */

    div[data-glide-el="controls"] {
        display: flex;
        justify-content: space-between;
    }

</style>
