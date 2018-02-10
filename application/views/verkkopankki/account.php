<?php $this->load->view('content/accountLinks');?>
<article>
<?php 
foreach ($account as $user) {
	echo '<h1>Tervetuloa '.$user['firstname'].' '.$user['lastname'].'</h1>';
	echo '<h2>Tilitiedot</h2><p>Tilitunnus: '.$user['account_id'].'<br></p>';
	echo '<h2>Saldo</h2><p>€: '.$user['balance'].'</p>';
}?>
</article>

