<template>
    <div class="container testimonial-group">
        <div class="row text-center">
            <div class="col-1"  v-for="(profile, index) in profiles" :key="index" @click="gotoAccount(profile.username)">
                <img class="mx-2 profile" alt="not found" :src="profile.url">

                <p class="text-center" data-toggle="tooltip" data-placement="top" :title="profile.username">{{profile.username.substring(0, 10)}}</p>
            </div>
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

/* The heart of the matter */
.testimonial-group > .row {
  display: block;
  overflow-x: auto;
  white-space: nowrap;
}

.testimonial-group > .row > .col-1 {
  display: inline-block;
}

</style>
