<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="images/website icon.png">
    <title>Login Account</title>
    
</head>
<body>
<?php
session_start();
include("database/connection.php");

if($_POST)
{
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['useremail']);
    $password = validate($_POST['userpassword']);

   $sql = "SELECT * FROM website_user WHERE Email ='$email'";
   $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) === 1)
    {
        $row = mysqli_fetch_assoc($result);
        $utype=$row['usertype'];

        if($utype=='a')
        {
            $sql = "SELECT * FROM admin WHERE admin_email='$email' AND admin_password='$password'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) === 1)
            {
                //   For Admin dashbord
                $_SESSION['user']= $row['$email'];
                $_SESSION['usertype']= $row['a'];
                header('Location: admin_side/admin_dashboard.php');

            }
            else
            {
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }
        elseif($utype=='d')
        {
            $sql = "SELECT * FROM doctor WHERE doctor_email='$email' AND doctor_password='$password'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) === 1)
            {
                //  For Doctor dashbord
                $_SESSION['user']= $row['$email'];
                $_SESSION['usertype']= $row['d'];
                header("Location: doctor_side/doctor_dashboard.php");
            }
            else
            {
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }

        }
        elseif ($utype === 'p') {
            $sql = "";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result) === 1)
            {
                //  For Doctor dashbord
                $_SESSION['user']= $row['$email'];
                $_SESSION['usertype']= $row['p'];
                header("Location: patient_side/home_page.php");
            }
            else
            {
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        }
        
    }
    else
    {
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }

}
else
{
    $error='<label for="promter" class="form-label">&nbsp;</label>';
}
?>

    <center>
    <div class="login_container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome Back!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login with your account to continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn"> <br>
                    <input type="submit" value="Cancel" onclick = "location.href = 'index_main.html';" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="signup.php" class="link-item">Sign Up</a>
                    <br><br><br>
                </td>
            </tr>       
                    </form>
        </table>

    </div>
</center>
</body>
</html>