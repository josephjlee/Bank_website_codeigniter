<?php $this->load->view('content/adminLinks');?>
<h1>Tietojen lisäys</h1>
<div class="inlineTable2">
	<h2>Käyttäjän lisäys</h2>
	<form action="<?php echo site_url('verkkopankki/addclient');?>" method="post">
	<tr>
		<th><input type="number" name="client_id" placeholder="Asiakasnumero (vapaaehtoinen)"></th><br>
		<th><input type="text" name="firstname" placeholder="Etunimi" required></th><br>
		<th><input type="text" name="lastname" placeholder="Sukunimi" required></th><br>
		<th><input type="submit" value="Lisää"></th>
	</tr>
	</form>
</div>
<div class="inlineTable2">
	<h2>Tilin lisäys</h2>
	<form action="<?php echo site_url('verkkopankki/addaccount');?>" method="post">
	<tr>
		<th><input type="number" name="account_id" placeholder="Tilinumero (vapaaehtoinen)"></th><br>
		<th><input type="number" name="balance" placeholder="Kate" required></th><br>
		<th><input type="submit" value="Lisää"></th>
	</tr>
	</form>
</div>
<div class="inlineTable2">
	<h2>Tilitietojen lisäys</h2>
	<form action="<?php echo site_url('verkkopankki/addpermission');?>" method="post">
	<tr>
		<th><input type="number" name="permission_id" placeholder="Tilitiedonnumero (vapaaehtoinen)"></th><br>
		<th><input type="number" name="account_id" placeholder="Yhdistettävä tilinumero" required></th><br>
		<th><input type="number" name="client_id" placeholder="Asiakasnumero" required></th><br>
		<th><input type="text" name="username" placeholder="Käyttäjänimi" required></th><br>
		<th><input type="text" name="password" placeholder="Salasana" required></th><br>
		<th><input type="submit" value="Lisää"></th>
	</tr>
	</form>
</div>
<div class="inlineTable2">
	<h2>Kortin lisäys</h2>
	<form action="<?php echo site_url('verkkopankki/addcard');?>" method="post">
	<tr>
		<th><input type="number" name="card_id" placeholder="Korttinumero (vapaaehtoinen)"></th><br>
		<th><input type="Tilinumero" name="account_id" placeholder="Yhdistettävä tilinumero" required></th><br>
		<th><input type="text" name="password" placeholder="Salasana" required></th><br>
		<th><input type="submit" value="Lisää"></th>
	</tr>
	</form>
</div>
