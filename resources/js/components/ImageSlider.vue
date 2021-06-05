<template>
    <div>
        <div class="images">
            <slider
                animation="fade"
                height="500px"
            >
                <slider-item
                    v-for="(image, index) in filteredImages"
                    :key="index"
                    :style="image"
                    @click="hello"
                >
                <div class="row d-flex justify-content-center">
                    <img :src="image" alt="">
                </div>
                </slider-item>
            </slider>
        </div>
    </div>
</template>

<script>
import EasySlider from 'vue-easy-slider'
import { Slider, SliderItem } from 'vue-easy-slider'

export default {
    props: ['user_id', 'post_id', 'images'],
    created() {
        this.filteredImages = this.images.map((image) => '/storage/posts/' + this.user_id + '/' + this.post_id + '/' + image);
    },
    data() {
        return {
            filteredImages: [],
        }
    },
    methods: {
        hello($event) {

        },
    },
    components: {
        Slider,
        SliderItem,
    },
}
</script>

<style scoped>
    .images img {
        height: 500px;
    }

    .images {
        background-color: rgb(15, 15, 15);
    }
</style>
