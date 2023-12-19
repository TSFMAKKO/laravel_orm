<template>
  <div>
    <h1>hi vue</h1>
    <h1>{{ message }}</h1>
  </div>
</template>

<script>
// 引入Vue庫
import Vue from 'vue';

// 在這裡引入其他的Vue組件或庫，如果有的話
// import OtherComponent from './OtherComponent.vue';

export default {
  data() {
    return {
      message: 'Hello, Vue!'
    };
  }
};
</script>


<style>
  /* your component's styles */
</style>