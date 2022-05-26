<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signupcss2.css" />
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
    <h1>Create an account</h1>
    <form action="signup.php" method="POST">
      <fieldset>
        <label>User Name<br><input type="text" placeholder=" User Name" name="username" /></label>
      </fieldset>
      <fieldset>
        <label>Email<br><input type="email" placeholder=" Email id" name="mail" /></label>
      </fieldset>
      <fieldset>
        <label>Password<br><input type="password" placeholder=" Password" name="pwd"/></label>
      </fieldset>
      <fieldset>
        <label>Confirm your password<br><input type="password" placeholder=" Re-enter" name="repwd" /></label>
      </fieldset>
      <fieldset>
          <button type="submit" name="register">Submit</button>
          <br>
          <p class="redirect">Registered User?  <a href="login.php">Login</a><p>
      </fieldset>
    </form>
    <?php 
      
      $db = mysqli_connect("localhost", "root", "", "taken");

      if(isset($_POST['register']))
      {
        $username = $_POST['username'];
        $email = $_POST['mail'];
        $password = $_POST['pwd'];
        $repwd = $_POST['repwd'];

        $sql_u = "SELECT * FROM users WHERE username='$username'";
        $sql_e = "SELECT * FROM users WHERE mail='$email'";
        $res_u = mysqli_query($db, $sql_u) or die(mysqli_error($db));
        $res_e = mysqli_query($db, $sql_e) or die(mysqli_error($db));

        if(mysqli_num_rows($res_u) > 0)
        {
          echo "<fieldset><h3>Username already taken!</h3></fieldset>";
        }
        else if(mysqli_num_rows($res_e) > 0)
        {
          echo "<fieldset><h3>Email id already registered!</h3></fieldset>";
        } 
        else if($password != $repwd)
        {
          echo "<fieldset><h3>Passwords don't Match!</h3></fieldset>";
        }
        else
        {
          $query = "INSERT INTO users (username, mail, pwd) VALUES('$username', '$email', '$password') ";
          $result = mysqli_query($db, $query) or die(mysqli_error($db));
          echo "<fieldset><h4>Saved!</h4></fieldset>";
          exit();
        }
      }

    ?>
  </body>
</html>