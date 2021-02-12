<template>
    <div>
        <div>
            <vue-dropzone
                ref="myVueDropzone"
                id="dropzone"
                :options="dropzoneOptions"
                @vdropzone-sending="sending"
                class="my-4"
            />
        </div>
        <div v-if="images">
            <div :key="image.id" v-for="image in images">
                <img :src="'/storage/' + image.url" alt="product_img" class="max-w-sm">
            </div>
        </div>
    </div>
</template>

<script>
    import VueDropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        props: [
            'product'
        ],

        components: {
            VueDropzone,
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
            }
        }
    }
</script>

<style scoped>

</style>
