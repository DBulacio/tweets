<template>
    <div>
        <header class="align">
            <!-- Categoría de publicación -->
            <p>{{categoria}}</p>
            <!-- Región de publicación -->
            <p>{{region}}</p>
        </header>
        <!-- Contenido -->
        <section>
            <p>{{contenido}}</p>
        </section>
        <footer class="align">
            <!-- Fecha y hora -->
            <p>{{fecha}}</p>
            <!-- Links -->
            <p>ver más en <a href="">{{enlace}}</a></p>
        </footer>
    </div>
</template>

<script>
export default {
    name: 'myTweet',
    data() {
        return {
            categoria: 'Videojuegos',
            region: 'Argentina',
            contenido: 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis quos, facere iste eius, labore, debitis placeat cumque optio cum a distinctio modi odit autem! Ipsa libero odit unde et quibusdam?',
            fecha: 'hoy, 10:45',
            enlace: 'google.com',
        }
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