<h2>Verkkopankki</h2>
<p>Tervetuloa käyttämään verkkopankkia. Kirjaudu sisään tunnuksillasi jatkaaksesi.</p>
<form action="<?php echo site_url('verkkopankki/account'); ?>" method="post">
<table align="center">
<tr>
	<th>
		<label>Käyttäjätunnus</label>
	</th>
	<th>
		<label>Salasana</label>
	</th>
</tr>
<tr>
	<td>
		<input type="text" name="username"><br>
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
