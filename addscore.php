<?php 
        $db = mysql_connect('surfuttfrlantoin.mysql.db', 'surfuttfrlantoin', 'Canoni965') or die('Could not connect: ' . mysql_error()); 
        mysql_select_db('surfuttfrlantoin') or die('Could not select database');
 
        // Strings must be escaped to prevent SQL injection attack. 
        $name = mysql_real_escape_string($_GET['name'], $db); 
        $score = mysql_real_escape_string($_GET['score'], $db); 
        $hash = $_GET['hash']; 
 
        $secretKey="kjzbfj976LJBLZusb!8ljb"; # Change this value to match the value stored in the client javascript below 


        $real_hash = md5($name . $score . $secretKey); 
        if($real_hash == $hash) { 
            // Send variables for the MySQL database class. $checkname = mysql_query("SELECT 1 FROM scores WHERE name='$name' LIMIT 1");
        // if exists
        if (mysql_fetch_row($checkname)) {
                // Update the existing name with new score
            // AGGIORNA db_name SETTA il valore di score dove name è uguale a quello ottenuto con GET
            
            $checkscore = mysql_query("SELECT score FROM scores WHERE name='$name'");
        $checkscorerow = mysql_fetch_array($checkscore);
            
            if ($score > $checkscorerow['score']){
            $queryupdate = "UPDATE scores SET score=$score WHERE name='$name'";     
            $resultupdate = mysql_query($queryupdate) or die('Query failed: ' . mysql_error());    
                mysqli_close($db);
                break;
        // if not exists
        } else {
                mysqli_close($db);
                break;
            }
        }else{
                
            $query = "insert into scores values (NULL, '$name', '$score');"; 
            $result = mysql_query($query) or die('Query failed: ' . mysql_error()); 
        } }
            mysqli_close($db); 
        
?>