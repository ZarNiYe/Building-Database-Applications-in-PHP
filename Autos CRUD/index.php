<?php 
require_once "pdo.php";
session_start();

if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    return;
}

$stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<title>Zar Ni Ye 5a1b53ff</title>
<?php
require_once "bot.php";
?>
</head>
<body>
<div class="container">
<h2>Welcome to the Automobiles Database</h2>
<?php 

	if (!isset($_SESSION['name'])){ 
        echo('<p><a href="login.php">Please log in</a></p>');
	    echo('<p>Attempt to <a href="add.php">add data</a> without logging in</p>');
	} 
	else { 
        if (isset($_SESSION['error']) ) {
            echo('<p style="color:red">'.htmlentities($_SESSION['error'])."</p>\n");
            unset($_SESSION['error']);
        }

        if ( isset($_SESSION['green']) ) {
            echo '<p style="color:green">'.$_SESSION['green']."</p>\n";
            unset($_SESSION['green']);
        }
            
        if ($rows == false) {
            echo "<p>No rows found</p>";
        }
        else {
            echo ('<table border="1">'."\n");
            echo ("<thead><tr>");
            echo ("<th>Make</th>");
            echo ("<th>Model</th>");
            echo ("<th>Year</th>");
            echo ("<th>Mileage</th>");
            echo ("<th>Action</th>");
            echo ("</thead></tr>\n");
            foreach ($rows as $row) {
                echo ("<tr><td>");
                echo(htmlentities($row['make']));
                echo("</td><td>");
                echo(htmlentities($row['model']));
                echo("</td><td>");
                echo(htmlentities($row['year']));
                echo("</td><td>");
                echo(htmlentities($row['mileage']));
                echo("</td><td>");
                echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / <a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
                echo("</td></tr>\n");
            }
            
            echo('</table>'. "\n");
            echo "<br>";
}
	echo('<p><a href="add.php">Add New Entry</a></p>');
	echo('<p><a href="logout.php">Logout</a></p>');

	} 
?>