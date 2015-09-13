<?php
    $n = $_POST['name'];
    $p = $_POST['path'];
    // These salts are valid as of 09/13/15.
    $salt = "92bcaca34ec9093f8849725689d5cefc";
	$salt2 = "NXuYUNu7n8VMaEd";
    $pezzo = base64_encode($p.$n);
    $hash = md5($n);
    $supah = md5($hash.$salt.$pezzo);
    /* 
    Server time MUST be Europe/London for links to be valid
    You can change your timezone by running "dpkg-reconfigure tzdata" via SSH
    Links are valid for an hour before you'll need to regenerate
    */
	$t = date("j:F:Y:h");
    /*
    $ver is the value which is checked against to see if the link is valid.
    See readme for more info
	*/
    $ver = md5($t.$salt2);
    // Some error checking to block blank values.
    if ($hash == "d41d8cd98f00b204e9800998ecf8427e") {
      echo "You must provide a valid input"; }
    elseif ($supah == "1d8922d005309356634c3114859436f2") {
      echo "You must provide a valid input"; }
    else {
      //Using noreferer to block tracking, feel free to remove this.
	  $link = "http://noreferer.link/?http://renderserver.net/vfm-admin/vfm-downloader.php?q=$pezzo&h=$hash&sh=$supah&t=$ver";
      echo "<a href='".$link."' target='_blank'>".$link."</a></br>";
	};
?>


