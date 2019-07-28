<template>
  <main>
    <main-header />
    <router-view v-if="currentUser"></router-view>
    <div class="notice" v-if="currentUser == false">You should be logged in to see this page!</div>
  </main>
</template>

<script>
import Home from './components/Home.vue';
import MainHeader from './components/parts/MainHeader.vue';

export default {
  data() {
    return {
      currentUser : false,
    }
  },
  components : {
    Home, MainHeader,
  },
  created() {
    axios
      .post('/getCurrentUser')
        .then(res => {
          if(res.data != false) {
            this.currentUser = true;
          }
        });
  }



}
</script>

<style lang="scss" scoped>
main {
  max-width:1440px;
  padding:96px 24px 0;
  margin:0 auto;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
@media (max-width:900px) {
  main {
    padding:76px 12px 0;
  }
}
</style>
