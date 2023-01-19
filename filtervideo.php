<?php 
  include 'navbar.php';

  $userId = $_SESSION['Userid'];

  $genre = $_POST['genre'];
	$where = "";
	foreach ($genre as $gr) {
		$s = "Videos.Videotypeid=".$gr." OR ";
		$where = $where.$s;
	}
	$wLen = strlen($where);
	$final = substr($where, 0, $wLen-4).";";

	$_SESSION['vfilter'] = "
	SELECT DISTINCT vlink, vtitle, SPECIFICVIDEOS.Videoid
		FROM SPECIFICVIDEOS 
		JOIN VIDEOMAPPING ON SPECIFICVIDEOS.Videoid=VIDEOMAPPING.Videoid
		JOIN Videos ON VIDEOMAPPING.Videotypeid=Videos.Videotypeid
		WHERE $final
	";

    header('location:video.php');