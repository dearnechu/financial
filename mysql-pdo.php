<?php
    function checkUserAuthentication($user_id, $token, $db_servername, $db_database, $db_username, $db_password) {
        try{ // Check connection before executing the SQL query 
            $dbh = new PDO("mysql:host=".$db_servername.";dbname=".$db_database, $db_username, $db_password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $q = "SELECT count(*) as isValid FROM user_authentication WHERE user_id = :user_id and token = :token";
    
            $sth = $dbh->prepare($q);
    
            $sth->bindParam(':user_id', $user_id);
            $sth->bindParam(':token', $token);
    
            $sth->execute();
            // Set fetch mode to FETCH_ASSOC to return an array indexed by column name.
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            // Fetch result.
            $result = $sth->fetchColumn();
            /**
             * HTML encode our result using htmlentities() to prevent stored XSS and print the
             * result to the page
             */
    
            //Close the connection to the database.
            $dbh = null;

            return ( htmlentities($result) );
        }
        catch(PDOException $e){
            /**
             * You can log PDO exceptions to PHP's system logger, using the
             * log engine of the operating system
             *
             * For more logging options visit http://php.net/manual/en/function.error-log.php
             */
            error_log('PDOException - ' . $e->getMessage(), 0);
            /**
             * Stop executing, return an Internal Server Error HTTP status code (500),
             * and display an error
             */
            http_response_code(500);
            return 0;
        }
    }
?>