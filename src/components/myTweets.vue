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
            leerTweets(action) {
                if(this.filter != "") {
                    action = this.filter
                }

                axios.get('http://127.0.0.1/tweets/src/backend/leer_datos.php?action='+action)
                .then(response => {
                    this.tweets = response.data;
                }).catch((err) => {
                    this.tweets = [
                        {
                            'contenido': 'Hubo un error en la lectura de base de datos: '+err,
                            'categoria': 'categoria',
                            'fecha': 'fecha',
                        }
                    ];
                })
            }
        },
        created() {
            this.leerTweets(this.filter);
        },
        watch: { // eslint-disable-next-line no-mixed-spaces-and-tabs
      	    filter: function(newVal) {
                this.leerTweets(newVal);
            }
        }
    }
</script>