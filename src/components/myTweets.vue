<template>
    <!-- v-for -->
    <myTweet />
    <myTweet />
</template>

<script>
    import myTweet from './myTweet.vue'

    export default {
        name: 'myTweets',
        components: {
            myTweet,
        }
    }
</script>