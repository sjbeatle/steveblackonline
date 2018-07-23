<?php
if ($_GET['randomId'] != "Qd8rC_GH_N_xFx6oW0s5jLWpqVla9599pKhEjhQ1e65D2XACC6SFuzIC9s3SnlvZ") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
