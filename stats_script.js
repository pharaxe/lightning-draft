StatsManager = new Class({

   initialize: function() {
      this.data= JSON.decode($('data').get('data-stats'));
      this.createColorChart();
      this.createCMCChart();
      this.createTypeChart();
      //this.createDepthChart();
   }, 

   createCMCChart: function() {
      var ctx = $('cmcChart').getContext('2d');
      var chart_data = this.data.cmc_count;
      var cmcChart = new Chart(ctx, {
         type: 'bar',
         data: {
            labels: Object.keys(chart_data),
            datasets: [{
               label: 'Converted Mana Cost',
               data: Object.values(chart_data),
               backgroundColor: 'rgba(150, 133, 154, .7)',
               boardColor: '#000000'

            }]
         },
          options: {
             responsive: true,
             maintainAspectRatio: false

          }
      });
   },


   createTypeChart: function() {
      var ctx = $('typeChart').getContext('2d');
      var chart_data = this.data.type_count;
      var typeChart = new Chart(ctx, {
         type: 'pie',
         data: {
            labels: Object.keys(chart_data),
            datasets: [{
               label: 'Card Types',
               data: Object.values(chart_data),
               backgroundColor: [
                  '#009933',
          '#AC4C5E',
'#1E6262',
'#5C476F', 
          '#B4F1F1',
          '#98651E',
          '#FF5656',
'#EEEEEE',


               ],
                boarderWidth: 1
            }]
         },
          options: {
             responsive: true,
             maintainAspectRatio: false

          }

      });
   },

   createColorChart: function() {
      var ctx = $('colorChart').getContext('2d');
      var color_data = this.data.color_count;
      var colorChart = new Chart(ctx, {
         type: 'pie',
         data: {
            labels: Object.keys(color_data),
            datasets: [{
               label: 'Colors',
               data: Object.values(color_data),
               backgroundColor: [
                  'rgba(255, 255, 153, 1)',
                  'rgba(0, 0, 255, .8)',
                  'rgba(0,0,0, .8)',
                  'rgba(255, 0, 0, .8)',
                  '#57e357',
                  'rgba(153, 102, 51, .8)'
               ],
                boardColor: [
                  'rgba(255,255, 153, 1)',
                  'rgba(34, 59, 221, 1)',
                  'rgba(0,0,0, 1)',
                  'rgba(221, 34, 34, 1)',
                  'rgba(34, 221, 47, 1)',
                  'rgb(153, 102, 51, 1)'
                ],
                boarderWidth: 1
            }]
         }

      });
   },

   createDepthChart: function() {
      var ctx = $('depthChart').getContext('2d');
      var color_data = this.data.color_count;
      var colorChart = new Chart(ctx, {
         type: 'polarArea',
         data: {
            labels: Object.keys(color_data),
            datasets: [{
               label: 'Colors',
               data: Object.values(color_data),
               backgroundColor: [
                  'rgba(255, 255, 153, 1)',
                  'rgba(0, 0, 255, .8)',
                  'rgba(0,0,0, .8)',
                  'rgba(255, 0, 0, .8)',
                  'rgba(0, 255, 0, .8)',
                  'rgba(153, 102, 51, .8)'
               ],
                boardColor: [
                  'rgba(255,255, 153, 1)',
                  'rgba(34, 59, 221, 1)',
                  'rgba(0,0,0, 1)',
                  'rgba(221, 34, 34, 1)',
                  'rgba(34, 221, 47, 1)',
                  'rgb(153, 102, 51, 1)'
                ],
                boarderWidth: 1,
            }]
         },
         options: {
          scale: {
             ticks:{ 
                beginAtZero:true,
                max: 65
             }
          }
         }
      });
   }
});

window.addEvent('load', function() {
   stats_manager = new StatsManager();
});
