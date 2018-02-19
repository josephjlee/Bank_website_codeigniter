<?php $this->load->view('content/adminLinks');?>
<h1>Päivitä valitun käyttäjän tiedot</h1>
<div class="inlineTable">
<h2>Asiakastiedot</h2>
<table>
<form action="<?php echo site_url('verkkopankki/updateclient');?>" method="post">
	<input type="hidden" name="old_client_id" value="<?php echo $this->input->post('client_id');?>">
	<tr>
		<td><label>Asiakasnumero</label></td>
		<td><input type="number" name="client_id" value="<?php echo $this->input->post('client_id');?>"></td>
	</tr>
	<tr>
		<td><label>Etunimi</label></td>
		<td><input type="text" name="firstname" value="<?php echo $this->input->post('firstname');?>"></td>
	</tr>
	<tr>
		<td><label>Sukunimi</label></td>
		<td><input type="text" name="lastname" value="<?php echo $this->input->post('lastname');?>"></td>
	</tr>
	<tr>
		<td></td><td><input type="submit" name="send" value="Päivitä"></td>
	</tr>
</form>
</table>
</div>
