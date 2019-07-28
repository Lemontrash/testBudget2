<template>
  <div class="header">
    <div class="header-content">

      <router-link :to="'/'" class="logo">
        <span>LOGO</span>
      </router-link>

      <nav class="main-menu">
      <router-link :to="'/'">Home</router-link>
      <router-link :to="'/'">Example</router-link>
      <router-link :to="'/'">Example</router-link>
      <router-link :to="'/'">Example</router-link>

      </nav>

      <div class="user-actions">
        <a class="btn inverted" v-if="currentUser == false" href="/register">SignUp</a>
        <a class="btn" v-if="currentUser == false" href="/login">Login</a>

        <router-link class="btn inverted" v-if="currentUser == true" :to="'/my-account'">My Account</router-link>
        <button class="btn" v-if="currentUser == true" @click="logout">Logout</button>
      </div>

      <button class="mobile-menu-trigger" @click="openMobileMenu($event)"><i class="far fa-bars"></i></button>

    </div>
    <modal v-if="openLoginModal" @close="closeLoginModal"><login/></modal>
  </div>

</template>

<script>
import Login from './Login.vue';
import Modal from './../modals/Modal.vue';
export default {
  data() {
    return {
      currentUser : false,
      openLoginModal : false,
    }
  },
  created() {
    // console.log(this.$root.getCurrentUser());
      axios
        .post('/getCurrentUser')
          .then(res => {
            console.log(res.data);
            if(res.data != false) {
              this.currentUser = true;
            }
          });
  },
  methods : {
    openMobileMenu(e) {
      document.querySelector('.header').classList.toggle('is_active');
    },
    logout() {
      axios
        .get('/logout')
          .then(res => {
            if(res.data.success) {
              this.$cookies.remove('token');
              document.location.reload(true);
            }
          })
          .catch(err => {console.log(err);})
    },
    openLogin() {
      this.openLoginModal = true;
    },
    closeLoginModal(value) {
      this.openLoginModal = value;
    }
  },
  components : {
    Login,
    Modal,
  }

}
</script>

<style lang="scss" scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 80px;
  background-color: #f8fafc;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  z-index: 5;
  .header-content {
    width:100%;
    height:100%;
    max-width: 1440px;
    padding: 8px 24px;
    margin: 0 auto;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    .mobile-menu-trigger {
      display: none;
      outline:none;
      background-color: transparent;
      border-style:hidden;
      font-size: 32px;
      i {
        pointer-events: none;
      }
    }
    .logo {
      width:160px;
      height:80px;
      flex-basis:20%;
      background-color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #333;
      font-size: 40px;
      img {
        width:100%;
        height:100%;
        object-fit: cover;
        display: block;
      }
    }
    nav.main-menu {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      flex-grow: 2;
      padding:0 16px;
      a {
        display: block;
        margin: 0 8px;
        color: #333;
        font-size: 18px;
      }
    }
    .user-actions {
      display: flex;
      flex-direction: row;
      align-items: center;
      flex-basis:20%;
      .btn {
        display: block;
        margin-left:16px;
      }
    }
  }

}

@media (max-width:900px) {
  .header {
    height:76px;
    transition: .3s;
    .header-content {
      .mobile-menu-trigger {
        display: block;
        transition: .3s;
      }
      .logo {
        height:60px;
        flex-basis:unset;
        width:100px;
        transition: .3s;
      }
      nav.main-menu {
        display: none;
        transition: .3s;
      }
      .user-actions {
        display: none;
        transition: .3s;
      }
    }
    &.is_active {
      height:100vh;
      .header-content {
        flex-direction: row;
        flex-wrap:wrap;
        align-items: flex-start;
        justify-content: center;
        .logo {
          order: 1;
          flex-basis:50%;
          max-width:100px;
          img {
            width:100px;
          }
        }
        .mobile-menu-trigger {
          order: 2;
          flex-basis:50%;
          display: flex;
          justify-content: flex-end;
          align-items: center;
          height: 60px;
          flex-grow:2;
        }
        nav.main-menu {
          flex-basis:100%;
          order: 3;
          display: flex;
          flex-direction: column;
          margin: 0;
          align-items: center;
          justify-content: center;
          a {
            margin: 8px 0;
            font-size: 20px;
          }
        }
        .user-actions {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          order:4;
          .btn {
            margin:0 0 12px 0;
          }
        }
      }
    }
  }
}
</style>
