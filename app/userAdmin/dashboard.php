
<?php
include 'header.php';


//Total Active Production List
$totalProductionQuery = "SELECT COUNT(*) as tt FROM `user_details` WHERE `user_production_type` = '2'";
$prTotal = $conn->query($totalProductionQuery);
$prRow = $prTotal->fetch_assoc();
$totalProduction = $prRow['tt'];

//Total Individual User
$totalIndQuery = "SELECT COUNT(*) as tt FROM `user_details` WHERE `user_production_type` = '1'";
$inTotal = $conn->query($totalIndQuery);
$inRow = $inTotal->fetch_assoc();
$totalIn = $inRow['tt'];


//Total Active User
$totalActiveQuery = "SELECT COUNT(*) as tt FROM `user_details`";
$activeTotal = $conn->query($totalActiveQuery);
$activeRow = $activeTotal->fetch_assoc();
$totalActiveUser = $activeRow['tt'];


//Total Songs Count//
$totalSongQuery = "SELECT COUNT(*) AS tsong FROM songs WHERE content_status = 'ACTIVE'";
$tResult = $conn->query($totalSongQuery);
$tRow = $tResult->fetch_assoc();
$totalSongs = $tRow['tsong'];


//Total Pending Song//
$totalPendingQuery = "SELECT COUNT(*) AS tsong FROM songs WHERE content_status = 'PENDING'";
$pResult = $conn->query($totalPendingQuery);
$pRow = $pResult->fetch_assoc();
$totalPendingSongs = $pRow['tsong'];


//Total Premium Song//
$totalPremiumQuery = "SELECT COUNT(*) AS tsong FROM songs WHERE content_isPremium = 'Yes'";
$prResult = $conn->query($totalPremiumQuery);
$prRow = $prResult->fetch_assoc();
$totalPremiumSongs = $prRow['tsong'];


//Total Premium Income//
$totalPremiumIncomeQuery = "SELECT 
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_isrc = balance.song_isrc
WHERE
    balance.balance_date >= songs.content_premiumAt
    AND songs.content_isPremium = 'Yes'";
$piResult = $conn->query($totalPremiumIncomeQuery);
$piRow = $piResult->fetch_assoc();
$totalPremiumIncome = $piRow['revenue'];

//Premium Calculation
$Percent10P = $totalPremiumIncome * 0.10;
$distributedAmountP = $totalPremiumIncome - $Percent10P;
$ProductionIncomeP = $distributedAmountP * 0.9;
$OwnerIncomeP = $distributedAmountP * 0.1;

echo $Percent10P;
echo $distributedAmountP;
echo $ProductionIncomeP;
echo $OwnerIncomeP;



// Total Revenue Query //
$revenueQuery = "SELECT     
    SUM(balance.song_income) AS revenue
FROM 
    balance
INNER JOIN 
    songs ON songs.song_isrc = balance.song_isrc
WHERE
    (
        (songs.content_isPremium = 'Yes' AND balance.balance_date <= songs.content_premiumAt)
        OR songs.content_isPremium = 'No'
    )"; 
$revenueResult = $conn->query($revenueQuery);
$revenueRow = $revenueResult->fetch_assoc();
$formattedIncome = $revenueRow['revenue'];

//Normal Calculation
$Percent10 = $formattedIncome * 0.10;
$distributedAmount = $formattedIncome - $Percent10;
$ProductionIncome = $distributedAmount * 0.4;
$OwnerIncome = $distributedAmount * 0.6;

//Total Revenu
$tup = $OwnerIncome + $OwnerIncomeP;




// Assuming you have already established a MySQLi connection ($conn)
$currentDate = date('Y-m-d');
$startOfMonth = date('Y-m-01'); // First day of the current month
$endOfMonth = date('Y-m-t'); // Last day of the current month

$dataQuery = "SELECT original_l2_name, SUM(song_income) AS Total_Income 
    FROM balance 
    WHERE balance_date 
    GROUP BY original_l2_name 
    ORDER BY Total_Income DESC 
    LIMIT 10
";
$dataResult = $conn->query($dataQuery);
if (!$dataResult) {
    die("Error in SQL query: " . $conn->error);
}
$data = array();
while ($row = $dataResult->fetch_assoc()) {
    $data[] = $row;
}
$dataPoints = array();
foreach ($data as $row) {
    $dataPoints[] = array('x' => $row['original_l2_name'], 'y' => (int)$row['Total_Income']);
}
$dataScheme = array_column($data, 'original_l2_name');
$dataAllScheme = json_encode($dataScheme);
$dataJSON = json_encode(array_column($dataPoints, 'y'));




$dataQuerySong = "SELECT song_name AS songName, SUM(song_income) AS Total_Income 
    FROM balance 
    WHERE balance_date BETWEEN '$startOfMonth' AND '$endOfMonth'
    GROUP BY songName
    ORDER BY Total_Income DESC 
    LIMIT 10
";
$songDataResult = $conn->query($dataQuerySong);
if (!$songDataResult) {
    die("Error in SQL query: " . $conn->error);
}
$songData = array();
while ($row = $songDataResult->fetch_assoc()) {
    $songData[] = $row;
}
$songDataPoints = array();
foreach ($songData as $row) {
    $totalIncome = (int)$row['Total_Income'];
    $after10PercentDeduction = $totalIncome * 0.90; // Deduct 10%
    $finalAmount = $after10PercentDeduction * 0.40; // 40% of the remaining amount
    $songDataPoints[] = array('name' => $row['songName'], 'y' => $finalAmount, 'z' => $after10PercentDeduction);
}
$songDataJSON = json_encode($songDataPoints);



$balanceQuery = "SELECT balance_date, SUM(song_income) AS Total_Income FROM balance GROUP BY balance_date";
$balanceResult = $conn->query($balanceQuery);
if (!$balanceResult) {
    die("Error in SQL query: " . $conn->error);
}
$balanceData = array();
while ($row = $balanceResult->fetch_assoc()) {
    $balanceData[] = $row;
}
$balanceDataPoints = array();
foreach ($balanceData as $row) {
    $totalIncome = (int)$row['Total_Income'];
    $after10PercentDeduction = $totalIncome * 0.90; // Deduct 10%
    $finalAmount = $after10PercentDeduction * 0.40; // 40% of the remaining amount
    $balanceDataPoints[] = array('date' => $row['balance_date'], 'value' => $totalIncome);
}
$balanceDataJson = json_encode($balanceDataPoints);

echo $balanceDataJson;





?>












<main class="page-content">
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
    
    <div class="col">
                <div class="card radius-10 bg-success">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Total Revenue</p>
                        <h4 class="mb-0 text-white">₹<?php echo number_format($tup, 0); ?></h4>
                      </div>
                      <div class="ms-auto widget-icon bg-white-1 text-white">
                      <i class="fa-solid fa-dollar-sign"></i>                      </div>
                    </div>
                  </div>
                </div>
    </div>


    <div class="col">
                <div class="card radius-10" style="background:#134B70">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Non Premium Revenue</p>
                        <h4 class="mb-0 text-white">₹<?php echo number_format($OwnerIncome, 0); ?></h4>
                      </div>
                      <div class="ms-auto fs-2 text-white">
                      <i class="fa-solid fa-spray-can-sparkles"></i>                      </div>
                    </div>
                  </div>
                </div>
    </div>


    <div class="col">
                <div class="card radius-10" style="background:#028391;">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Premium Revenue</p>
                        <h4 class="mb-0 text-white">₹<?php echo number_format($OwnerIncomeP, 0); ?></h4>
                      </div>
                      <div class="ms-auto fs-2 text-white">
                      <i class="fa-solid fa-circle-dollar-to-slot"></i>                      </div>
                    </div>
                  </div>
                </div>
    </div>


    <div class="col">
                  <div class="card radius-10" style="background:#6B8A7A;">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="">
                          <p class="mb-1 text-white">Total Non Premium Distributed Amount</p>
                          <h4 class="mb-0 text-white">₹<?php echo number_format($ProductionIncome,0); ?></h4>
                        </div>
                        <div class="ms-auto fs-2 text-white">
                        <i class="fa-solid fa-network-wired"></i>                      </div>
                      </div>
                    </div>
                  </div>
    </div>


    <div class="col">
                  <div class="card radius-10" style="background:#006769;">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="">
                          <p class="mb-1 text-white">Total Premium Distributed Amount</p>
                          <h4 class="mb-0 text-white">₹<?php echo number_format($ProductionIncomeP,0); ?></h4>
                        </div>
                        <div class="ms-auto fs-2 text-white">
                        <i class="fa-brands fa-cloudflare"></i>                      </div>
                      </div>
                    </div>
                  </div>
    </div>

    <div class="col">
                <div class="card radius-10" style="background:#D89216">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Total Songs</p>
                        <h4 class="mb-0 text-white"><?php echo $totalSongs; ?></h4>
                      </div>
                      <div class="ms-auto fs-2 text-white">
                      <i class="fa-solid fa-music"></i>
                                          </div>
                    </div>
                  </div>
                </div>
               </div>

                <div class="col">
                  <div class="card radius-10 bg-primary">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="">
                          <p class="mb-1 text-white">Total Premium</p>
                          <h4 class="mb-0 text-white"><?php echo $totalPremiumSongs; ?></h4>
                        </div>
                        <div class="ms-auto fs-2 text-white">
                        <i class="fa-solid fa-sack-dollar"></i>                     </div>
                      </div>
                    </div>
                  </div>
                </div>   

                


           


                <div class="col">
                  <div class="card radius-10 bg-danger">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="">
                          <p class="mb-1 text-white">Total Active User</p>
                          <h4 class="mb-0 text-white"><?php echo $totalActiveUser; ?></h4>
                        </div>
                        <div class="ms-auto fs-2 text-white">
                        <i class="fa-solid fa-user-secret"></i>                      </div>
                      </div>
                    </div>
                  </div>
                </div>


                
  </div>


        <div class="col-12 col-xl-12 col-xxl-12 d-flex">
          
          <div class="col-4 col-xl-4 col-xxl-4 d-flex" style="padding:10px;">
            <div class="card radius-10 w-100">
              <div id="myChart"></div>
            </div>
          </div>

          <div class="col-4 col-xl-4 col-xxl-4 d-flex" style="padding:10px;">
            <div class="card radius-10 w-100">
              <div id="highChart" style="background:white;"></div>
            </div>
          </div>
          <div class="col-4 col-xl-4 col-xxl-4 d-flex" style="padding:10px;">
            <div class="card radius-10 w-100">
              <div id="activeUser" style="background:white;"></div>
            </div>
          </div>
        </div>

<div class="col-12 col-xl-12 col-xxl-12">
<div id="dashboardNew"></div>


</div>




<div class="col-12 col-xl-12 col-xxl-12 d-flex">
      <div class="card radius-10 w-100" style="background-color: #202a40;color:white">
        <div class="card-body">
          <div class="row g-3 align-items-center">
            <div class="col-9">
              <h5 class="mb-0">Content Revenue History</h5>
            </div>
          </div>
          <div class="table-responsive mt-4">
            <table class="table align-middle mb-0 table-hover" id="Transaction-History">
              <thead class="table-light" >
                <tr >
                  <th style="background-color: #12bf24 !important;">Song Title</th>
                  <th style="background-color: #12bf24 !important;">ISRC</th>
                  <th style="background-color: #12bf24 !important;">Total Income</th>
                  <th style="background-color: #12bf24 !important;">Status</th>
                  <th style="background-color: #12bf24 !important;">Premium</th>
                  <th style="background-color: #12bf24 !important;">Date</th>
                </tr>
              </thead>
              <tbody>
                
              

              <?php
$premiumSongsSql = "SELECT * FROM songs WHERE content_createdBy = '$productionCode'";
$premiumSongsResult = $conn->query($premiumSongsSql);

while ($row = $premiumSongsResult->fetch_assoc()) {
?>

<tr style="color:white;">
    <td>
        <div class="d-flex align-items-center">
            <div class="">
                <img src="../public/uploads/<?php echo $row['content_art'];?>" class="rounded-circle" width="46" height="46" alt="" />
            </div>
            <div class="ms-2">
                <h6 class="mb-1 font-14"><?php echo $row['song_title']; ?></h6>
                <!-- <p class="mb-0 font-13 text-secondary">Refrence Id #8547846</p> -->
            </div>
        </div>
    </td>
    <td><?php echo $row['song_isrc']; ?></td>
    <td>₹0</td>
    <td>
            <?php echo $row['content_status']; ?>
    </td>

    <td>
            <?php echo $row['content_isPremium']; ?>
    </td>
    <td>
            <?php echo $row['content_createdAt']; ?>
    </td>
</tr>

<?php
}
?>


              
              
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div id="songChart"></div>


  


    
  </div>
  <!--end row-->
</main>


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
          data:           <?php echo $dataJSON; ?>
          
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
          categories: 
            <?php echo $dataAllScheme; ?>
          ,
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


// Data retrieved from https://worldpopulationreview.com/country-rankings/countries-by-density
Highcharts.chart('highChart', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: '',
        align: 'left'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> ' +
            '{point.name}</b><br/>' +
            'Revenue Amount: <b>{point.y}</b><br/>' +
            'Admin Amount: <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        borderRadius: 5,
        data: <?php echo $songDataJSON; ?>,
        colors: [
            '#4caefe',
            '#3dc3e8',
            '#2dd9db',
            '#1feeaf',
            '#0ff3a0',
            '#00e887',
            '#23e274'
        ]
    }]
});



const jsonData = <?php echo $balanceDataJson; ?>

        // Prepare data for Highcharts
        const dayWiseData = jsonData.map(item => [new Date(item.date).getTime(), item.value]);

        Highcharts.chart('dashboardNew', {

            chart: {
                type: 'area',
                zooming: {
                    type: 'x'
                },
                panning: true,
                panKey: 'shift',
                scrollablePlotArea: {
                    minWidth: 600
                },
                backgroundColor: '#FFFFFF' // Set background color to white
            },

            title: {
                text: 'Revenue Overtime',
                align: 'left'
            },

            credits: {
                enabled: false
            },

            xAxis: {
                type: 'datetime',
                title: {
                    text: 'Date'
                },
                labels: {
                    format: '{value:%b %d}' // Format for the date labels
                }
            },

            yAxis: {
                title: {
                    text: 'Value'
                },
                labels: {
                    format: '{value}'
                }
            },

            tooltip: {
                headerFormat: 'Date: {point.x:%b %d}<br>',
                pointFormat: 'Value: {point.y}',
                shared: true
            },

            legend: {
                enabled: false
            },

            series: [{
                data: dayWiseData,
                lineColor: Highcharts.getOptions().colors[1],
                color: Highcharts.getOptions().colors[2],
                fillOpacity: 0.5,
                name: 'Daily Data',
                marker: {
                    enabled: false
                },
                threshold: null
            }]
        });





        Highcharts.chart('activeUser', {
    chart: {
        type: 'line', // Assuming you want a line chart for active users
        zooming: {
            type: 'xy'
        }
    },
    title: {
        text: 'Active Users Over Time',
        align: 'left'
    },
    credits: {
        text: 'Source: Your Data Source',
        href: 'https://yourdatasource.com',
        target: '_blank'
    },
    xAxis: [{
        categories: [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ],
        crosshair: true
    }],
    yAxis: {
        title: {
            text: 'Number of Active Users'
        },
        labels: {
            format: '{value}'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' users'
    },
    legend: {
        align: 'left',
        verticalAlign: 'top',
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || 'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Active Users',
        data: [
            10, 16, 4, 10, 22
        ],
        tooltip: {
            valueSuffix: ' users'
        }
    }]
});








});
</script>
<?php
include 'footer.php';
?>


