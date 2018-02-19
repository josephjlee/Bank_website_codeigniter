<h2>Kortilla kirjautuminen</h2>
<p>Käyttääksesi automaatin ominaisuuksia kirjoita sinun kortinnumero ja salasana.</p>
<form action="<?php echo site_url('verkkopankki/card'); ?>" method="post">
<table align="center">
<tr>
	<th>
		<label>Korttinumero</label>
	</th>
	<th>
		<label>Salasana</label>
	</th>
</tr>
<tr>
	<td>
		<input type="text" name="card_id"><br>
	</td>
	<td>
		<input type="text" name="password"><br>
	</td>
	<td>
		<input type="submit" value="Kirjaudu">
	</td>
</tr>
</table>
</form>
