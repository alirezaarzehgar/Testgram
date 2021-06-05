<template lang="en">
    <div>
        <div class="image-container">
            <div class="image-cropped">
                <img :src="filteredImages[0]"></img>
            </div>

            <div class="overally" @click="showPost()">
                <div class="d-flex justify-content-around align-items-center">
                    <div class="row h-25 w-25">
                        <svg style="fill:#FFF;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        </svg>

                        <p class="mx-2"> {{ commentscount }} </p>
                    </div>

                    <div class="row  h-25 w-25">
                        <svg style="fill:#FFF;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                           <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                        </svg>

                        <p class="mx-2"> {{ likescount }} </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    props: [
        'post_id', 'user_id',
        'title', 'descryption',
        'images', 'commentscount',
        'likescount', 'post_url'
    ],
    created() {
        this.filteredImages = this.images.map((image) => '/storage/posts/' + this.user_id + '/' + this.post_id + '/' + image);
    },
    data() {
        return {
            filteredImages: [],
        }
    },
    methods: {
        showPost() {
            window.location.href = this.post_url;
        }
    },
}
</script>
<style scoped>

div {
    width: 300px;
    height: 300px;
    overflow: hidden;
    margin: 10px;
    position: relative;
}
img {
    position: absolute;
    left: -1000%;
    right: -1000%;
    top: -1000%;
    bottom: -1000%;
    margin: auto;
    overflow: hidden;
    height: 300px;
    /* width: 300px; */
}

.image-container {
    height: 300px;
}

.overally {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.377);
    top: 0%;
    bottom: 100%;
    height: 0;

    transition: .5s ease;
}

.overally p {
    color: #fff;
}

.image-container:hover .overally {
    bottom: 100%;
    height: 100%;
}
</style>
