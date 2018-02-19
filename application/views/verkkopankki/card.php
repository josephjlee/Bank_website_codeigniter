<?php $this->load->view('content/cardLinks');?>
<h1>Kortin tiedot</h1>
<div class="inlineTable">
<h2>Kortti</h2>
<?php
	echo '<table><tr><th>Kortinnumero</th><th>Tilinumero</th><th>Saldo</th></tr>';
	foreach ($cards as $card) {
		echo '<tr>';
		echo '<td>'.$card['card_id'].'</td>';
		echo '<td>'.$card['account_id'].'</td>';
		echo '<td>'.$card['balance'].'</td>';
	}
	echo '</tr></table>';
?>
</div>
