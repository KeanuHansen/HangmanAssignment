<!-- Sign In -->
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <body>

        <?php 
            session_start();
            
            if($_GET){
                if($_GET['issue'] === 'true'){
                    echo "You didn't type either a username or a password, please try again. <br>";
                } 
                else{
                    echo "That is not a valid account, please try again. <br>";
                }
            }
        ?>
        <br>

        <form action="VerifySignIn.php" method="post">

            <p>Enter Username: <input type="text" name="username"/></p>
            <p>Enter Password: <input type="text" name="password"/></p>

            <input type="submit" value="Submit"/>

        </form>
    </body>
</html>