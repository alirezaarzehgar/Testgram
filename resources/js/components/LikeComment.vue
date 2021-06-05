<template>
    <div>
        <div class="row justify-content-end mx-5">
            <!-- likes -->
            <form :action="likePath" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <button class="border-0" data-toggle="tooltip" data-placement="top" :title="likes">
                    <div class="mx-1">
                        <svg style="fill:#000;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                            <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                        </svg>
                    </div>
                </button>
            </form>

            <!-- commments -->
            <a :href="commentPath">

            <button class="border-0" data-toggle="tooltip" data-placement="top" :title="comments">
                <div class="mx-1">
                    <svg style="fill:#000;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    </svg>
                </div>
            </button>
            </a>
        </div>
    </div>
</template>
<script>
export default {
    props: ['post_id', 'likes', 'comments'],
    created() {
        this.baseUrl = '/post/' + this.post_id;
        this.commentPath = this.baseUrl + '#comments';
        this.likePath = this.baseUrl + '/like';
    },
    data() {
        return {
            baseUrl: '',
            commentPath: '',
            likePath: '',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
}
</script>

<style scoped>

</style>
