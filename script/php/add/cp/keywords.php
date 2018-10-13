<?php
    
    $db = "search";
    $q = "SELECT * FROM keywords";
    require_once("../../condb.php");
    
    $_d = $_POST;
    
    if( !empty($_d['rf']) && !empty($_d['rl']) ) {
        
        $_e = array();
        
        require_once("../../sanKuText.php");
        $_d['f'] = san_data($_d['rf']);
        $_d['l'] = san_data($_d['rl']);
        
        
        $q = "SELECT * FROM keywords WHERE f='{$_d['f']}' OR l='{$_d['l']}'";
        
        $query = mysqli_query($conn, $q);
        
        if(mysqli_num_rows($query)>0) {
            
            $_res = mysqli_fetch_assoc($query);
            
            $_e['color'] = "red";
            $_e['message'] = "<hr>" . "There is a match!" . "<br>";
            
            foreach($_res as $_k=>$_v) {
                
                $_e['message'] .= $_k . " => " . $_v . "<br>";
            } 
            $_e['message'] .= "<hr>";
            
            
        } else {
            
            $q = "INSERT INTO keywords (f,rf,l,rl) VALUES('{$_d['f']}','{$_d['rf']}','{$_d['l']}','{$_d['rl']}')";
            $query = mysqli_query($conn, $q);
            
            if($query) {
                $_e['color'] = "green";
                $_e['message'] = "<hr>" . "done!" . "<hr>";
            } else {
                $_e['color'] = "red";
                $_e['message'] = "<hr>" . "Error in Insertation!" . "<hr>";
            }
        }
        
        // mysqli_close($conn);
    } 
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>keywords</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    </head>
    
    <body>
        <div>
            <?php echo "<i style='color:{$_e['color']}'>{$_e['message']}</i>"; ?>
        </div>
        
        <form style="direction:ltr" method="post">
            real first: <input type="text" name="rf">
            real last: <input type="text" name="rl">
            
            <input type="submit">
            
        </form>
        
        <div>
            <?php
            
                $q = "SELECT * FROM keywords";
                
                $query = mysqli_query($conn, $q);
                
                if($query) {
                    while($_res = mysqli_fetch_assoc($query)) {
                        
                        foreach($_res as $_k=>$_v) {
                            
                            echo "<span>" . $_k . " => " . $_v . "</span> &bull; ";
                        }
                        echo "<hr>";
                    }
                }
                
                mysqli_close($conn);
            
            ?>
        </div>
    </body>
</html>