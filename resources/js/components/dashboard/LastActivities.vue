<template>
  <div class="last-activities">
    <h2>Last activities</h2>
    <ul class="activities">
      <li class="activity heading">
        <span class="name">Name</span>
        <span class="category">Category</span>
        <span class="amount">Amount</span>
        <span class="date">Date</span>
        <span class="actions">Actions</span>
      </li>
      <li class="activity" v-for="(activity,i) in activities" :key="i">

        <span class="name">{{ activity.activity_name }}</span>
        <span class="category">{{ activity.category_id }}</span>
        <span class="amount">{{ activity.amount_of_money }}</span>
        <span class="date">{{  new Date( activity.created_at*1000 ) | formatDate }}</span>
        <span class="actions">
          <button class="delete" @click="deleteActivity($event,activity.id)"><i class="fas fa-trash-alt"></i></button>
        </span>
      </li>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activities : null,
    }
  },
  created() {
    this.getAllActivities();
    this.$root.$on('reRenderDashboard',() => {
      this.getAllActivities();
    });
  },
  methods : {
    deleteActivity(e,id) {
      axios
        .post('/deleteActivity',{ activityId : id})
          .then(res => {
              this.$root.$emit('reRenderDashboard');
          });
    },
    getAllActivities() {
      axios
        .post('/getAllActivities')
          .then(res => {
            if(res.data.success != false) {
              this.activities = res.data;
            }else {
              this.activities = [];
            }

          });
    }
  }
}
</script>

<style lang="scss" scoped>
.last-activities {

  .activities {
    margin: 0;
    padding: 0;
    border:1px solid #e0e0e0;
    padding-top: 4px;
    border-radius: 10px;
    .activity {
      list-style-type: none;
      margin-bottom: 4px;
      border-bottom:1px solid #e0e0e0;
      padding:4px 12px;
      display: flex;
      flex-direction: row;
      color: #333;
      &.heading {
        span {
            font-weight: bold;
        }
      }
      &:last-child {
        border-bottom-width:0;
      }
      span {
        flex-basis:26.5%;
        padding-right:8px;
        &.amount {
          flex-basis: 10%;
        }
        &.actions {
          display: flex;
          flex-direction: row;
          align-items: flex-start;
          justify-content: center;
          flex-basis:10%;
          button {
            background-color: #fff;
            border-radius: 50%;
            color:#333;
            border-style: hidden;
            outline: none;
            &:hover {
              background-color: rgba(0,0,0,0.1);
            }
          }
        }
      }
    }
  }
}

@media (max-width:900px) {
  .last-activities {
    .activities {
      .activity {
        flex-direction: row;
        flex-wrap:wrap;
        &.heading {
          display: none;
        }
        span {
          flex-basis:100%;
          order:10;
          margin-bottom: 4px;
          font-size: 18px;
          &:before {
            font-weight: bold;
            padding-right: 6px;
          }
          &.name {
            order:1;
            width:100%;
            &:before {
              content: 'Name:';
            }
          }
          &.amount {
            order:2;
            width:100%;
            &:before {
              content: 'Amount:';
            }
          }
          &.category {
            order:3;
            &:before {
              content: 'Category:';
            }
          }
          &.date {
            order:4;
            flex-basis:80%;
            width:80%;
            padding-right:8px;
          }
          &.actions {
            order:5;
            flex-basis:20%;
            justify-content: flex-end;
            width:20%;
            padding: 0;
          }
        }
      }
    }
  }
}
</style>
