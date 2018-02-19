<?php $this->load->view('content/adminLinks');?>
<h1>Päivitä valitun käyttäjän tiedot</h1>
<div class="inlineTable">
<h2>Kortti</h2>
<table>
<form action="<?php echo site_url('verkkopankki/updatecard');?>" method="post">
	<input type="hidden" name="old_card_id" value="<?php echo $this->input->post('card_id');?>">
	<tr>
		<td><label>Korttinumero</label></td>
		<td><input type="number" name="card_id" value="<?php echo $this->input->post('card_id');?>"></td>
	</tr>
	<tr>
		<td><label>Tilinumero</label></td>
		<td><input type="number" name="account_id" value="<?php echo $this->input->post('account_id');?>"></td>
	</tr>
	<tr>
		<td><label>Salasana</label></td>
		<td><input type="number" name="password" value="<?php echo $this->input->post('password');?>"></td>
	</tr>
	<tr>
		<td></td><td><input type="submit" name="send" value="Päivitä"></td>
	</tr>
</form>
</table>
</div>
