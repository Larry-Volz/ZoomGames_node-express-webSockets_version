<?php

// echo json_encode($_POST)."\n";
// echo "$_POST";

echo "ARRIVED AT chatApp.php\n\n";

       //receive message from chatApp.html
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $msg = intval($_POST["message"]);
            echo "message $msg received\n\n";
       }

        $link = connect_to_server();

        $sql = "INSERT INTO game_marker_jeopardy (this_round_id) VALUES ('$msg')";

        insertIntoTable($link, $sql);



        function connect_to_server(){
            /**
             * links to server and database and returns the link
             */
                
            $servername = "localhost";
            $username = "richmov8_larryvolz";
            $password = "zgZacNat123";
            $dbname = "richmov8_zoom_games";
    
            // define("DB_HOST", "localhost");
            // define("DB_USER", "root");
            // define("DB_PASSWORD", "");
            // define("DB_DATABASE", "databasename");
    
            
            //  echo "ATTEMPTING TO CONNECT<br>";
            
            //CONNECT TO DATABASE
            //global $link;
    
            echo "ATTEMPTING TO CONNECT<br>";
            
            $link=mysqli_connect ($servername, $username, $password);
            // $link=mysqli_connect (DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    
            
            //return error if no connection
            if (!$link){
                die("Connection failed: " . mysqli_connect_error());
            }
            //otherwise confirm success
            echo "<p>Server connected successfully</p>";
            
            //select database
            mysqli_select_db($link, $dbname);
            
            return $link;
    
            echo ("Reached the PHP file");
            
        }

        function insertIntoTable($link, $sql) {
            if (mysqli_query($link, $sql)) {
                // echo "<p>New record created successfully in: client table</p>";
               } else {
                 echo "Error: " . $sql . "<br>" . mysqli_error($link);
               }
        }

?>
    
