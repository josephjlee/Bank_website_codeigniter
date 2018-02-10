<h2>Kirjat</h2>
<?php
	echo '<table>';
	echo '<tr><th>ID</th>';
	echo '<th>FORENAME</th>';
	echo '<th>SURNAME</th>';
	echo '<th>PHONE</th>';
	echo '<th>ADDRESS</th>';
	echo '<th>POSTAL CODE</th>';
	echo '</tr><br><tr>';
	foreach($borrowers as $borrower) {
		echo '<tr><td>'.$borrower['borrower_id'];
		echo '</td><td>'.$borrower['firstname'];
		echo '</td><td>'.$borrower['lastname'];
		echo '</td><td>'.$borrower['phone'];
		echo '</td><td>'.$borrower['streetAddress'];
		echo '</td><td>'.$borrower['postalCode'];
		echo '</td></tr>';	
	}
	echo '</tr>';
	echo '</table>';
?>
