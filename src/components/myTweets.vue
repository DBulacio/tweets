<template>
    <myTweet :tweets="tweets" />
</template>

<script>
    import myTweet from './myTweet.vue'
    import axios from 'axios'

    export default {
        name: 'myTweets',
        components: {
            myTweet,
        },
        data() {
            return {
                tweets: []
            }
        },
        methods: {
            leerTweets() {
                axios.get('http://127.0.0.1/tweets/src/backend/leer_datos.php?action=fetchall')
                .then(response => {
                    this.tweets = response.data;
                }).catch((err) => {
                    this.tweets = [
                        {
                            'contenido': err,
                            'categoria': 'categoria',
                            'fecha': 'fecha',
                        }
                    ];
                })
            }
        },
        created() {
            this.leerTweets();
        }
    }
</script>