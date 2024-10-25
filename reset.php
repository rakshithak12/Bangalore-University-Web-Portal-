<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reset.css">
    <title>Reset Password - Bnagalore University</title>
</head>
<body>
    <div class="wrap"></div>
    <div class="wrapper" id="sec">
		<form action="login-register/forgot.php" method="POST">
			<h1>Reset Password</h1>
			<div class="input-box">
				<input type="email" name="email" placeholder="Email" required>
			</div>
			<div class="input-box">
				<input type="password" name="password" placeholder="Password" required>
			</div>
			<p><a href="login.php" id="signIn">Sign in</a></p>
			<button type="submit" class="btn">Update</button>
		</form>
  	</div>
</body>
</html>