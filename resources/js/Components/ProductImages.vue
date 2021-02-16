<template>
    <div>
        <vue-glide v-if="images[0] != null" :options="glideOptions">
            <vue-glide-slide v-for="image in images" :key="image.id">
                <img :src="'/storage/' + image.url" alt="product.img"
                    class="object-contain" style="min-height: 400px; width: auto;">
            </vue-glide-slide>

            <template slot="control" class="my-4">
                <button data-glide-dir="<"
                    class="border-r-2 border-gray-300 px-4 py-2 text-xs uppercase text-gray-700 focus:outline-none">
                    prev
                </button>
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
                class="rounded-md my-8"
            >
                <h3 class="text-lg text-gray-400 uppercase">Upload images!</h3>
            </vue-dropzone>
        </div>
    </div>
</template>

<script>
    import VueDropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    import { Glide, GlideSlide } from 'vue-glide-js'

    export default {
        props: [
            'product'
        ],

        components: {
            VueDropzone,
            [Glide.name]: Glide,
            [GlideSlide.name]: GlideSlide
        },

        watch: {
            product: function(newVal, oldVal) {
                console.log('product changed: ' + newVal);
                this.loadImages();
            }
        },

        data() {

            let CSRF = document.head.querySelector("[name=csrf-token]").content;
            return {
                images: null,
                glideOptions: {
                    type: 'carousel',
                    gap: 10,
                    perView: 3,
                },

                dropzoneOptions: {
                    url: route('store-image'),
                    thumbnailWidth: 150,
                    maxFilesize: 3,
                    headers: {
                        'X-CSRF-TOKEN': CSRF
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
                    this.images = response.data;
                    console.log(this.images);
                })
                .catch(error => {
                    console.log(error);
                });
            },
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
