<h1>Hallinta sivusto</h1>
<div class="inlineTable">
	<h2>Asiakastiedot</h2>
	<table>
		<?php
		echo '<tr><th>Asiakasnumero</th><th>Etunimi</th>
		<th>Sukunimi</th></tr>';
		foreach ($clients as $client) {
			echo '<tr><td>'.$client['client_id'].'</td>';
			echo '<td>'.$client['firstname'].'</td>';
			echo '<td>'.$client['lastname'].'</td></tr>';
		}
		?>
	</table>
</div>
<div class="inlineTable">
	<h2>Tilitiedot</h2>
</div>
