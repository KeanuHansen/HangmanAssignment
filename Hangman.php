<!-- Hangman -->
<?php session_start(); ?>

<!DOCTYPE html>

<html>
    <body>
        <br>
        <?php 
            session_start();

            $lives = 0;
            $wd = "-";
            $right = "";
            $wrong = "";
            $name = "";
            $disabled = "";

            if($_GET){
                $lives = $_GET['life'];
                $wd = strval($_GET['word']);
                $right = ($_GET['correct']);
                $wrong = ($_GET['incorrect']);
                $name = $_GET['user'];
            }
            
            echo " Word is : " . $wd . "   <br>";
            echo " Tries :  " . $lives . "  <br>";
            echo " Name :  " . $name . "  <br>";

            $servername = "sql102.epizy.com";
            $usernames = "epiz_31690256";
            $passwords = "vHEIxJPd8gt";
            $dbname = "epiz_31690256_keanureeves";

            $connection = new mysqli($servername, $usernames, $passwords, $dbname);

            $wordQuery = "SELECT randomWord FROM randomWords ORDER BY RAND() LIMIT 1";

            $getWord = $connection->query($wordQuery);
            $words = "";

            if($getWord->num_rows > 0){
                while($row = $getWord->fetch_assoc()){
                    $words = $row["randomWord"];
                }
            }

            if((strlen($right) === strlen($wd)) and $lives <= 6){
                echo "YOU WIN! <br>";
                echo "<br><a href='Hangman.php?user=$name&life=0&word=$words'> Play Again!? </a><br>";
                $disabled = "style='display: none'";

                /// Check if they are in the database
                $scoreQuery = "SELECT name, score FROM highscores WHERE name LIKE '" . $name . "' AND wordLength = " . strlen($wd) . " ;";

                $checkResult = $connection->query($scoreQuery);
                $score = "";

                if($checkResult->num_rows > 0){
                    while($row = $checkResult->fetch_assoc()){
                        $score = $row["score"];
                        if($score != null and $score != ""){
                            if(intval($score) > $lives){
                                $updateScoreQuery = "UPDATE highscores SET score = $lives WHERE name LIKE '" . $name . "' AND wordLength = " . strlen($wd) . " ;";

                                $checkUpdateScore = $connection->query($updateScoreQuery);
                            }
                        }
                    }
                }
                else{
                    $insertScoreQuery = "INSERT INTO highscores (name, score, wordLength) VALUES ('$name', $lives, " . strlen($wd) . ");";

                    $checkInsertQuery = $connection->query($insertScoreQuery);
                }

                // Show the scoreboard
                $scoreboardQuery = "SELECT name, score FROM highscores WHERE wordLength = " . strlen($wd) . " ORDER BY score ASC LIMIT 10;";

                $boardResult = $connection->query($scoreboardQuery);

                $countScore = 1;

                if($boardResult->num_rows > 0){
                    echo "<br><br>";
                    echo "HIGH SCORES FOR " . strlen($wd) . " LETTER WORDS <br>";
                    echo "<br><br>";
                    while($row = $boardResult->fetch_assoc()){
                        $score = $row["score"];
                        $player = $row["name"];
                        if($score != null and $score != ""){
                            echo "$countScore: $player - $score <br>";
                            $countScore = $countScore + 1;
                        }
                    }
                }
            }
            else{
                /// 0
                if($lives === 0){
                    echo "---------------   <br>";
                    echo "|             |   <br>";
                    echo "|             |   <br>";
                    echo "|             |   <br>";
                    echo "|                 <br>";
                    echo "|                 <br>";
                    echo "|                 <br>";
                    echo "|                 <br>";
                    echo "|                 <br>";
                    echo "---------------   <br>";
                }

                /// 1
                if(intval(trim($lives)) === 1){
                    echo "<br>";
                    echo "O<br>";
                }

                /// 2
                if(intval(trim($lives)) === 2){
                    echo "<br>";
                    echo "O<br>";
                    echo "|<br>";
                }

                /// 3
                if(intval(trim($lives)) === 3){
                    echo "<br>";
                    echo "O<br>";
                    echo "/|<br>";
                }

                /// 4
                if(intval(trim($lives)) === 4){
                    echo "<br>";
                    echo "O<br>";
                    echo "/|\<br>";
                }

                /// 5
                if(intval(trim($lives)) === 5){
                    echo "<br>";
                    echo "O<br>";
                    echo "/|\<br>";
                    echo "/<br>";
                }

                /// 6
                if(intval(trim($lives)) === 6){
                    echo "<br>";
                    /// Dead
                    echo "O<br>";
                    echo "/|\<br>";
                    echo "/\<br>";
                }

                /// 7+
                if(intval(trim($lives)) > 6){
                    echo "<br>";
                    /// Dead
                    echo "Sorry, you lost!<br><br>";
                    echo "O<br>";
                    echo "/|\<br>";
                    echo "/\<br>";

                    echo "<br><a href='Hangman.php?user=$name&life=0&word=$words'> Play Again!? </a><br>";
                    $disabled = "style='display: none'";

                    /// Check if they are in the database
                    $scoreQuery = "SELECT name, score FROM highscores WHERE name LIKE '" . $name . "' AND wordLength = " . strlen($wd) . " ;";

                    $scoreResult = $connection->query($scoreQuery);
                    $score = "";

                    if($scoreResult->num_rows > 0){
                        while($row = $scoreResult->fetch_assoc()){
                            $score = $row["score"];
                            if($score != null and $score != ""){
                                if(intval($score) > $lives){
                                    $updateScoreQuery = "UPDATE highscores SET score = $lives WHERE name LIKE '" . $name . "' AND wordLength = " . strlen($wd) . " ;";

                                    $checkUpdateScore = $connection->query($updateScoreQuery);
                                }
                            }
                        }
                    }
                    else{
                        $insertScoreQuery = "INSERT INTO highscores (name, score, wordLength) VALUES ('$name', $lives, " . strlen($wd) . ");";

                        $checkInsertQuery = $connection->query($insertScoreQuery);
                    }

                    // Show the scoreboard
                    $scoreboardQuery = "SELECT name, score FROM highscores WHERE wordLength = " . strlen($wd) . " ORDER BY score ASC LIMIT 10;";

                    $boardResult = $connection->query($scoreboardQuery);

                    $countScore = 1;

                    if($boardResult->num_rows > 0){
                        echo "<br><br>";
                        echo "HIGH SCORES FOR " . strlen($wd) . " LETTER WORDS <br>";
                        echo "<br><br>";
                        while($row = $boardResult->fetch_assoc()){
                            $score = $row["score"];
                            $player = $row["name"];
                            if($score != null and $score != ""){
                                echo "$countScore: $player - $score <br>";
                                $countScore = $countScore + 1;
                            }
                        }
                    }

                }

                if($right != 'initializing'){
                    echo "<br>You have correctly guessed: " . $right . " ";
                }

                if($wrong != 'initializing'){
                    echo "<br>You have incorrectly guesssed: " . $wrong . " ";
                }
            }
        ?>

        <form action="VerifyHangman.php" method="POST" <?php echo "$disabled";?>>
            
            <p>Enter Letter Guess: <input type="text" name="letterGuess"/></p>
            <input type="hidden" name="life" value='<?php echo "$lives";?>' />
            <input type="hidden" name="correct" value='<?php echo "$right";?>' />
            <input type="hidden" name="incorrect" value='<?php echo "$wrong";?>' />
            <input type="hidden" name="word" value='<?php echo "$wd";?>' />
            <input type="hidden" name="user" value='<?php echo "$name";?>' />
            <input type="submit" value="Submit" />

        </form>

        <br>

        <form action="HangmanEnter.html" method="POST">
            <input type="submit" value="Log Out"/>
        </form>
    </body>
</html>