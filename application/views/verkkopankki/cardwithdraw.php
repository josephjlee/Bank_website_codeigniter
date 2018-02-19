<?php $this->load->view('content/cardLinks');?>
<h1>Nosto</h1>
<p>Valitse valikosta nostettava summa tai syötä oma summasi alla olevaan laatikkoon ja paina nosta nappia</p>
<div class="inlineTable2">	
<form action="<?php echo site_url('verkkopankki/cardtransfer');?>" method="post" id="withdrawForm">
		<label>Nosto summa</label><br>
		<select name="balance" form="withdrawForm">
			<option value="10">10 Euroa</option>
			<option value="25">25 Euroa</option>
			<option value="50">50 Euroa</option>
			<option value="100">100 Euroa</option>
			<option value="250">250 Euroa</option>
		</select><br>
		<input type="submit" value="Nosta">
</form>
<form action="<?php echo site_url('verkkopankki/cardtransfer');?>" method="post" id="withdrawForm2">
		<p><i>Tai nosta haluttu summa.</i></p>
		<label>Tarkka nosto summa</label><br>
		<input type="number" name="customBalance"><br>
		<input type="submit" value="Nosta">
	</form>
</div>
