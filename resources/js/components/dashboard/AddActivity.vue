<template>
  <div class="add-activity">
    <h2>Add new activity</h2>
    <div class="activity-input">
      <input class="activity-name" type="text" v-model="activityName" placeholder="Activity name">
      <input class="activity-amount" type="number" v-model="activityAmount" placeholder="Activity amount">
      <ul class="categories">
        <li v-for="category in categories" class="category" @click="selectCategory($event,category.id)" :cat-id="category.id">
          <i :class="category.icon"></i>
          <span>{{category.name}}</span>
        </li>

      </ul>

      <button class="btn" @click="saveActivity">Save</button>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories : null,
      activityName : null,
      activityAmount : null,
      selectedCategoryId : null,

    }
  },
  created() {
    // let user_token = this.$cookies.get('token');
    // if(user_token) {
      // console.log(user_token);
      axios.post('/getAllCategories')
        .then(res=>{
          // console.log(res);
          this.categories = res.data.value;
        })
    // }

  },
  methods : {
    selectCategory(e,catId) {

      //add selected class
      let categories = document.getElementsByClassName('category');
      [].forEach.call(categories, function(el) {
          el.classList.remove('selected');
      });
      e.target.classList.add('selected');

      this.selectedCategoryId = catId;
    },
    saveActivity() {
      if(this.activityName != null && this.activityAmount != null && this.selectedCategoryId != null) {
        axios.post('/addActivity',{
          categoryId : this.selectedCategoryId,
          money : this.activityAmount,
          currency : 'USD',
          name : this.activityName
        })
          .then(res => {
            this.$root.$emit('reRenderDashboard');
          })
      }
    },
  }
}
</script>

<style lang="scss" scoped>
.add-activity {

  .activity-input {
    display: flex;
    flex-direction: column;
    align-items: flex-start;

    input {
      width:100%;
      margin-bottom: 12px;
      border-radius: 10px;
      border-color:transparent;
      box-shadow:0 4px 10px rgba(0,0,0,0.1);
      padding:6px 16px 6px 6px;
      outline:none;
      border-style: solid;
      &:focus {
        border-color:cornflowerblue;
      }
    }
    // .activity-name {
    //
    // }
    // .activity-amount {
    //
    // }
    .categories {
      display: flex;
      margin: 0 0 12px;
      padding: 0;
      border-radius: 10px;
      box-sizing: border-box;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      flex-direction: row;
      flex-wrap: wrap;
      overflow-y:scroll;
      max-height:200px;
      scrollbar-color: cornflowerblue #EBEBEB;
      scrollbar-width: thin;
      &::-webkit-scrollbar {
          width: 8px;

      }
      &::-webkit-scrollbar-track {
          -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0);
          border-radius: 10px;
          padding-top: 4px;
          padding-bottom: 4px;
      }
      &::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: cornflowerblue;
        outline: 1px solid slategrey;
      }
      li.category {
        flex-basis: 20%;
        width:20%;
        padding:12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color:#333;
        height:100px;
        flex-grow: 2;
        cursor : pointer;
        i {
          font-size: 32px;
          pointer-events: none;
        }
        span {
          font-size: 18px;
          pointer-events: none;
          line-height: 18px;
          text-align: center;
          display: block;
          margin-top: 8px;
        }
        &:hover,&.selected {
          background-color: cornflowerblue;
          color:#fff;
        }
      }
    }
  }
}
@media (max-width:900px) {
  .add-activity {
    .activity-input {
      .categories {
        li.category {
          flex-basis:33%;
          width:33%;
        }
      }
    }
  }
}
</style>
