<template>
  <div class="container">
    <div class="align">
      <h1>Stetic News</h1>
      <input v-model="textInput" type="text" placeholder="Search" />
    </div>

    <div>
      <myTweets :filter="textInput"/>
    </div>
  </div>
</template>

<script>
import myTweets from "./components/myTweets.vue";

export default {
  name: "App",
  components: {
    myTweets,
  },
  data() {
    return {
      textInput: ''
    }
  }
}
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
.align {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.search-input {
  width: 20%;
}
</style>
