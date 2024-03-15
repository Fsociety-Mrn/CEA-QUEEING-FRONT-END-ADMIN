<?php
include '../connection/connect.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    

    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate and sanitize input (you should improve this)
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Query the database to check user credentials
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);

    // Check if the user exists
    if ($query->rowCount() > 0) {
        // Fetch user data
        $user = $query->fetch();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a new session
            $_SESSION['username'] = $username;
            header("Location: display.php"); // Redirect to dashboard or desired page
           
        } else {
            // Invalid password
            $error_message = "Invalid username or password";
        }
    } else {
        // Invalid username
        $error_message = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="admin/vendors/feather/feather.css">
  <link rel="stylesheet" href="admin/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="admin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h1>Admin</h1>
              </div>
             
              <h6 class="font-weight-light">Sign in to continue.</h6>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
               <div class="form-group">
                 <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username" required>
              </div>
                 <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" required>
               </div>
               <div class="mt-3">
              <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
              </div>
 
   
            </form>

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="admin/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="admin/js/off-canvas.js"></script>
  <script src="admin/js/hoverable-collapse.js"></script>
  <script src="admin/js/template.js"></script>
  <script src="admin/js/settings.js"></script>
  <script src="admin/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
