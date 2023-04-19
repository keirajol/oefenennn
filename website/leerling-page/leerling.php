
<html>
<a href="../logout/logout.php">uitloggen</a>
<?php 
session_start();
if (isset($_SESSION['username'])) {?>
<div class="email"><?php echo $_SESSION['username']; ?></div><?php } ?>
 </html>
 <?php 


include '../lessen-toevoegen-printen/lessen-print.php';
?>