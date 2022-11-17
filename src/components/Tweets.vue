<template>
    <!-- v-for -->
    <Tweet />
    <Tweet />
</template>

<script>
    import Tweet from './Tweet.vue'

    export default {
        name: 'Tweets',
        components: {
            Tweet,
        }
    }
</script>