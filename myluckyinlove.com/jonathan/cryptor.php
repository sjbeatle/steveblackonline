<?php
function encrypt($input) {
        $key = 1;
        $len = strlen($input);
        for($i = 0; $i < $len; $i++) {
            $char = substr($input, $i, 1);
            $char = ord($char);
            $char = $char + $key;
            $char = chr($char);
            $input = substr_replace($input, $char, $i, 1);
        }
        return($input);
    }

    function decrypt($input) {
        $key = 1;
        $len = strlen($input);
        for($i = 0; $i < $len; $i++) {
            $char = substr($input, $i, 1);
            $char = ord($char);
            $char = $char - $key;
            $char = chr($char);
            $input = substr_replace($input, $char, $i, 1);
        }
        return($input);
    }
?>