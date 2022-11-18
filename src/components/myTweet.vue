<template>
    <div v-for="tweet in tweets" :key="tweet-id">
        <header class="align">
            <!-- Categoría de publicación -->
            <p>{{tweet.categoria}}</p>
            <!-- Región de publicación -->
            <p>{{tweet.region}}</p>
        </header>
        <!-- Contenido -->
        <section>
            <p>{{tweet.contenido}}</p>
        </section>
        <footer class="align">
            <!-- Fecha y hora -->
            <p>{{tweet.fecha}}</p>
            <!-- Links -->
            <p>ver más en <a href="">{{tweet.enlace}}</a></p>
        </footer>
    </div>
</template>

<script>
export default {
    name: 'myTweet',
    props: {
        tweets: Array
    }
}
</script>

<style>
.align {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
</style>