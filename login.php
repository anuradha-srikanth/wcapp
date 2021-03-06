<!-- login.php - This file contans the login feature of this website. Logging
                 into an account allows the user to access his/her profile, 
                 save outfits to their personal catalogue and edit preferences
                 so they can receive customized options of clothing. 

                 The login page consists of a paneled login screen. Returning users can choose to login o skip logging in to access the weather feature only. New users can choose to sign up for an account or skip signing up. 

                 Case 1: Returning users
                 The username and password are removed of any potentially dangerous symbols and are validated to see if they are in the database. If they are, a global sessons variable stores their infromation and they can access their account through the next pages/ 

                 Case 2: New users
                 Users can choose to sign up for an account. You may only sign up for an account not already in the system as the database cannot store duplicates. Login information is validated using regex for format and stored in the database. You may then login as a returning user.

                 Concepts:
                 1. Database Insert and Validation queries
                 2. Regex
                 3. $_SESSION variable setting and access
                 4. $_POST method of sending information without moving to another processing page
                 
 -->

<?php session_start(); 
session_unset();
    //Create the connection
    //Use the Pitt server or for your local stack use "localhost"
// $host = "sis-teach-01.sis.pitt.edu"; 
    $host = "localhost"; 
    //Your Pitt username for the Pitt server and "root" for localhost
$user = "asrikant";
    //Your password for the Pitt server and your password, if any, for localhost
$password = "!S1059CMU&*";
    //Name of your db - Pitt username for Pitt, and whatever you named it for local
$dbname = "asrikant";
$connection = mysqli_connect($host, $user, $password, $dbname);
if(mysqli_connect_errno()){
    die("Database connection failed: ".
        mysqli_connect_error() . 
        " (" . mysqli_connect_errno(). ")"
        );
    //This case is for returnig users trying to log in
}else if($_POST){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username = $_POST['username'];
        $pwd = $_POST['password'];
        if(empty($username)||empty($pwd)){
            echo "Please enter both username and password";
        }
        else{
            $query = "SELECT user_id FROM User WHERE username = '$username' AND password = '$pwd'";
            $userquery = mysqli_query($connection, $query);
            $returned_rows = mysqli_num_rows($userquery);
            //Validates if this use exists in the system and logs in
            if($returned_rows == 0){
                echo "This is not a valid username or incorrect password";
            } 
            else{
                $_SESSION['username'] = $username;
                $result = mysqli_fetch_assoc($userquery);
                $_SESSION['userID'] = $result['user_id'];
                $_SESSION['login'] = true;
                header('Location: search.php');
            }
        }
    }
    //This case is for if the user wants to register for a new account
    else if(!empty($_POST['newUsername']) && !empty($_POST['newPassword'])){
        //Validating that user has entered acceptable username
        $namePattern = "/[A-Za-z]+/";
        if(!preg_match($namePattern, $_POST['newUsername'])){
            echo "Please enter a valid name using letters A-Z" . "<br>";
        }else{
            $username = $_POST['newUsername'];
        }
        $pwd = $_POST['newPassword'];
        $email = $_POST['email'];
        if(empty($username)||empty($pwd)||empty($email)){
            echo "Please enter valid username, password and email";
        }
        //inserts new user into database
        else if(isset($_SESSION['userID'])){
            $addUser = 'INSERT INTO User (username , password) VALUES ( "';
            $addUser .= $_POST['newUsername'];
            $addUser .= '" , "';
            $addUser .= $_POST['newPassword'];
            $addUser .= '" )';
            echo $addUser;
            $result1 = mysqli_query($connection, $addUser);
            if(!$result1){
                die("Database query failed: Add User");
            }else{
                //preferences are preset for the new user
                //they may choose to cahnge these later in their profile
                $style1 = 'dress-pant';
                $color1 = 'blue';
                $pref = 'INSERT INTO Preferences (color , style , user_id) VALUES ("';
                $pref .= $color1 .'", "';
                $pref .= $style1 .'", ';
                $pref .= $_SESSION['userID'];
                $pref .= ')';

                echo $pref;
                $result2 = mysqli_query($connection, $pref);
                echo $result2;
                if(!$result2){
                    die("Database query failed: Add Preference");
                }else{
                    echo 'Successfully made an account! Please sign in.';
                }
            }
        }
    }else{
        echo 'Please enter username and password';
    }
}

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Syncopate" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div id="background-img">
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <form class="medium-4 medium-offset-4 columns" action="login.php" method="post">
        <div class="row">
            <div class="large-12 columns">

                <!-- foundation tabs -->
                <ul class="tabs" data-tabs id="loginTabs">
                  <li class="tabs-title is-active"><a href="#panelLogin" aria-selected="true">Login</a></li>
                  <li class="tabs-title"><a href="#panelRegister">Register</a></li>
              </ul>

              <div class="tabs-content" data-tabs-content="loginTabs">
                  <div class="tabs-panel is-active" id="panelLogin">
                     <div class="row">
                         <div class="large-12 columns hidden">
                            <label>Existing User
                                <input type="text" name="existingUser" placeholder="existingUser" value="existingUser">
                            </label>
                        </div>
                        <div class="large-12 columns">
                            <label>Username
                                <input type="text" name="username" placeholder="" value="<?php  if(isset($_POST['usename'])) {echo $_POST['username'];}?>" >
                            </label>
                        </div>
                        <div class="large-12 columns">
                            <label>Password
                                <input type="password" name="password" placeholder="">
                            </label>
                        </div>
                        <div class="large-6 columns text-right">
                            <div class="switch small">
                              <input class="switch-input" id="largeSwitch" type="checkbox" name="exampleSwitch">
                              <label class="switch-paddle" for="largeSwitch">
                                <span class="show-for-sr">Show Large Elephants</span>
                            </label>
                        </div>
                    </div>
                    <div class="large-6 columns">
                        Remember me
                    </div>
                    <div class="large-12 columns">
                        <input class='button expanded large' name='submit' value='login' type='submit'>
                    </div>
                    <div class="large-12 columns">
                        <a href="search.php" class='skip float-right'> Skip for now </a>
                    </div>
                </div>
            </div>
            <div class="tabs-panel" id="panelRegister">
                <div class="row">
                    <div class="large-12 columns hidden">
                        <label>New User
                            <input type="text" name="newUser" placeholder="newUser" value="newUser">
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <label>Username
                            <input type="text" name="newUsername" placeholder="">
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <label>Email
                            <input type="text" name="email" placeholder="">
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <label>Password (6 char minimum)
                            <input type="password" name="newPassword" placeholder="">
                        </label>
                    </div>
                    <div class="large-12 columns">
                        <label>Confirm Password
                            <input type="password" name="confirmPassword" placeholder="">
                        </label>
                    </div>

                    <div class="large-12 columns">
                        <!-- <label> Login -->
                        <input class='button expanded large' name='submit' value='login' type='submit'>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

    
</body>
</html>