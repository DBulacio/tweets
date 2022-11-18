<template>
  <div class="container">
    <div class="align">
      <h1>Stetic News</h1>
      <input type="text">
    </div>

    <div>
      <myTweets />
    </div>
  </div>
</template>

<script>
// import HelloWorld from "./components/HelloWorld.vue";
import myTweets from "./components/myTweets.vue";

export default {
  name: "App",
  components: {
    myTweets,
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
</style>
