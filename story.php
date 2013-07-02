<!DOCTYPE html>
<html lang="de">
    <head>
		<title>Hier könnte ihr Titel stehen</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		
		    <script type="text/javascript">

        // Wait for the page to load first
        window.onload = function() {

   

          a.onclick = function() {
			         var a = document.getElementById("body");
			         

			  


            return false;
          }
        }
    </script>
		
    </head>
    <body id="body">
		
		<div class="container">
		<?php
		
		$NL = "\n";
		
		$db_link = mysql_connect("127.0.0.1:3306","reader","");
		$db_sel = mysql_select_db("multipath", $db_link)
					or die("Auswahl der Datenbank fehlgeschlagen");
		//$sql = "Select * from stories Where ID=1";
		if ($_GET['ID'] == 0)
		{
			$sql = 'Select * from stories Where ID='.$_GET['story'];
			$title = 'Ueberschrift';
			$text = 'Inhalt';
		}
		else
		{
			$sql = 'Select * from posts Where ID='.$_GET['ID'];
			$title = 'Wahl';
			$text = 'Text';
		}
			
			$db_erg = mysql_query( $sql );
			if ( ! $db_erg )
			{
				die('Ungültige Abfrage: ' . mysql_error());
			}
			while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
			{
				echo '<div class="hero-unit">'.$NL;
				echo '<h1>'.$zeile[$title].'</h1>'.$NL;
				echo '<p>'.$zeile[$text].'</p>'.$NL;
				echo '</div>'.$NL;
			}
			
			$sql = 'Select * from posts Where Parent='.$_GET['ID'].' AND Story='.$_GET['story'];
			$db_erg = mysql_query( $sql );
			if ( ! $db_erg )
			{
				die('Ungültige Abfrage: ' . mysql_error());
			}
			echo '<div class="row">'.$NL;
			while ($zeile = mysql_fetch_array( $db_erg, MYSQL_ASSOC))
			{
				echo '<div class="span4">'.$NL;
				echo '<p>'.$zeile['Wahl'].'</p>'.$NL;
				echo '<p><a href="story.php?story='.$_GET['story'].'&ID='.$zeile['ID'].'" class="btn btn-primary btn-small">Lesen &raquo;</a></p><br/><br/>'.$NL;
				echo '</div><!--/span-->'.$NL;
			}
				echo '<div class="span4">'.$NL;
				echo '<p><a id="neuLink" href="#" class="btn btn-primary btn-small">Neu Hinzufügen</a></p><br/><br/>'.$NL;
				echo '</div><!--/span-->'.$NL;
			
			echo '</div><!--/row-->'.$NL
			
			
		
		?>
		<div class="row">
			<div class="span3"></div>
			<div class="span3">
				<form class="form-horizontal">
					<fieldset>

					<!-- Form Name -->
					<legend>Neue Auswahl</legend>

					<!-- Text input-->
					<div class="control-group">
						<label class="control-label" for="auswahl">Auswahl</label>
						<div class="controls">
							<input id="auswahl" name="auswahl" placeholder="" class="input-xlarge" type="text">
						</div>
					</div>

					<!-- Textarea -->
					<div class="control-group">
						<label class="control-label" for="Text">Text</label>
						<div class="controls">                     
							<textarea id="Text" name="Text"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="span4"></div>
		</div>

		
		</div> <!-- /container -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </body>
</html>
