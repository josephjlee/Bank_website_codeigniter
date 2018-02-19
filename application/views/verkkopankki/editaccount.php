<?php $this->load->view('content/adminLinks');?>
<h1>Päivitä valitun käyttäjän tiedot</h1>
<div class="inlineTable">
<h2>Tili</h2>
<table>
<form action="<?php echo site_url('verkkopankki/updateaccount');?>" method="post">
	<input type="hidden" name="old_account_id" value="<?php echo $this->input->post('account_id');?>">
	<tr>
		<td><label>Tilinumero</label></td>
		<td><input type="number" name="account_id" value="<?php echo $this->input->post('account_id');?>"></td>
	</tr>
	<tr>
		<td><label>Saldo</label></td>
		<td><input type="text" name="balance" value="<?php echo $this->input->post('balance');?>"></td>
	</tr>
	<tr>
		<td></td><td><input type="submit" name="send" value="Päivitä"></td>
	</tr>
</form>
</table>
</div>
