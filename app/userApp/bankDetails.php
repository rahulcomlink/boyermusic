<?php
include '../db/connection.php';
include 'header.php';
//Upload Action

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bankSubmit'])) {
    // Assuming you have a function generateRandomString() defined somewhere
    $bank_account_name = $_POST['bank_account_name'];
    $bank_name = $_POST['bank_name'];
    $bank_ifsc_code = strtoupper($_POST['ifsc_code']); // Convert to uppercase
    $bank_account_no = $_POST['bank_account_number'];
    $re_bank_account_no = $_POST['re_bank_account_number'];
    $bank_account_type = $_POST['bank_account_type'];
    $bank_unicode = generateRandomString(10); // Assuming generateRandomString() is defined
    if ($bank_account_no == $re_bank_account_no) {
        $productionCode = $productionCode; // You need to define the production code here
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE `bank_details` SET `bank_name`=?, `bank_ifsc_code`=?, `bank_account_no`=?, `bank_account_name`=?, `bank_account_type`=?, `bank_unicode`=?, `createdAt`=NOW() WHERE `bank_user_code`=?");
        // Bind parameters
        $stmt->bind_param("sssssss", $bank_name, $bank_ifsc_code, $bank_account_no, $bank_account_name, $bank_account_type, $bank_unicode, $productionCode);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Bank Details Successfully Added.')</script>";
        } else {
            echo "<script>alert('Error updating bank details: " . $stmt->error . "')</script>";
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Account Number Not Matched.')</script>";
    }
}


?>
<!--start content-->
<main class="page-content">
  <!--breadcrumb-->
  <!--end breadcrumb-->
  <form class="row g-3" action="" method="post">
    <div class="row">
      <div class="col-xl-12 mx-auto">
        <div class="card">
          <div class="card-body">
          <h5 style="font-weight: 900;color:#03C988;text-align:center;">[ Bank Information ]</h5>

<?php
$sql = "SELECT * FROM bank_details WHERE bank_user_code = '$productionCode'";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $bankName = $row['bank_name'];
?>
<?php if (empty($bankName)) : ?>

            <div class="p-4 border rounded">
              <div class="row g-3 ">

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Account Name</label>
                  <input type="text" class="form-control" id="" name="bank_account_name" placeholder="Account Name" required>
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Bank Name</label>
                  <select class="single-select" name="bank_name">
                    <!-- Indian Banks -->
                    <optgroup label="Indian Banks">
                      <option value="Axis Bank Ltd.">Axis Bank Ltd.</option>
                      <option value="Bandhan Bank Ltd.">Bandhan Bank Ltd.</option>
                      <option value="CSB Bank Limited">CSB Bank Limited</option>
                      <option value="City Union Bank Ltd.">City Union Bank Ltd.</option>
                      <option value="DCB Bank Ltd.">DCB Bank Ltd.</option>
                      <option value="Dhanlaxmi Bank Ltd.">Dhanlaxmi Bank Ltd.</option>
                      <option value="Federal Bank Ltd.">Federal Bank Ltd.</option>
                      <option value="HDFC Bank Ltd">HDFC Bank Ltd</option>
                      <option value="ICICI Bank Ltd.">ICICI Bank Ltd.</option>
                      <option value="IndusInd Bank Ltd">IndusInd Bank Ltd</option>
                      <option value="IDFC FIRST Bank Limited">IDFC FIRST Bank Limited</option>
                      <option value="Jammu & Kashmir Bank Ltd.">Jammu & Kashmir Bank Ltd.</option>
                      <option value="Karnataka Bank Ltd.">Karnataka Bank Ltd.</option>
                      <option value="Karur Vysya Bank Ltd.">Karur Vysya Bank Ltd.</option>
                      <option value="Kotak Mahindra Bank Ltd">Kotak Mahindra Bank Ltd</option>
                      <option value="Nainital bank Ltd.">Nainital bank Ltd.</option>
                      <option value="RBL Bank Ltd.">RBL Bank Ltd.</option>
                      <option value="South Indian Bank Ltd.">South Indian Bank Ltd.</option>
                      <option value="Tamilnad Mercantile Bank Ltd.">Tamilnad Mercantile Bank Ltd.</option>
                      <option value="YES Bank Ltd.">YES Bank Ltd.</option>
                      <option value="IDBI Bank Limited">IDBI Bank Limited</option>
                    </optgroup>
                    <!-- Local Area Banks -->
                    <optgroup label="Local Area Banks">
                      <option value="Coastal Local Area Bank Ltd">Coastal Local Area Bank Ltd</option>
                      <option value="Krishna Bhima Samruddhi LAB Ltd">Krishna Bhima Samruddhi LAB Ltd</option>
                    </optgroup>
                    <!-- Small Finance Banks -->
                    <optgroup label="Small Finance Banks">
                      <option value="Au Small Finance Bank Ltd.">Au Small Finance Bank Ltd.</option>
                      <option value="Capital Small Finance Bank Ltd">Capital Small Finance Bank Ltd</option>
                      <option value="Fincare Small Finance Bank Ltd.">Fincare Small Finance Bank Ltd.</option>
                      <option value="Equitas Small Finance Bank Ltd">Equitas Small Finance Bank Ltd</option>
                      <option value="ESAF Small Finance Bank Ltd.">ESAF Small Finance Bank Ltd.</option>
                      <option value="Suryoday Small Finance Bank Ltd.">Suryoday Small Finance Bank Ltd.</option>
                      <option value="Ujjivan Small Finance Bank Ltd.">Ujjivan Small Finance Bank Ltd.</option>
                      <option value="Utkarsh Small Finance Bank Ltd.">Utkarsh Small Finance Bank Ltd.</option>
                      <option value="North East Small finance Bank Ltd">North East Small finance Bank Ltd</option>
                      <option value="Jana Small Finance Bank Ltd">Jana Small Finance Bank Ltd</option>
                      <option value="Shivalik Small Finance Bank Ltd">Shivalik Small Finance Bank Ltd</option>
                      <option value="Unity Small Finance Bank Ltd">Unity Small Finance Bank Ltd</option>
                    </optgroup>
                    <!-- Payments Banks -->
                    <optgroup label="Payments Banks">
                      <option value="Airtel Payments Bank Ltd">Airtel Payments Bank Ltd</option>
                      <option value="India Post Payments Bank Ltd">India Post Payments Bank Ltd</option>
                      <option value="FINO Payments Bank Ltd">FINO Payments Bank Ltd</option>
                      <option value="Paytm Payments Bank Ltd">Paytm Payments Bank Ltd</option>
                      <option value="Jio Payments Bank Ltd">Jio Payments Bank Ltd</option>
                      <option value="NSDL Payments Bank Limited">NSDL Payments Bank Limited</option>
                    </optgroup>
                    <!-- Public Sector Banks -->
                    <optgroup label="Public Sector Banks">
                      <option value="Bank of Baroda">Bank of Baroda</option>
                      <option value="Bank of India">Bank of India</option>
                      <option value="Bank of Maharashtra">Bank of Maharashtra</option>
                      <option value="Canara Bank">Canara Bank</option>
                      <option value="Central Bank of India">Central Bank of India</option>
                      <option value="Indian Bank">Indian Bank</option>
                      <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                      <option value="Punjab & Sind Bank">Punjab & Sind Bank</option>
                      <option value="Punjab National Bank">Punjab National Bank</option>
                      <option value="State Bank of India">State Bank of India</option>
                      <option value="UCO Bank">UCO Bank</option>
                      <option value="Union Bank of India">Union Bank of India</option>
                    </optgroup>
                    <!-- Development Banks -->
                    <optgroup label="Development Banks">
                      <option value="National Bank for Agriculture and Rural Development">National Bank for Agriculture and Rural Development</option>
                      <option value="Export-Import Bank of India">Export-Import Bank of India</option>
                      <option value="National Housing Bank">National Housing Bank</option>
                      <option value="Small Industries Development Bank of India">Small Industries Development Bank of India</option>
                    </optgroup>
                    <!-- Regional Rural Banks -->
                    <optgroup label="Regional Rural Banks">
                      <option value="Assam Gramin Vikash Bank">Assam Gramin Vikash Bank</option>
                      <option value="Andhra Pradesh Grameena Vikas Bank">Andhra Pradesh Grameena Vikas Bank</option>
                      <option value="Andhra Pragathi Grameena Bank">Andhra Pragathi Grameena Bank</option>
                      <option value="Arunachal Pradesh Rural Bank">Arunachal Pradesh Rural Bank</option>
                      <option value="Aryavart Bank">Aryavart Bank</option>
                      <option value="Bangiya Gramin Vikash Bank">Bangiya Gramin Vikash Bank</option>
                      <option value="Baroda Gujarat Gramin Bank">Baroda Gujarat Gramin Bank</option>
                      <option value="Baroda Rajasthan Kshetriya Gramin Bank">Baroda Rajasthan Kshetriya Gramin Bank</option>
                      <option value="Baroda UP Bank">Baroda UP Bank</option>
                      <option value="Chaitanya Godavari GB">Chaitanya Godavari GB</option>
                      <option value="Chhattisgarh Rajya Gramin Bank">Chhattisgarh Rajya Gramin Bank</option>
                      <option value="Dakshin Bihar Gramin Bank">Dakshin Bihar Gramin Bank</option>
                      <option value="Ellaquai Dehati Bank">Ellaquai Dehati Bank</option>
                      <option value="Himachal Pradesh Gramin Bank">Himachal Pradesh Gramin Bank</option>
                      <option value="J&K Grameen Bank">J&K Grameen Bank</option>
                      <option value="Jharkhand Rajya Gramin Bank">Jharkhand Rajya Gramin Bank</option>
                      <option value="Karnataka Gramin Bank">Karnataka Gramin Bank</option>
                      <option value="Karnataka Vikas Gramin Bank">Karnataka Vikas Gramin Bank</option>
                      <option value="Kerala Gramin Bank">Kerala Gramin Bank</option>
                      <option value="Madhya Pradesh Gramin Bank">Madhya Pradesh Gramin Bank</option>
                      <option value="Madhyanchal Gramin Bank">Madhyanchal Gramin Bank</option>
                      <option value="Maharashtra Gramin Bank">Maharashtra Gramin Bank</option>
                      <option value="Manipur Rural Bank">Manipur Rural Bank</option>
                      <option value="Meghalaya Rural Bank">Meghalaya Rural Bank</option>
                      <option value="Mizoram Rural Bank">Mizoram Rural Bank</option>
                      <option value="Nagaland Rural Bank">Nagaland Rural Bank</option>
                      <option value="Odisha Gramya Bank">Odisha Gramya Bank</option>
                      <option value="Paschim Banga Gramin Bank">Paschim Banga Gramin Bank</option>
                      <option value="Prathama U.P. Gramin Bank">Prathama U.P. Gramin Bank</option>
                      <option value="Puduvai Bharathiar Grama Bank">Puduvai Bharathiar Grama Bank</option>
                      <option value="Punjab Gramin Bank">Punjab Gramin Bank</option>
                      <option value="Rajasthan Marudhara Gramin Bank">Rajasthan Marudhara Gramin Bank</option>
                      <option value="Saptagiri Grameena Bank">Saptagiri Grameena Bank</option>
                      <option value="Sarva Haryana Gramin Bank">Sarva Haryana Gramin Bank</option>
                      <option value="Saurashtra Gramin Bank">Saurashtra Gramin Bank</option>
                      <option value="Tamil Nadu Grama Bank">Tamil Nadu Grama Bank</option>
                      <option value="Telangana Grameena Bank">Telangana Grameena Bank</option>
                      <option value="Tripura Gramin Bank">Tripura Gramin Bank</option>
                      <option value="Uttar Bihar Gramin Bank">Uttar Bihar Gramin Bank</option>
                    </optgroup>
                    <!-- Foreign Banks -->
                    <optgroup label="Foreign Banks">
                      <option value="AB Bank Ltd.">AB Bank Ltd.</option>
                      <option value="American Express Banking Corporation">American Express Banking Corporation</option>
                      <option value="Australia and New Zealand Banking Group Ltd.">Australia and New Zealand Banking Group Ltd.</option>
                      <!-- Add more foreign banks as needed -->
                    </optgroup>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="" class="form-label bank-title">IFSC Code</label>
                  <input type="text" class="form-control" oninput="formatIFSCCode(this)" maxlength="11" name="ifsc_code" placeholder="IFSC Code" required>
                </div>
                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Account Type</label>
                    <select class="single-select" name="bank_account_type">
                        <option value="Saving">Saving</option>
                        <option value="Current">Current</option>
                    </select>
                </div>
                <!-- <div class="col-md-4">
                  <label for="" class="form-label bank-title">Pan Card Number</label>
                  <input type="text" class="form-control" id="bank_account_pan" name="bank_account_pan" placeholder="Pan Card Number" required>
                </div> -->

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Bank Account Number</label>
                  <input type="number" class="form-control" id="bankAccountNumber" name="bank_account_number" placeholder="Bank Account Number" required>
                </div>
                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Reenter Bank Account Number</label>
                  <input type="password" class="form-control" id="reBankAccountNumber" name="re_bank_account_number" placeholder="Bank Account Number" required>
                  <span id="error-message" class="error-message"></span>
                </div>

                <div class="col" style="text-align:right">
                  <button type="submit" id="signupSubmit" name="bankSubmit" class="btn btn-warning px-5 bank-title">Submit Now</button>
                </div>
              </div>
            </div>
<?php else : ?>
    <h1>Bank Update</h1>
<div class="p-4 border rounded">
              <div class="row g-3 ">

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Account Name</label>
                  <input type="text" class="form-control bank-disable" id="" value="<?php echo $row['bank_account_name']; ?>" readonly>
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Bank Name</label>
                  <input type="text" class="form-control bank-disable" id="" value="<?php echo $row['bank_name']; ?>" readonly>
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">IFSC Code</label>
                  <input type="text" class="form-control bank-disable" id="" value="<?php echo $row['bank_ifsc_code']; ?>" readonly>
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Account Number</label>
                  <input type="text" class="form-control bank-disable" id="" value="<?php echo $row['bank_account_no']; ?>" readonly>
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label bank-title">Bank Account Type</label>
                  <input type="text" class="form-control bank-disable" id="" value="<?php echo $row['bank_account_type']; ?>" readonly>
                </div>



                <div class="col-md-4" style="text-align:right">
                <label for="" class="form-label bank-title" style="color:white;">Bank Account Type</label>
                  <button type="submit" id="signupSubmit" name="bankSubmit" class="disabled btn btn-warning px-5 bank-title">Change Request</button>
                </div>
              </div>
            </div>

<?php endif; ?>

<?php } ?>

          



          
          
          
          
          
            
          </div>
        </div>
      </div>
    </div>
  </form>
</main> 
<script>
  // Add event listener to both input fields
  document.getElementById('bankAccountNumber').addEventListener('input', validateAccountNumbers);
  document.getElementById('reBankAccountNumber').addEventListener('input', validateAccountNumbers);

  function validateAccountNumbers() {
    // Get the values from both input fields
    const bankAccountNumber = document.getElementById('bankAccountNumber').value;
    const reBankAccountNumber = document.getElementById('reBankAccountNumber').value;

    // Get the error message element
    const errorMessage = document.getElementById('error-message');

    // Get the submit button element
    const submitButton = document.getElementById('signupSubmit');

    // Check if the values match
    if (bankAccountNumber === reBankAccountNumber) {
      // Clear any previous error message
      errorMessage.textContent = '';
      // Enable the submit button
      submitButton.disabled = false;
    } else {
      // Display error message
      errorMessage.textContent = 'Account numbers do not match.';
      // Disable the submit button
      submitButton.disabled = true;
    }
  }

  function formatIFSCCode(inputField) {
    // Get the input value and convert it to uppercase
    let inputValue = inputField.value.toUpperCase();
    // Limit the input to 11 characters
    if (inputValue.length > 11) {
      inputValue = inputValue.slice(0, 11);
    }
    // Update the input value
    inputField.value = inputValue;
  }
</script>
<?php
include 'footer.php';
?>