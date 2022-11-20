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
        props: {
            filter: String
        },
        methods: {
            leerTweets() {
                let action = "fetchall";
                if(this.filter != "") {
                    action = this.filter
                }

                axios.get('http://127.0.0.1/tweets/src/backend/leer_datos.php?action=' + action)
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