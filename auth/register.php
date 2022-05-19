<?php
session_start();
$message = "";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("Location: /Recipie/");
}
$current_path = "/Recipie/auth/register.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db/dbconnect.php';

    $full_name =  $_POST['signupName'];
    $username =  $_POST['signupUsername'];
    $birthday =  $_POST['signupBirthday'];
    $mobile =  $_POST['signupMobile'];
    $address =  $_POST['signupAddress'];
    $pass1 =  $_POST['signupPassword1'];
    $pass2 =  $_POST['signupPassword2'];

    $image =  $_FILES['image']['name'];
    $tmp_name =  $_FILES['image']['tmp_name'];
    $size =  $_FILES['image']['size'];
    $ext = pathinfo($image, PATHINFO_EXTENSION);


    $existsql = "SELECT * FROM `users` WHERE `username` = '$username'";

    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);


    if ($numRows > 0) {
        $showError = "User already in use";
        header("Location: $current_path?error=$showError");
    } else {
        if ($pass1 == $pass2) {
            $hashpass = password_hash($pass1, PASSWORD_DEFAULT);
            if ($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg') {
                if ($size <= 2097152) {
                    $sql = "INSERT INTO `users` (`full_name`, `user_pass`,`username`,`birthday`,`mobile`,`address`,`image`) VALUES ('$full_name', '$hashpass','$username','$birthday','$mobile','$address','$image')";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $path = "../assets/Image/profile/" . $username;
                        if (!is_dir($path)) {
                            mkdir($path);
                        }
                        move_uploaded_file($tmp_name, $path . "/" . $image);

                        $success = "<strong>Success! </strong>You can now login!";
                        header("Location: /Recipie/auth/signin.php?success=$success");
                    }
                } else {
                    $message = "Image should be or Less or Equal 2 MB!";
                }
            } else {
                $message = "Your file is invalid! Please upload PBG or JPG file";
            }
        } else {
            $message = "Passwords do not match";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Registration</title>
	</head>
	<body>
		<style>
			<?php include '../assets/css/style.css' ?>
		</style>
		<section class="login__section registration__section">
			<div class="container">
				<?php if($message){
					echo''.$message.'';
				} ?>
				<h3>
					Create a Account!
				</h3>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form__content">
						<label for="">Full Name:</label>
						<input
							type="text"
							minlength="5"
							class="form-control my-1"
							id="signupName"
							name="signupName"
							req
							placeholder="Full Name"required
						/>
					</div>

					<div class="form__content">
						<label for="">Email:</label>
						<input
							type="text"
							minlength="5"
							id="signupUsername"
							name="signupUsername"
							aria-describedby="emailHelp"
							placeholder="Email"
							required
						/>
					</div>

					<div class="form__content">
						<label for="">Mobile:</label>
						<input
							type="number"
							minlength="11"
							id="signupUsername"
							name="signupUsername"
							aria-describedby="emailHelp"
							placeholder="Mobile Number"
							required
						/>
					</div>

					<div class="form__content">
						<label for="">Password:</label>
						<input
							type="password"
							minlength="10"
							class="form-control my-1"
							id="password1"
							name="signupPassword1"
					
					placeholder="Give your password.."		required
						/>
					</div>

					<div class="form__content">
						<label for="">Confirm Password:</label>
						<input
							type="password"
							minlength="10"
							class="form-control my-1"
							id="password2"
							name="signupPassword2"
					
					placeholder="Confirm your Password Please!"		required
						/>
					</div>

					<div class="form__content">
						<label for="signupAddress">Address:</label>
						<textarea
							class="form-control"
							id="signupAddress"
							name="signupAddress"
							rows="2"
							placeholder="Address.."
							required
						></textarea>
					</div>

					<div class="form__content">
						<label for="image">Select image</label>
						<input
							type="file"
							class="form-control-file my-2"
							id="image"
							name="image"
							required
						/>
					</div>

					<div class="term__service">
						<input type="checkbox" name="" id="exampleCheck1" required />
						<label for="exampleCheck1"
							>I agree to <b>CourierBD's</b> Terms of Service and Privacy
							Policy</label
						>
					</div>

					<button class="btn login__button">Registration</button>
				</form>

				<div class="already__account">
					<small
						>Already have an account?
						<a class="" href="/Recipie/auth/signin.php">login</a></small
					>
				</div>
			</div>
		</section>
	</body>
</html>
