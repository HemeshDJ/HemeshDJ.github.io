<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="logincss2.css" />
  </head>
  <body>
      <nav class="pages">
        <ul>
          <li><a href="home.php">HOME PAGE</a></li>
          <li><a href="home.php">ABOUT</a></li>
          <li><a href="signup.php">SIGN UP</a></li>
          <li><a href="login.php">LOGIN</a></li>
        </ul>
      </nav>
    <h1>Login</h1>
    <form action="login.php" method="POST">
      <fieldset>
        <label>Email / User Name<br><input type="text" placeholder=" Email id / username" name="email" /></label>
      </fieldset>
      <fieldset>
        <label>Password<br><input type="password" placeholder=" Password" name="pwd"/></label>
      </fieldset>
      <fieldset>
          <button class="submit" name="checkuser">Submit</button>
          <br>
          <p>New User?  <a href="signup.php" class="options">Sign up</a><a href="home.php">Forgot Password?</a><p>
      </fieldset>
    </form>
    <?php 
      
      $db = mysqli_connect("localhost", "root", "", "taken");

      if(isset($_POST['checkuser']))
      {
        $username = $_POST['email'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];

        $sql_u = "SELECT * FROM users WHERE username='$username'";
        $sql_e = "SELECT * FROM users WHERE mail='$email'";
        $sql_q1 = "SELECT * FROM users WHERE username='$username' AND pwd='$password'";
        $sql_q2 = "SELECT * FROM users WHERE mail='$email' AND pwd='$password'";

        $res_u = mysqli_query($db, $sql_u) or die(mysqli_error($db));
        $res_e = mysqli_query($db, $sql_e) or die(mysqli_error($db));
        $res_q1 = mysqli_query($db, $sql_q1) or die(mysqli_error($db));
        $res_q2 = mysqli_query($db, $sql_q2) or die(mysqli_error($db));

        if(mysqli_num_rows($res_u) == 0 and mysqli_num_rows($res_e) == 0)
        {
          echo "<fieldset><h3>Entered email id/username is not registered!</h3></fieldset>";
        }
        else if((mysqli_num_rows($res_u) > 0 and (mysqli_num_rows($res_q1) == 0)))
        {
          echo "<fieldset><h3>The password is incorrect!</h3></fieldset>";
        } 
        else if((mysqli_num_rows($res_e) > 0 and (mysqli_num_rows($res_q2) == 0)))
        {
          echo "<fieldset><h3>The password is incorrect!</h3></fieldset>";
        }
        else if(mysqli_num_rows($res_q1) == 1)
        {
          while($row = mysqli_fetch_assoc($res_q1))
          {
            $usr = $row['username'];
            $return = "Welcome back, ".$usr;
            echo "<fieldset><h4>$return!</h4></fieldset>";
          }
        }
        else if(mysqli_num_rows($res_q2) == 1)
        {
          while($row = mysqli_fetch_assoc($res_q2))
          {
            $usr = $row['username'];
            $return = "Welcome back, ".$usr;
            echo "<fieldset><h4>$return!</h4></fieldset>";
            exit();
          }
        }
      }

    ?>
  </body>
</html>