<?php 
session_start();
include("db_connect.php");


$error="";
$msg="";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    

    function sendemail($email,$reset_token)
    {
        $mail = new PHPMailer(true);

try {
    //Server settings
                        
    $mail->isSMTP();                                         //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'zeninmacky05@gmail.com';                     //SMTP username
    $mail->Password   = 'frut mage zsxu mzsd';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mccschedsystem@gmail.com', 'MCC SCHED SYSTEM ADMIN');
    $mail->addAddress($email);     //Add a recipient
$resetLink = 'http://localhost/SCHED4/Admin/reset_password.php?email=$email&token=' . $reset_token;
  

        
   

   
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is your link to Reset the password of your MCC SCHED-SYSTEM Account';
    $mail->Body    ="
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 80%;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            .header {
                text-align: center;
                padding-bottom: 20px;
                border-bottom: 1px solid #ddd;
            }
            .logo {
                max-width: 150px;
                height: auto;
            }
            .content {
                padding: 20px 0;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
            }
        </style>
</head>
<body>
    <h1>Reset Password</h1>
        
<div class='container'>
<div class='header'>
<img src='assets/uploads/back.png' alt='Logo'>
</div>
</div>
<div class='content'>
<p>Hello,</p>
<p>We received a request to reset your password. Click the button below to reset it:</p>
<p><a href='http://localhost/SCHED4/admin/reset_password.php?email=$email&token=$reset_token' class='button'>Reset Password</a>
<p>If you did not request a password reset, please ignore this email.</p>
 
</div>
</body>
 </html>
     ";


    $mail->send();
    return true;
} catch (Exception $e) {
   return false;
}
}

// if (isset($_SESSION['login'])) 
// {
//  header("location: index.php");
// }

// else
// {
    if (isset($_POST['reset'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']); // Added mysqli_real_escape_string for security
        $check = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check);
    
        if ($result && mysqli_num_rows($result) == 1) {
            $reset_token = bin2hex(random_bytes(10));
            $update = "UPDATE users SET reset_token = '$reset_token' WHERE email = '$email'";
    
            if (mysqli_query($conn, $update) && sendemail($email, $reset_token)) {
                echo '<script>
                        window.onload = function() {
                            Swal.fire({
                                title: "Success!",
                                text: "Reset password link sent to your email",
                                icon: "success"
                            });
                        };
                      </script>';
            } else {
                echo '<script>
                        window.onload = function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to send reset password link. Please try again later.",
                                icon: "error"
                            });
                        };
                      </script>';
            }
        } else {
            echo '<script>
                    window.onload = function() {
                        Swal.fire({
                            title: "Error!",
                            text: "No account associated with this email. Please check your email.",
                            icon: "error"
                        });
                    };
                  </script>';
        }
    } else {
        echo '<script>
                window.onload = function() {
                    Swal.fire({
                        title: "Error!",
                        text: "Invalid request. Please try again.",
                        icon: "error"
                    });
                };
              </script>';
    }
    

?>

    <style>
     
      #logo-img{
          width:5em;
          height:5em;
          object-fit:scale-down;
          object-position:center center;
      }
    
  </style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Admin | Forgot Password</title>
  <link rel="icon" href="assets/uploads/back.png" type="image/png">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
  <style>
    body {
      background: lightgray;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      width: 400px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .login-logo img {
      width: 80px;
      margin-bottom: 20px;
    }

    .card {
      border-radius: 20px;
      padding: 40px 30px;
      text-align: center;
    }

    .btn-primary {
      background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
      border: none;
      padding: 10px 20px;
      border-radius: 50px;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    }

    .input-group {
      margin-bottom: 20px;
    }

    .form-control {
      width: 90%;
      height: 40px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    p.login-box-msg {
      margin-bottom: 40px;
      font-size: 16px;
    }


    #logo-img {
      width: 100px;
      height: 100px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <center><img src="assets/uploads/back.png" alt="System Logo" class="img-thumbnail rounded-circle" id="logo-img"></center>
        <h1><b>Retrieve</b> Account</h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <form action="" method="post">
          <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="reset" value="Reset" class="btn btn-primary btn-block">Request new password</button>
            </div>
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="index.php">Login</a>
        </p>
      </div>
    </div>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
