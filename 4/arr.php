<?php

    $arr = ["Masha" => "manager", "Sasha" => "director", "Misha" => "designer", "Dima" => "linguist"];

    $keys = [];
    
$keys_length = 0;


    echo "direct pass\n";
    
foreach($arr as $key => $val){

        echo $key . " => " . $val . "\n";

        $keys[] = $key;

    }

    $keys_length = count($keys);

    
echo "reverse pass\n";
    
for($i = $keys_length - 1; $i >= 0; --$i){

        echo $keys[$i] . " => " . $arr[$keys[$i]] . "\n";

    }
