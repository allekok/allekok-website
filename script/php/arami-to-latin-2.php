<?php
    
    $p = $_GET['p'] or die();
    $b = $_GET['b'] or die();
    $m = $_GET['m'] or die();
    
    
    
    header("Content-type: text/html; charset=UTF-8");
    if(isset($_GET['origin'])) {
        echo get_poem($p, $b, $m);
    }
    else {
       echo convert_poem($p, $b, $m);
    }
    
    
    
    function get_poem ($p, $b, $m) {
        $db = "index";
        $tbl = "tbl{$p}_{$b}";
        $q = "SELECT hon FROM {$tbl} WHERE id={$m}";
        require("condb.php");
        
        if($query) {
            $row = mysqli_fetch_assoc($query);
            return $row['hon'];
        }
        
        return null;
    }
    
    function get_poem_kind ($poem) {
        if(stristr($poem , "<div class='b'>")) {
            return "classic";
        }
        else {
            return "new";
        }
    }
    
    function remove_html ($poem) {
        return trim(filter_var($poem, FILTER_SANITIZE_STRING));
    }
    
    function split_lines ($poem) {
        return explode("\n", $poem);
    }
    
    function split_words ($line) {

        $extras = array("&laquo;","&raquo;","&rsaquo;","&lsaquo;","&bull;","&nbsp;","?", "!", "#", "&", "*", "(", ")", "-", "+", "=", "_","[", "]", "{", "}","<",">", "/", "|", "\'", "\"", ";", ":", ",", ".", "~", "`", "؟", "،", "»", "«","ـ","؛","›","‹","•","‌");
        
        $line = str_replace($extras , "", $line);
        
        
        $ar_signs =array('ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ');
        
        $line = str_replace($ar_signs , "" , $line);
        
        
        $from_nums = [
            '۰',
            '۱',
            '۲',
            '۳',
            '۴',
            '۵',
            '۶',
            '۷',
            '۸',
            '۹',
            '٠',
            '١',
            '٢',
            '٣',
            '٤',
            '٥',
            '٦',
            '٧',
            '٨',
            '٩',
            ];
            
        $line = str_replace($from_nums , "" , $line);
        
        $line = preg_replace("/\s+/" , "69sep69", $line);
        
        return explode("69sep69" , $line);
    }
    
    function convert_aramic_to_latin ( $word ) {
        
        // very common exception!
        if($word == "و") {
            return "u";
        }
        
        $always_vocals = [
            "aramic"=>['ە',
                'ه‌',
                'ێ',
                'ۆ',
                'ا',
                'وو',
                'آ'],
            "latin"=>["e",
                "e",
                "ê",
                "o",
                "a",
                "û",
                "a"],
            ];
        
        // $word = str_replace($always_vocals["aramic"], $always_vocals["latin"], $word);
        
        $always_none_vocals = [
            "aramic" => ['ب',
            'ج',
            'چ',
            'د',
            'ف',
            'گ',
            'ه',
            'ژ',
            'ک',
            'ل',
            'ڵ',
            'م',
            'ن',
            'پ',
            'ق',
            'ر',
            'ڕ',
            'س',
            'ش',
            'ت',
            'ڤ',
            'خ',
            'ز',
            'ئ',
            'ح',
            'غ',
            'ع',
            'ص',
            'ض',
            'ط',
            'ظ',
            ],
            "latin" => ['b','c','ç','d','f','g','h','j','k','l','ľ','m','n','p','q','r','ř','s','ş','t','v','x','z','','ĥ','ẍ','ȁ','s','z','t','z'],
            ];
            
        // $word = str_replace($always_none_vocals["aramic"], $always_none_vocals["latin"], $word);
        
        $none_vocals = [
            "aramic" => [
                'و',
                'ی',
            ],
            "latin" => ['w','y'],
            ];
            
        $vocals = [
            "aramic" => [
                'و',
                'ی',
            ],
            "latin" => ['u', 'î'],
            ];
            
        $special = "i";
        
        $chars = [];
        
        
        preg_match_all('/./u', $word, $chars);

        $chars = $chars[0];
        
        $final = [
            "char"=>[],
            "type"=>[]
            ];
            
        /* n for none-vocal, v for vocal */
        
        
        $k = 0;
        
        foreach ($chars as $ch) {
            
            $_n0 = in_array($chars[$k-1], $always_none_vocals["aramic"]);
            $_v0 = in_array($chars[$k-1], $always_vocals["aramic"]);
            $_n1 = in_array($chars[$k], $always_none_vocals["aramic"]);
            $_v1 = in_array($chars[$k], $always_vocals["aramic"]);
            $_n2 = in_array($chars[$k+1], $always_none_vocals["aramic"]);
            $_v2 = in_array($chars[$k+1], $always_vocals["aramic"]);
            
            if($_n1) {
                
                if($k>0 and $_n0) {
                    $final["char"][$k] = $special;
                    $final["type"][$k] = "v";
                }
                $final["char"][$k+1] = str_replace($always_none_vocals["aramic"], $always_none_vocals["latin"], $ch);
                $final["type"][$k+1] = "n";
                $k++;
            }
            elseif($_v1) {
                $final["char"][$k] = str_replace($always_vocals["aramic"], $always_vocals["latin"], $ch);
                $final["type"][$k] = "v";
                
                if($k>0 and $k<count($chars)) {
                    $final["char"][$k-1] = str_replace($none_vocals["aramic"], $none_vocals["latin"], $chars[$k-1]);
                    $final["type"][$k-1] = "n";
                    
                    $final["char"][$k+1] = str_replace($none_vocals["aramic"], $none_vocals["latin"], $chars[$k-1]);
                    $final["type"][$k+1] = "n";
                    
                    $k++;
                }
                
            }
            else {
                $final["char"][$k] = str_replace($vocals["aramic"], $vocals["latin"], $ch);
                $final["type"][$k] = "v";
            }
            
            $k++;
            
            /*
            if($_n0 and $_n1) {
                $final["char"][$k] = $special;
                $final["type"][$k] = "v";
                $k++;
                $final["char"][$k] = $ch;
                $final["type"][$k] = "n";
            }*/
           /* 
            if($_v1) {
                $k--;
                $final["char"][$k] = str_replace($none_vocals["aramic"], $none_vocals["latin"], $ch);
                $final["char"][$k] = "n";
                $k++;
                $k++;
                $final["char"][$k] = str_replace($none_vocals["aramic"], $none_vocals["latin"], $ch);
                $final["type"][$k] = "n";
            }
            */
            

        }
        
        
        // echo "<pre>"; print_r($final); echo "</pre>";
        return implode("", $final["char"]);
        
    }
    
    function join_words ($words) {
        return implode(" ", $words);
    }
    
    function join_lines ($lines) {
        return implode("\n", $lines);
    }
    
    function set_poem_kind ($poem, $poem_kind) {
        if($poem_kind == "classic") {
            $poem = "<div class='b'>" . $poem . "</div>";
        }
        elseif($poem_kind == "new") {
            $poem = "<div class='n'><div class='m'>" . $poem . "</div></div>";
        }
        
        return $poem;
    }
    
    function add_html ($poem) {
        return str_replace("\n", "<br>\n", $poem);
    }
    
    function convert_poem ($p, $b, $m) {
        $poem = get_poem($p, $b, $m);
        $poem_kind = get_poem_kind($poem);
        $poem = remove_html($poem);
        
        $lines = split_lines($poem);
        
        $words = [];
        foreach($lines as $l) {
            $words[] = split_words($l);
        }
        
        for($l=0; $l<count($words); $l++) {
            
            for($w=0; $w<count($words[$l]); $w++) {
                $words[$l][$w] = convert_aramic_to_latin ($words[$l][$w]);
            }
            
            $words[$l] = join_words($words[$l]);
            
        }
        
        $poem = join_lines($words);
        
        $poem = set_poem_kind ($poem, $poem_kind);

        $poem = add_html($poem);
        
        return $poem;
    }

?>