<template>
  <div class="chart">
    <h2>Last month chart</h2>
    <div>
      <apexchart v-if="chartOptions.labels.length > 1" type="pie" width=380 :options="chartOptions" :series="series" />
      <div class="notice" v-show="chartOptions.labels.length <= 1">Add more activities to see the chart!</div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      series: [],
      chartOptions: {
        labels: Array,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 280
            },
            legend: {
              position: 'bottom'
            }
          }
        }],
        colors: ['#1240AB', '#3914AF', '#009999', '#FFAA00','#2A4480','#412C84','#1D7373'],
        // fill: {
        //   type: 'gradient',
        //   gradient: {
        //     shade: 'dark',
        //     type: "horizontal",
        //     gradientToColors: ['#00dbde','#ffdde1','#3d72b4','#135058','#FFD194','#dc2430','#267871'],
        //     opacityTo: 1,
        //   }
        // },
      },

    }
  },
  created() {
    this.getChartData();
    this.$root.$on('reRenderDashboard',() => {
        this.getChartData();
    });

  },
  methods : {
    getChartData() {
      axios
        .post('/api/getSummaryForLastMonth')
          .then(res => {
            this.chartOptions.labels = Object.keys(res.data);
            this.series = Object.values(res.data);
            console.log(this.chartOptions.labels);
          });
    },
  }
}
</script>

<style lang="scss">
.apexcharts-canvas {
  margin:0 auto;
}
</style>
