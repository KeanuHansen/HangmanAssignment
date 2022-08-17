<!-- Sign Up -->
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <body>
        <br>
        <?php 
            session_start();
            
            if($_GET){
                $holder = $_GET['issue'];
                if(strlen($holder) > 3){
                    echo "The user already exists. <br>";
                } 
                else{
                    echo "The passwords do not match.<br>";
                }
            }
        ?>

        <form action="VerifySignUp.php" method="POST">

            <p>Enter Username: <input type="text" name="username"/></p>
            <p>Enter Password: <input type="text" name="password"/></p>
            <p>Confirm Password: <input type="text" name="confirmedpassword"/></p>

            <input type="submit" value="Submit"/>

        </form>
    </body>
</html>