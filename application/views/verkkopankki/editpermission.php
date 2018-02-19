<?php $this->load->view('content/adminLinks');?>
<h1>Päivitä valitun käyttäjän tiedot</h1>
<div class="inlineTable">
<h2>Tilitiedot</h2>
<table>
<form action="<?php echo site_url('verkkopankki/updatepermission');?>" method="post">
	<input type="hidden" name="old_permission_id" value="<?php echo $this->input->post('permission_id');?>">
	<tr>
		<td><label>Tilitietonumero</label></td>
		<td><input type="number" name="permission_id" value="<?php echo $this->input->post('permission_id');?>"></td>
	</tr>
	<tr>
		<td><label>Tilinumero</label></td>
		<td><input type="number" name="account_id" value="<?php echo $this->input->post('account_id');?>"></td>
	</tr>
	<tr>
		<td><label>Asiakasnumero</label></td>
		<td><input type="number" name="client_id" value="<?php echo $this->input->post('client_id');?>"></td>
	</tr>
	<tr>
		<td><label>Käyttäjänimi</label></td>
		<td><input type="text" name="username" value="<?php echo $this->input->post('username');?>"></td>
	</tr>
	<tr>
		<td><label>Salasana</label></td>
		<td><input type="text" name="password" value="<?php echo $this->input->post('password');?>"></td>
	</tr>
	<tr>
		<td></td><td><input type="submit" name="send" value="Päivitä"></td>
	</tr>
</form>
</table>
</div>
