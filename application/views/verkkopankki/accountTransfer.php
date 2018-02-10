<?php $this->load->view('content/accountLinks');?>
<h1>Maksut</h1>
<p>Valitse mihin tilinumeroon tahdot rahaa lähettää ja kuinka paljon. (huom. tililläsi pitää olla tarpeeksi katetta!)</p>

<form action="<?php echo site_url('verkkopankki/transfer');?>" method="post">
	<label for="tunnus">Tilitunnus</label><br>
	<input type="text" name="account_id" id="tunnus"><br>
	<label for="sum">Lähetettävä raha</label><br>
	<input type="number" name="balance" id="sum"><br>
	<input type="submit" name="send" value="Lähetä">
</form>
