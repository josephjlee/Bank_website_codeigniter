<?php
$this->load->view('content/header');
$this->load->view($page);
echo $message.'<br>';
$this->load->view('content/footer');
?>
