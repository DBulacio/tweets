<template>
    <myTweet :tweets="tweets" />
</template>

<script>
    import myTweet from './myTweet.vue'

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
        created() {
            // request!
            this.tweets = [
                {
                    categoria: 'Videojuegos',
                    region: 'Argentina',
                    contenido: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis quos, facere iste eius, labore, debitis placeat cumque optio cum a distinctio modi odit autem! Ipsa libero odit unde et quibusdam?',
                    fecha: 'hoy, 10:45',
                    enlace: 'google.com',
                },
                {
                    categoria: 'Noticias',
                    region: 'Ecuador',
                    contenido: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis quos, facere iste eius, labore, debitis placeat cumque optio cum a distinctio modi odit autem! Ipsa libero odit unde et quibusdam?',
                    fecha: 'ayer, 10:45',
                    enlace: 'cosas.com',
                }
            ]
        }
    }
</script>