<!-- Hangman Verification -->
<?php session_start(); ?>

<?php 
            session_start();
           
            $servername = "sql102.epizy.com";
            $usernames = "epiz_31690256";
            $passwords = "vHEIxJPd8gt";
            $dbname = "epiz_31690256_keanureeves";

            $connection = new mysqli($servername, $usernames, $passwords, $dbname);
            
            /// Get your username from somewhere

            /// Obtain Word From Database
            
            $name = $_POST["user"];
            $words = $_POST["word"];
            $guess = $_POST["letterGuess"];
            $lives = $_POST["life"]; 
            $right = $_POST["correct"]; 
            $wrong = $_POST["incorrect"]; 

            echo "GOT<br>";
            echo ". " . $guess . " .";

            $arr = str_split(trim($guess));

            /// This means it is in the 
            $parts = str_split($words);
            
            $here = "1";
            $nothere = "";
            foreach ($parts as $letter) {
                foreach ($arr as $arrs){
                    if(strtolower($letter) === strtolower($arrs)){
                        $nothere = "21";
                    }
                }
            }

            if(strlen($nothere) >= strlen($here)){
                // echo "GOT HERE $nothere $here <br>";

                /// Add to successful letter list
                if($right == "temp"){
                    $right = strtolower($guess);
                }
                else{
                    if(strlen($guess) < 2){
                        $stringarrays = str_split($right);
                        $addToRight = true;
                        
                        foreach($stringarrays as $items){
                            if($items != "" and $items != null){
                                if($items == $guess){
                                    $addToRight = false;
                                }
                            }
                        }
    
                        if($addToRight === true){
                            /// Alter lives
                            $right = strtolower($right) . strtolower($guess);
                        }
                    }
                }

                /// Return to the page with your lives intact
                header("Location: Hangman.php?user=$name&life=$lives&word=$words&correct=$right&incorrect=$wrong");
            }

            /// This means it is not in the word
            else{
                // echo "GOT HERE $nothere $here 22<br>";

                /// Add to failed letter list
                if($wrong == "temp"){
                    $wrong = strtolower($guess);
                    $lives = intval($lives) + 1;
                }
                else{
                    $stringarray = str_split($wrong);
                    $addToWrong = true;
                    
                    foreach($stringarray as $item){
                        if($item != "" and $item != null){
                            if($item == $guess){
                                $addToWrong = false;
                            }
                        }
                    }

                    if($addToWrong === true){
                        /// Alter lives
                        $lives = intval($lives) + 1;

                        $wrong = strtolower($wrong) . strtolower($guess);
                    }
                }

                /// Return to the page with your altered lives
                header("Location: Hangman.php?user=$name&life=$lives&word=$words&correct=$right&incorrect=$wrong");
            }

            $connection->close(); 
?>