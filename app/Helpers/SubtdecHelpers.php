<?php

if (!function_exists('substitutionDecrypt')) {
    function substitutionDecrypt($encryptedText) {
        $decryptedText = '';

        $plan = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
         "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y",
          "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $kunci = array("~", "ݣ", "@", "#", "%", "^", "&", "*", "À", "Җ", "ȸ", "ɮ",
            "Ԃ", "Ԅ", "ۻ", "۞", "ݘ", "ࢼ", "₡", "₯", "₤", "₭", "℗", "Ὦ", "ή", "ᾤ",
            "₪", "ﬓ", "ꟿ", "♫", "₿", "∆");
        $decryptedText = str_replace($kunci, $plan, $encryptedText);

        return $decryptedText;
    }
}


?>
