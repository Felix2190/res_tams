<?php
if (isset($_POST['getKeyHuellas'])){
	require FOLDER_MODEL_EXTEND . 'model.biometrico.inc.php';
	$huellas= new ModeloBiometrico();
	echo json_encode($huellas->getKeyHuellas());
}
?>