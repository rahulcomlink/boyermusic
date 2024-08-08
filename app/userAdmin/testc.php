<div id="myChart"></div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var colors = [
'#1AACAC', '#9ADE7B', '#0000FF', '#FF00FF', '#0174BE', '#FF6C22', '#495E57', '#8000FF',
'#D35400', '#3498DB', '#2E86C1', '#7D3C98', '#1F618D', '#AED6F1', '#D35400', '#3498DB',
'#2E86C1', '#7D3C98', '#1F618D', '#AED6F1', '#1AACAC', '#9ADE7B', '#0000FF', '#FF00FF',
'#0174BE', '#FF6C22', '#495E57', '#8000FF', '#D35400', '#3498DB', '#2E86C1', '#7D3C98',
'#1F618D', '#AED6F1', '#D35400', '#3498DB', '#2E86C1', '#7D3C98', '#1F618D', '#AED6F1',
'#1AACAC', '#9ADE7B', '#0000FF', '#FF00FF', '#0174BE', '#FF6C22', '#495E57', '#8000FF',
'#D35400', '#3498DB', '#2E86C1', '#7D3C98', '#1F618D', '#AED6F1', '#D35400', '#3498DB',
'#2E86C1', '#7D3C98', '#1F618D', '#AED6F1', '#1AACAC', '#9ADE7B', '#0000FF', '#FF00FF',
'#0174BE', '#FF6C22', '#495E57', '#8000FF'
];

    var options = {
          series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30]
        }],
          chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: colors,
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: [
            ['John', 'Doe'],
            ['Joe', 'Smith'],
            ['Jake', 'Williams'],
            'Amber',
            ['Peter', 'Brown'],
            ['Mary', 'Evans'],
            ['David', 'Wilson'],
            ['Lily', 'Roberts'], 
          ],
          labels: {
            style: {
              colors: colors,
              fontSize: '12px'
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#myChart"), options);
        chart.render();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
