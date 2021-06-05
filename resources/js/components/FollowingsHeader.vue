<template>
    <div class="row d-flex flex-row overflow-auto">
        <div dir="col"  v-for="(profile, index) in profiles" :key="index" @click="gotoAccount(profile.username)">
            <img class="mx-2 profile" alt="not found" :src="profile.url">

            <p class="text-center">{{profile.username}}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['followings'],
    created() {
        this.profiles = this.followings.map((following) => {
            let link = following.image.url.split('/')[2];

            let url = '/storage/profiles/' + link;

            return {url: url, username: following.username};
        });
    },
    data() {
        return {
            profiles: ''
        }
    },
    methods: {
        gotoAccount(username) {
            window.location.href = '/' + username;
        }
    },
}
</script>

<style scoped>
    .profile {
        width: 60px;
        height: 60px;
    }
</style>
