<?php $this->load->view('content/accountLinks');?>
<article>
<?php 
foreach ($account as $user) {
	echo '<h1>Tervetuloa '.$user['firstname'].' '.$user['lastname'].'</h1>';
	echo '<div class="inlineTable2"><h2>Tilitiedot</h2><table><tr><th>Tilinumero</th><th>Etunimi</th><th>Sukunimi</th>';
	echo '<tr><td>'.$user['account_id'].'</td><td>'.$user['firstname'].'</td><td>'.$user['lastname'].'</td></tr></table></div>';
	echo '<div class="inlineTable2"><h2>Saldo</h2><section>'.$user['balance'].' €'.'</section></div>';	
}

echo '<div class="inlineTable2"><h2>Tilin kortit</h2><table>';
if (!empty($cards)) {
	echo '<tr><th>Korttinumero</th></tr>';
	foreach ($cards as $card) {
		echo '<tr>';
		echo '<td>'.$card['card_id'].'</td>';
		echo '</tr>';
	}
}
else {
	echo '<td>Kortteja ei ole</td>';	
}
echo '</table></div>';
?>
</article>

