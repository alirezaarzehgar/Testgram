<template>
    <div>
        <a data-toggle="modal" data-target="#followerModal">
            <h6>{{title}}</h6>
        </a>

        <div class="modal fade" id="followerModal" tabindex="-1" role="dialog" aria-labelledby="followerModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body overflow-auto">
                    <v-member class="my-2" v-for="(user, index) in users" :key="index"
                        :profile="user.user.profile"
                    ></v-member>
                </div>
                </div>
            </div>
            </div>
    </div>
</template>
<script>
export default {
    props: ['users', 'title']
}
</script>
<style scoped>

</style>
