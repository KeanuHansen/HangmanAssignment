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
            $confirm = $_POST["confirmedpassword"]; 

            if($confirm === $pass){
                if($pass === $confirm){
                    if($name != ""){
                        if($name != null){
                            $checkQuery = "SELECT username FROM accounts WHERE username LIKE '" . $name . "';";
    
                            $checkResult = $connection->query($checkQuery);
    
                            if($checkResult->num_rows === 0){
    
                                $randomDancing = md5(uniqid(rand(), TRUE));
                                $salty =  substr($randomDancing, 0, 3);
                                $hashedPassword = hash('sha256', $salty . $pass);
                                $insertQuery = "INSERT INTO accounts (username, password, salt) VALUES ('" . $name . "', '" . $hashedPassword . "', '" . $salty . "');";
    
                                $insertResult = $connection->query($insertQuery);

                                $wordQuery = "SELECT randomWord FROM randomWords ORDER BY RAND() LIMIT 1";

                                $getWord = $connection->query($wordQuery);
                                $words = "";

                                if($getWord->num_rows > 0){
                                    while($row = $getWord->fetch_assoc()){
                                        $words = $row["randomWord"];
                                    }
                                }

                                header("Location: Hangman.php?user=$name&life=0&word=$words");
                            }
                            else{
                                header("Location: SignUp.php?issue='NO'");
                            }
                        }
                    }
                }
            }
            else{
                header("Location: SignUp.php?issue='Y'");
            }

            
        
            $connection->close(); 
        ?>