<?php 
        $db = mysql_connect('surfuttfrlantoin.mysql.db', 'surfuttfrlantoin', 'Canoni965') or die('Could not connect: ' . mysql_error()); 
        mysql_select_db('surfuttfrlantoin') or die('Could not select database');
 
        // Strings must be escaped to prevent SQL injection attack. 
        $name = mysql_real_escape_string($_GET['name'], $db); 
        $score = intval($_GET['score'], $db); 
        $hash = $_GET['hash']; 
         
         
        $secretKey = "kjzbfj976LJBLZusb!8ljb"; // It is the same Unity3D posts
        $real_hash = md5($name . $score . $secretKey);
  
        // ------------------------------------------------
        // if MD5 Key is right ----------------------------
        //-------------------------------------------------
    if ($real_hash == $hash) {
        echo "Yes! It is the right MD5, let's write on the database";
         
        // Check if the name already exists 
        $checkname = mysql_query("SELECT 1 FROM scores WHERE name='$name' LIMIT 1");
         
        // ------------------------------------------------
        // if exists --------------------------------------
        //-------------------------------------------------
        if (mysql_fetch_row($checkname)) {  
        echo "<br>Old Player";// Debug Code
        echo "<br>";// Debug Code
        echo "Punteggio arrivato dal gioco: ".$score;// Debug Code
        echo "<br>";// Debug Code
        $checkscore = mysql_query("SELECT score FROM scores WHERE name='$name'");
        $checkscorerow = mysql_fetch_array($checkscore);
        echo "Punteggio ottenuto dal database: ".$checkscorerow['score'];// Debug Code
         
                // if the new score are better than old one
                if ($score > $checkscorerow['score']){
                    echo "<br>Great! New personal record";
                     
                    // Update the existing name with new score
                    // AGGIORNA db_name SETTA il valore di score dove name è uguale a quello ottenuto con GET
                    $queryupdate = "UPDATE scores SET score=$score WHERE name='$name'";     
                    $resultupdate = mysql_query($queryupdate) or die('Query failed: ' . mysql_error());
                     
                    mysqli_close($db); // Close the connection with the database
                    echo "<br>Connection Closed!"; 
                    break; // stop the execution of the script
                } else {
                    echo "<br>Bad! Are you tired?";
                    mysqli_close($db); // Close the connection with the database
                    echo "<br>Connection Closed!"; 
                    break; // stop the execution of the script
                }   
          
        // ------------------------------------------------
        // if not exists ----------------------------------
        // ------------------------------------------------
        } else {
                echo "Nuovo giocatore";// Debug Code
                // Insert a new name and a new score 
                $query = "INSERT INTO scores VALUES (NULL, '$name', '$score');"; 
                $result = mysql_query($query) or die('Query failed: ' . mysql_error()); 
        }       
         
        mysqli_close($db); // Close the connection with the database
        echo "<br>Connection Closed!"; 
         
    } else {
        // Debug Code
        echo "Bad MD5! Who are you?";
        echo "<br>Data received: ".$name." ".$score." ".$hash;
        echo "<br>MD5 calcolato dal server: ".md5($real_hash);
        break;
    }
?>