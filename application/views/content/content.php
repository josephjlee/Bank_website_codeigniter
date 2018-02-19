<?php
$this->load->view('content/header');
$this->load->view($page);
echo '<p>'.$message.'</p>';
$this->load->view('content/footer');
?>
