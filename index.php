<!DOCTYPE html>
<html lang="de">
    <head>
		<title>Hier könnte ihr Titel stehen</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
		<?php
		
		$db_link = mysql_connect("127.0.0.1:3306","reader","");
		$db_sel = mysql_select_db("multipath", $db_link)
					or die("Auswahl der Datenbank fehlgeschlagen");
		$sql = "Select * from stories Where ID=1";
		
		$db_erg = mysql_query( $sql );
		if ( ! $db_erg )
		{
			die('Ungültige Abfrage: ' . mysql_error());
		}
		while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
		{
			echo '<div class="hero-unit">';
			echo '<h1>'.$zeile['Ueberschrift'].'</h1>';
			echo '<p>'.$zeile['kurzfassung'].'</p>';
			echo '<p><a href="story.php?story='.$zeile['ID'].'&ID=0" class="btn btn-primary btn-large">Lesen &raquo;</a></p>';
			echo '</div>';
		}
		?>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </body>
</html>
