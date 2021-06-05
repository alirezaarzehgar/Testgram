<template>
    <div>
        <div class="ui search">
            <input class="text-center" placeholder="Search" v-on:keyup="suggestion" v-model="text">
            <div id="result" class="my-2">
                <v-member class="my-3" v-for="(item, index) in result" :key="index" :profile="item"></v-member>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            text: '',
            result: '',
        }
    },
    methods: {
        suggestion() {
            axios.get('/api/users/' + this.text).then(({data}) => {
                this.result = data;
                let result = document.getElementById('result');

                if (this.result.length > 0) {
                    result.style.display = 'block';
                } else {
                    result.style.display = 'none';
                }
            });
        }
    },
}
</script>

<style scoped>
    #result {
        position: absolute;
        z-index: 1;

        max-height: 500px;
        width: 400px;

        overflow-y: auto;
        overflow-x: hidden;

        background-color: #fff;

        display: none;
    }
</style>
