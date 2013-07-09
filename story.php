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
		if (!empty($_POST))
		{
			if(isset($_POST["ok"]))
			{
				$sql = "INSERT INTO posts(Parent, Story, Wahl, Text) VALUES (";
				if ($_POST["ok"]=="ok")
				{
					if ($_GET['ID'] == 0)
					{
						$sql = $sql."0,".$_GET['story'];
					}
					else
					{
						$sql = $sql.$_GET['ID'].",".$_GET['story'];
					}
				}
				
				$sql = $sql.",'".$_POST['Wahl']."','".$_POST['Text']."')";
				
				mysql_query( $sql );
			}
		}
		
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
			if (empty($_POST) || isset($_POST["ok"]))
			{
				echo '<div class="span2">'.$NL;
					echo '<form class="form-horizontal" method="post">'.$NL;
						echo '<!-- Button -->'.$NL;
						echo '<button id="neu" name="neu" class="btn btn-primary" value="neu">neu hinzufügen</button>'.$NL;
					echo '</form>'.$NL;
				echo '</div><!--/span-->'.$NL;	
			}
			echo '</div><!--/row-->'.$NL;
			if (!empty($_POST))
			{
				if(isset($_POST["neu"]))
				{
				if($_POST["neu"]=="neu")
				{
				echo '<div class="row">'.$NL;
					echo '<div class="span3"></div>'.$NL;
					echo '<div class="span3">'.$NL;
						echo '<form class="form-horizontal" method="post">'.$NL;
						
							echo '<fieldset>'.$NL;
							echo '<!-- Form Name -->'.$NL;
							echo '<legend>Neue Auswahl</legend>'.$NL;

							echo '<!-- Text input-->'.$NL;
							echo '<div class="control-group">'.$NL;
								echo '<label class="control-label" for="Wahl">Auswahl</label>'.$NL;
								echo '<div class="controls">'.$NL;
									echo '<input id="auswahl" name="Wahl" placeholder="" class="input-xlarge" type="text">'.$NL;
								echo '</div>'.$NL;
							echo '</div>'.$NL;

							echo '<!-- Textarea -->'.$NL;
							echo '<div class="control-group">'.$NL;
								echo '<label class="control-label" for="Text">Text</label>'.$NL;
								echo '<div class="controls">'.$NL;
									echo '<textarea id="Text" name="Text"></textarea>'.$NL;
								echo '</div>'.$NL;
							echo '</div>'.$NL;
					
							echo '<!-- Button -->'.$NL;
							echo '<div class="control-group">'.$NL;
								echo '<label class="control-label" for="ok"></label>'.$NL;
								echo '<div class="controls">'.$NL;
									echo '<button id="ok" name="ok" class="btn btn-primary" value="ok">OK</button>'.$NL;
								echo '</div>'.$NL;
							echo '</div>'.$NL;
						echo '</fieldset>'.$NL;
						echo '</form>'.$NL;
					echo '</div>'.$NL;
					echo '<div class="span4"></div>'.$NL;
				echo '</div>'.$NL;
				}
			}}
		?>
		
		</div> <!-- /container -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
    </body>
</html>
