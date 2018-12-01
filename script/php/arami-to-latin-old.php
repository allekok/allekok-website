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
        $non_vocals = [
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
            'و',
            'خ',
            'ی',
            'ز',
            'ئ',
            'ح',
            'غ',
            'ع',
            ],
            "latin" => ['b','c','ç','d','f','g','h','j','k','l','ľ','m','n','p','q','r','ř','s','ş','t','v','w','x','y','z','','ĥ','ẍ',''],
            ];
            
        $vocals = [
            "aramic" => ['ە',
            'ێ',
            'ی',
            'ۆ',
            'وو',
            'و',
            'ا',
            ],
            "latin" => ['e','ê','î','o','û','u','a'],
            ];
            
        $special = "i";
        
        $chars = [];
        
        // very common exception!
        if($word == "و") {
            return "u";
        }
        
        preg_match_all('/./u', $word, $chars);

        $chars = $chars[0];
        
        $final = [
            "chars"=>[],
            "type"=>[]
            ];
            
        /* n for non-vocal, v for vocal */
        
        
        $k = 0;
        
        foreach ($chars as $ch) {
            if($k === 0) {
                $final["chars"][0] = str_replace($non_vocals['aramic'], $non_vocals['latin'] , $ch);
                $final["type"][0] = "n";
            }
            else {
                
                $_n = in_array($ch, $non_vocals['aramic']);
                $_v = in_array($ch, $vocals['aramic']);
                $_v0 = ($final['type'][$k-1] == "v");
                $_n0 = ($final['type'][$k-1] == "n");
                
                if($_v and $_n0) {
                    $final["chars"][$k] = str_replace($vocals['aramic'], $vocals['latin'] , $ch);
                    $final['type'][$k] = 'v';
                }
                elseif($_n and $_v0) {
                    $final["chars"][$k] = str_replace($non_vocals['aramic'], $non_vocals['latin'] , $ch);
                    $final['type'][$k] = 'n';
                }
                elseif($_v and $_v0) {
                    $final["chars"][$k] = str_replace($non_vocals['aramic'], $non_vocals['latin'] , $ch);
                    $final['type'][$k] = 'n';
                }
                elseif($_n and $_n0) {
                    $final["chars"][$k] = $special;
                    $final['type'][$k] = 'n';
                    
                    $final["chars"][$k+1] = str_replace($non_vocals['aramic'], $non_vocals['latin'] , $ch);
                    $final['type'][$k+1] = 'n';
                    
                    $k++;
                }
                
            }
            
            $k++;

        }
        
        
        return implode("", $final["chars"]);
        
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