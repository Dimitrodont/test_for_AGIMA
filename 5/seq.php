<?php
    function max_seq($nums){
    	$curr_seq = 0;
    	$max_seq = 0;
    	$in_seq = false;
        foreach($nums as $val){
        	if($val){
        		$in_seq = true;
        		++$curr_seq;
        	}
        	else if($in_seq){
                $in_seq = false;
                if($curr_seq > $max_seq){
                	$max_seq = $curr_seq;
                }
                $curr_seq = 0;
        	}
        }
        if($curr_seq > $max_seq){
            $max_seq = $curr_seq;
        }
        return $max_seq;
    }

    function ms($nums){
    	$arr = explode("0", implode("", $nums));
    	$max_seq = 0;
    	$curr_seq = 0;
    	foreach($arr as $val){
    		$curr_seq = strlen($val);
    		if($curr_seq > $max_seq){
    			$max_seq = $curr_seq;
    		}
    	}
    	return $max_seq;
    }
    
    echo max_seq([0,1,1,1,0,1,1,1,1]) . "\n";
    echo ms([0,1,1,1,0,0,0,1,1,1,1]) . "\n";
