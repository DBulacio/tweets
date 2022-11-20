<template>
    <div v-for="tweet in tweets" :key="tweet.id">
        <header class="align border-bottom">
            <!-- Categoría de publicación -->
            <p>{{tweet.categoria}}</p>
            <!-- Región de publicación -->
            <p>{{tweet.region}}</p>
        </header>
        <!-- Contenido -->
        <section class="border-bottom">
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

<style scoped>
    div {
        margin: .5rem 0;
        border: 1px solid black ;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5);
    }
    header {
        font-weight: bold;
        padding: .8rem 1rem 0 1rem;
        width: 100%;
    }
    section {
        text-align: start;
        padding: 1rem;
    }
    .border-bottom {
        border-bottom: 1px solid rgba(0, 0, 0, 0.3);
    }
    footer {
        padding: .8rem 1rem 0 1rem;
        font-weight: bold;
    }
</style>