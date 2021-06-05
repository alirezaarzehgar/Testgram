<template>
    <div class="container-fluid mx-2">
        <div class="row-cols-5 d-flex align-items-center">
            <div>
                <img class="image" :src="image" alt="not found">
            </div>

            <div>
                <a class="link" :href="link">{{profile.username}}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['profile'],
    created() {
        this.image = this.profile.image.url;
        this.image = this.image.split('/')[2];
        this.image = '/storage/profiles/' + this.image;

        this.link = '/' + this.profile.username;
    },
    data() {
        return {
            image: '',
            link: '',
        }
    },
}
</script>

<style scoped>
    .image {
        height: 40px;
        width: 40px;
        border-radius: 50%;
    }

    .link {
        color: #000;
        text-decoration: none;
    }
</style>
