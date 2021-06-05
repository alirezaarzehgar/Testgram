<template>
    <div class="my-3">
        <div class="col-4">
            <a class="d-flex justify-content-start owner" :href="userProfileLink">
                {{owner}}
            </a>

            <div class="d-flex justify-content-start border rounded bg-secondary">
                <div class="p-2">
                    {{text}}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['text', 'owner', 'user_profile'],
    data() {
        return {
            userProfileLink: '',
        }
    },
    created() {
        this.userProfileLink = '/' + this.user_profile;
    },

}
</script>
<style scoped>
    .owner {
        color: #000;
        text-decoration: none;
    }
</style>
