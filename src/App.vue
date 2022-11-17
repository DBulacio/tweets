<template>
  <div class="container">
    <div class="align">
      <h1>Stetic News</h1>
      <input type="text">
    </div>

    <div >
      <Tweets />
    </div>
  </div>
</template>

<script>
// import HelloWorld from "./components/HelloWorld.vue";
import Tweets from "./components/Tweets.vue";

export default {
  name: "App",
  components: {
    Tweets,
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.container {
  margin: 0 10rem;
}
</style>
