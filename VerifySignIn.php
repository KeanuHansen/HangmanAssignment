<?php session_start(); ?>

<?php 
            session_start();
           
            $servername = "sql102.epizy.com";
            $usernames = "epiz_31690256";
            $passwords = "vHEIxJPd8gt";
            $dbname = "epiz_31690256_keanureeves";

            $connection = new mysqli($servername, $usernames, $passwords, $dbname);
            
            $name = $_POST["username"];
            $pass = $_POST["password"]; 

            if($name === ""){
                header("Location: SignIn.php?issue='true'");
            }

            if($pass === ""){
                header("Location: SignIn.php?issue='true'");
            }

                if($name != ""){
                    if($name != null){
                        $checkQuery = "SELECT salt FROM accounts WHERE username LIKE '" . $name . "';";

                        $checkResult = $connection->query($checkQuery);
                        $salt = "";

                        if($checkResult->num_rows > 0){
                            while($row = $checkResult->fetch_assoc()){
                                $salt = $row["salt"];
                            }
                        }

                        $wordQuery = "SELECT randomWord FROM randomWords ORDER BY RAND() LIMIT 1";

                        $getWord = $connection->query($wordQuery);
                        $words = "";

                        if($getWord->num_rows > 0){
                            while($row = $getWord->fetch_assoc()){
                                $words = $row["randomWord"];
                            }
                        }

                        $hashingPassword = $salt . $pass;
                        $hashedPassword = hash('sha256', $hashingPassword);

                        $signQuery = "SELECT username FROM accounts WHERE username LIKE '" . $name . "' AND password LIKE '" . $hashedPassword . "';";
                        $checkSign = $connection->query($signQuery);

                        if($checkSign->num_rows > 0){
                            while($row = $checkSign->fetch_assoc()){
                                $name = $row["username"];
                                header("Location: Hangman.php?user=$name&life=0&word=$words");
                            }
                        }
                        else{
                            header("Location: SignIn.php?issue='wrongaccount'");
                        }

                    }
                }
        
            $connection->close(); 
        ?>