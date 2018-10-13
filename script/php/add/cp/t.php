<meta charset="utf-8">
<link href="/style/css/main.css" rel="stylesheet">


<?php
    
    function give_me_bin_plus_one($n) {
                $n[3]++;
                if($n[3] == 2) {
                    $n[3] = 0;
                    $n[2]++;
                if($n[2] == 2) {
                    $n[2] = 0;
                    $n[1]++;
                    if($n[1] == 2) {
                        $n[1] = 0;
                        $n[0]++;
                        if($n[0] == 2) {
                            $null = array(0,0,0,0);
                            return $null;
                            exit;
                        }
                    }
                }
            }
            return $n;
    }
    
    function rand_spaces($q) {
        if (stristr($q," ") === false) {
            return($q);
            exit;
        }
        $q = array(array("",$q));
        $s_num = 0;
        while($s_num==0 || stristr($q[count($q)-1][1]," ")) {
            //$s_pos[$s_num] = stripos($q[$s_num]," ");
            $q[$s_num+1][0] = stristr($q[$s_num][1]," ",true);
            $q[$s_num+1][1] = substr(stristr($q[$s_num][1]," "),1);
            
            $s_num++;
        }
        $p = array();
        $n = array();
        for($i=0;$i<(count($q)-1);$i++) {
            $n[$i] = 0;
            if($i != 0) {
                if($i == count($q)-2) {
                    $p[$i] = $q[$i][0];
                    $p[$i+1] = $q[$i+1][0];
                    $p[$i+2] = $q[$i+1][1];
                } else {
                    $p[$i] = $q[$i][0];
                }
            }
            
        }
        print_r($p);
        $pn = count($p)-1;
        $str_out = array($q[0][1]);
        $b = 1;
        $num_loop = pow(2,count($q)-1);
        if($num_loop>49) {
            $num_loop = 49;
        }
        for($i=0; $i<$num_loop;$i++) {
            $n = give_me_bin_plus_one($n);
            $f = str_replace(array(0,1),array(""," "),$n);
            $j=0;
            while($j <= count($p)-1) {
                $str_out[$b].=$p[$j+1] . $f[$j];
                $j++;
            }
            $b++;
            
        }
        return($str_out);
    }
    
  $email = 'مەکرووھات و موحەڕڕەمات و ئیعزاری جومعە';
  echo $email;
  echo "<br><pre>";
  print_r(rand_spaces($email));
  echo "</pre>";
  ///$count
  
?>