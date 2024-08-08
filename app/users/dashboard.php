
<?php
include 'header.php';

function getTotalCount($conn, $productionCode, $statusCondition = "") {
    $sql = "SELECT COUNT(*) as totalCount FROM songs WHERE content_createdBy = '$productionCode' $statusCondition";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $totalCount = $row['totalCount'];
        $result->free();
        return $totalCount;
    } else {
        echo "Error: " . $conn->error;
        return 0; // Return 0 or handle the error as needed
    }
}

$productionCode = mysqli_real_escape_string($conn, $productionCode);
$totalSong = getTotalCount($conn, $productionCode);
$statusConditionPending = "AND content_status = 'PENDING'";
$totalPendingSongs = getTotalCount($conn, $productionCode, $statusConditionPending);
$statusConditionPremium = "AND content_isPremium = 'Yes'";
$totalPremiumSongs = getTotalCount($conn, $productionCode, $statusConditionPremium);


?>








<main class="page-content">
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
    <div class="col">
                <div class="card radius-10 bg-success">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Total Revenue</p>
                        <h4 class="mb-0 text-white">₹0</h4>
                      </div>
                      <div class="ms-auto widget-icon bg-white-1 text-white">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                    </div>
                  </div>
                </div>
    </div>

    <div class="col">
                <div class="card radius-10 bg-pink">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Total Songs</p>
                        <h4 class="mb-0 text-white"><?php echo $totalSong; ?></h4>
                      </div>
                      <div class="ms-auto widget-icon bg-white-1 text-white">
                        <i class="bi bi-bar-chart-fill"></i>
                      </div>
                    </div>
                  </div>
                </div>
               </div>


               <div class="col">
                <div class="card radius-10 bg-danger">
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <div class="">
                        <p class="mb-1 text-white">Total Pending</p>
                        <h4 class="mb-0 text-white"><?php echo $totalPendingSongs; ?></h4>
                      </div>
                      <div class="ms-auto fs-2 text-white">
                        <i class="bi bi-cup"></i>
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
                      <div class="ms-auto widget-icon bg-white-1 text-white">
                        <i class="bi bi-bag-check-fill"></i>
                      </div>
                    </div>
                  </div>
                </div>
               </div>   
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



  


    
  </div>
  <!--end row-->
</main>

<?php
include 'footer.php';
?>
