<?php $this->load->view('content/adminLinks');?>
<h1>Verkkopankki tietokannan hallinta</h1>
<div class="inlineTable">
	<h2>Asiakkaat</h2>	
	<table>
		<?php	
		if (!empty($clients)) {
			echo '<tr><th>Asiakasnumero</th><th>Etunimi</th><th>Sukunimi</th></tr>';
			foreach ($clients as $client) {
				echo '<tr><td>'.$client['client_id'].'</td>';
				echo '<td>'.$client['firstname'].'</td>';
				echo '<td>'.$client['lastname'].'</td>';
				echo '<td><form id="del'.$client['client_id'].'" action="'.site_url('verkkopankki/deleteclient').'" method="post">';
				echo '<input type="hidden" name="client_id" value="'.$client['client_id'].'"/>';
				echo '<button type="submit" class="deleteButton" value="delete" form="del'.$client['client_id'].'">Poista</button></td></form>';
				echo '<td><form id="up'.$client['client_id'].'" action="'.site_url('verkkopankki/editclient').'" method="post">';
				echo '<input type="hidden" name="client_id" value="'.$client['client_id'].'"/>';
				echo '<input type="hidden" name="firstname" value="'.$client['firstname'].'"/>';
				echo '<input type="hidden" name="lastname" value="'.$client['lastname'].'"/>';
				echo '<button type="submit" class="editButton" value="edit" form="up'.$client['client_id'].'">Muokkaa</button></td></form></tr>';
			}
		}
		else {
			echo '<td>Asiakkaita ei ole</td>';
		}
		?>
	</table>
</div>
<div class="inlineTable">
	<h2>Tilitiedot</h2>
	<table>
	<?php
	if (!empty($permissions)) {
		echo '<tr>';
		echo '<th>Tilinumero</th>';
		echo '<th>Asiakasnumero</th>';
		echo '<th>Käyttäjänimi</th>';
		echo '<th>Salasana</th>';
		echo '</tr>';
		foreach ($permissions as $permission) {
			echo '<tr><td>'.$permission['account_id'].'</td>';
			echo '<td>'.$permission['client_id'].'</td>';
			echo '<td>'.$permission['username'].'</td>';
			echo '<td>'.$permission['password'].'</td>';
			echo '<form id="delp'.$permission['permission_id'].'" action="'.site_url('verkkopankki/deletepermission').'" method="post">';
			echo '<input type="hidden" name="permission_id" value="'.$permission['permission_id'].'"/>';
			echo '<td><button type="submit" class="deleteButton" value="delete" form="delp'.$permission['permission_id'].'">Poista</button></td></form>';
			echo '<td><form id="upp'.$permission['permission_id'].'" action="'.site_url('verkkopankki/editpermission').'" method="post">';
			echo '<input type="hidden" name="permission_id" value="'.$permission['permission_id'].'"/>';
			echo '<input type="hidden" name="account_id" value="'.$permission['account_id'].'"/>';
			echo '<input type="hidden" name="client_id" value="'.$permission['client_id'].'"/>';
			echo '<input type="hidden" name="username" value="'.$permission['username'].'"/>';
			echo '<input type="hidden" name="password" value="'.$permission['password'].'"/>';
			echo '<button type="submit" class="editButton" value="edit" form="upp'.$permission['permission_id'].'">Muokkaa</button></td></form></tr>';
		}
	}
	else {
		echo '<td>Tilitietoja ei ole</td>';
	}	
	?>
	</table>
</div>
<br>
<div class="inlineTable">
	<h2>Tilit</h2>
	<table>
		<?php	
		if (!empty($accounts)) {
			echo '<tr><th>Tilinumero</th>';
			echo '<th>Saldo</th></tr>';
			foreach ($accounts as $account) {
				echo '<tr>';
				echo '<td>'.$account['account_id'].'</td>';
				echo '<td>'.$account['balance'].'</td>';
				echo '<form id="dela'.$account['account_id'].'" action="'.site_url('verkkopankki/deleteaccount').'" method="post">';
				echo '<input type="hidden" name="account_id" value="'.$account['account_id'].'"/>';
				echo '<td><button type="submit" class="deleteButton" value="delete" form="dela'.$account['account_id'].'">Poista</button></td></form>';
				echo '<td><form id="upa'.$account['account_id'].'" action="'.site_url('verkkopankki/editaccount').'" method="post">';
				echo '<input type="hidden" name="account_id" value="'.$account['account_id'].'"/>';
				echo '<input type="hidden" name="balance" value="'.$account['balance'].'"/>';
				echo '<button type="submit" class="editButton" value="edit" form="upa'.$account['account_id'].'">Muokkaa</button></td></form></tr>';
				echo '</tr>';
			}
		}
		else {
			echo '<td>Tilejä ei ole</td>';
		}
		?>
	</table>
</div>
<div class="inlineTable">
	<h2>Kortit</h2>
	<table>
	<?php
	if (!empty($cards)) {
		echo '<tr>';
		echo '<th>Korttinumero</th>';
		echo '<th>Tilinumero</th>';
		echo '<th>Salasana</th>';
		echo '</tr>';
		foreach ($cards as $card) {
			echo '<tr><td>'.$card['card_id'].'</td>';
			echo '<td>'.$card['account_id'].'</td>';
			echo '<td>'.$card['password'].'</td>';
			echo '<form id="delc'.$card['card_id'].'" action="'.site_url('verkkopankki/deletecard').'" method="post">';
			echo '<input type="hidden" name="card_id" value="'.$card['card_id'].'"/>';
			echo '<td><button type="submit" class="deleteButton" value="delete" form="delc'.$card['card_id'].'">Poista</button></td></form>';
			echo '<td><form id="upc'.$card['card_id'].'" action="'.site_url('verkkopankki/editcard').'" method="post">';
			echo '<input type="hidden" name="card_id" value="'.$card['card_id'].'"/>';
			echo '<input type="hidden" name="account_id" value="'.$card['account_id'].'"/>';
			echo '<input type="hidden" name="password" value="'.$card['password'].'"/>';
			echo '<button type="submit" class="editButton" value="edit" form="upc'.$card['card_id'].'">Muokkaa</button></td></form></tr>';
		}
	}
	else {
		echo '<td>Kortteja ei ole</td>';
	}
	?>
	</table>
</div>
