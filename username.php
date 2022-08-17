<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <body>
        <?php
            $usernames = $_POST["username"];
            $passwords = $_POST["password"];

            if(isset($_SESSION["usernames"])){
                if(isset($_SESSION["passwords"])){
                    echo "Hello " . $usernames . "!";
                    echo "Your password is ". $passwords . "!";
                }
            }

            echo "Hello " . $usernames . "! <br>";
            echo "Your password is " . $passwords . "!";
        ?>

        <br>

        Bye.
    </body>
</html>