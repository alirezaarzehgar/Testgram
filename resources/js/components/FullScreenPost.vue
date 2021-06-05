<template>
    <div class="card my-5">
        <a class="link mx-2" :href="admin_link">{{admin_link}}</a>
        <div class="container">
            <div class="mb-5">
                <h2>{{ title }}</h2>
            </div>

            <div>
                <v-slider
                :user_id="user_id"
                :post_id="post_id"
                :images="images"></v-slider>
            </div>

            <div>
                <v-like-comment
                    :post_id="post_id"
                    :likes="post_likes"
                    :comments="post_comments"
                    ></v-like-comment>
            </div>


            <div class="mt-5">
                <p>{{ body }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'admin_link', 'title',
        'user_id', 'post_id',
        'images', 'body',
        'post_likes', 'post_comments'
    ],
    created() {

    },
    data() {
        return {
        }
    },
}
</script>

<style scoped>
    .link {
        color: #000;
        text-decoration: none;
    }
</style>
