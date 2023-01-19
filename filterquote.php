<?php 
  include 'navbar.php';

  $userId = $_SESSION['Userid'];

  $genre = $_POST['theme'];
	$where = "";
	foreach ($genre as $gr) {
		$s = "Quotes.Quotetypeid=".$gr." OR ";
		$where = $where.$s;
	}
	$wLen = strlen($where);
	$final = substr($where, 0, $wLen-4).";";

	$_SESSION['qfilter'] = "
	SELECT DISTINCT SPECIFICQUOTES.Quoteid, qtitle, qlink
		FROM SPECIFICQUOTES 
		JOIN QUOTEMAPPING ON SPECIFICQUOTES.Quoteid=QUOTEMAPPING.Quoteid
		JOIN Quotes ON QUOTEMAPPING.Quotetypeid=Quotes.Quotetypeid
		WHERE $final
	";

    header('location:quotes.php');