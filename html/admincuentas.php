<?php
if (isset($_POST ['username'])) {
	echo verificarUserName($_POST['username']);
}

if (isset($_POST ['RFC'])) {
	echo valida_rfc($_POST['RFC']);
}

if (isset($_POST ['id_servicio'])) {
	$arrUsers = getUsers( $_POST ['id_servicio'], true);
	$combo='<option value="">Seleccione una opci&oacute;n</option>';
	foreach ( $arrUsers as $idUser => $nombre )
		$combo .= '<option value="' . $idUser . '" > ' . $nombre . ' </option>';
	echo $combo;
}

if (isset($_POST ['id_asignado'])) {
	$arrUsers = getUsersResponder( $_POST ['id_asignado'], true);
	$combo='<option value="">Seleccione una opci&oacute;n</option>';
	foreach ( $arrUsers as $idUser => $nombre )
		$combo .= '<option value="' . $idUser . '" > ' . $nombre . ' </option>';
	echo $combo;
}


function getAdministadorUser(){
	global $dbLink;
	
	$query = "SELECT id_usuario from login_user where id_rol=5 LIMIT 1";
	//	return $query;
	$result = mysqli_query ( $dbLink, $query );
	if ($result) {
		if (mysqli_num_rows ( $result ) == 1) {
			$row=mysqli_fetch_assoc($result);
			return $row['id_usuario'];
		}
	}
}

function getUsers($idSeccion,$ajax){
	if ($ajax)
		require ("masterIncludeLogin.inc.php");
	else	
		global $dbLink, $objSession;

	$query = "SELECT R.idRegisterTmp as id_usuario, concat_ws(' ', R.full_name, R.full_lastname) as nombre from registertmp as R
			JOIN ticket_tipo as T ON R.id_servicio=T.id_padre
			where idRegisterTmp<>".$objSession->getIdUser()." AND T.id_padre=".$idSeccion;
//	return $query;
	$result = mysqli_query ( $dbLink, $query );
	if ($result && mysqli_num_rows ( $result ) > 0) {
		$arrUsers = array ();
		while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
			$arrUsers [$row_inf ['id_usuario']] = utf8_encode($row_inf ['nombre']);
		}
	}
	return $arrUsers;
}

function getUsersResponder($idAsig,$ajax){
	if ($ajax)
		require ("masterIncludeLogin.inc.php");
		else
			global $dbLink;

			$query = "SELECT R.idRegisterTmp as id_usuario, concat_ws(' ', R.full_name, R.full_lastname) as nombre from registertmp as R
					join ticket_movimiento on id_origen=idRegisterTmp 
					where id_ticket=".$_SESSION['tid']." and  idRegisterTmp<>".$idAsig." group by id_usuario";
	//	return $query;
			$result = mysqli_query ( $dbLink, $query );
			if ($result && mysqli_num_rows ( $result ) > 0) {
				$arrUsers = array ();
				while ( $row_inf = mysqli_fetch_assoc ( $result ) ) {
					$arrUsers [$row_inf ['id_usuario']] = utf8_encode($row_inf ['nombre']);
				}
			}
			return $arrUsers;
}

function loginUser($infoUsuario) {
	global $dbLink;
	
	$query = "SELECT * from login_user WHERE user_name ='" . mysqli_real_escape_string ( $dbLink, $infoUsuario ['username'] ) . "' and estatus = 'activo' LIMIT 1";
//	return $query;
	$result = mysqli_query ( $dbLink, $query );
	if ($result) {
		if (mysqli_num_rows ( $result ) == 1) {
			$row = mysqli_fetch_assoc ( $result );
			
			$password = hash ( 'sha512', $infoUsuario ['password'] . $row ['salt'] );
			
			if ($row ['password'] == $password) {
			 // Inicio de sesión exitoso        
       
    $arreglo='';
		$resultado = mysqli_query ( $dbLink, "SELECT * FROM rol_permisos WHERE id_rol ='".$row['id_rol']."'" );
		while($row_inf=mysqli_fetch_assoc($resultado)){
      $arreglo[] = $row_inf;                                                    
    }          
    $_SESSION['rol_permisos'] = $arreglo;                              
				return array(true,array(              
						'id_login'=>$row['id_login'],
						'id_usuario'=>$row['id_usuario'],
            'user_name'=>($row['user_name']),
            'email'=>($row['email']),
            'estatus'=>($row['estatus']),                                                
						'first_name'=>($row['first_name']),
						'last_name'=>($row['last_name']),
						'id_rol'=>$row['id_rol'],
            'permisos'=>$arreglo,
            'idUbicacion'=>$row['id_recaudacion']
				));
			} else {
				// contraseña incorrecta
				return false;
			}
		} else {
			// El usuario no existe.
			return false;
		}
	} else {
		// die("[" . $query . "]" . mysqli_error($mysqli));
		return false;
	}
}


function loginUserInt($infoUsuario) {
	global $dbLink;

	$query = "SELECT id_login, id_usuario, first_name, last_name, id_rol, password, salt from login_user WHERE email ='" . mysqli_real_escape_string ( $dbLink, $infoUsuario ['username'] ) . "' and id_rol>3 LIMIT 1";
	//	return $query;
	$result = mysqli_query ( $dbLink, $query );
	if ($result) {
		if (mysqli_num_rows ( $result ) == 1) {
			$row = mysqli_fetch_assoc ( $result );
				
			//$password = hash ( 'sha512', $infoUsuario ['password'] . $row ['salt'] );
			//$row ['password'] == $password
			if (1==1) {
				$query2 = "SELECT full_name, full_lastname,empresaTxt,state,city,id_servicio,email,idAccount from registertmp WHERE idRegisterTmp =" . $row['id_usuario']. " LIMIT 1";
				//	return $query;
				$result2 = mysqli_query ( $dbLink, $query2 );
				if ($result2) {
					if (mysqli_num_rows ( $result2 ) == 1) {
						$row2 = mysqli_fetch_assoc ( $result2 );
						// Inicio de sesión exitoso
						return array(true,array(
								'id_login'=>$row['id_login'],
								'id_usuario'=>$row['id_usuario'],
								'first_name'=>utf8_encode($row2['full_name']),
								'last_name'=>utf8_encode($row2['full_lastname']),
								'id_rol'=>$row['id_rol'],
								'company_name'=>$row2['empresaTxt'],
								'city'=>$row2['city'],
								'email'=>$row2['email'],
								'account_id'=>$row2['idAccount'],
								'id_servicio'=>$row2['id_servicio']
						));
					}

				}
			 // Inicio de sesión exitoso
				return array(true,array(
						'id_login'=>$row['id_login'],
						'id_usuario'=>$row['id_usuario'],
						'first_name'=>utf8_encode($row['first_name']),
						'last_name'=>utf8_encode($row['last_name']),
						'id_rol'=>$row['id_rol'],
						'account_id'=>'0',
				));
			} else {
				// contraseña incorrecta
				return false;
			}
		} else {
			// El usuario no existe.
			return false;
		}
	} else {
		// die("[" . $query . "]" . mysqli_error($mysqli));
		return false;
	}
}

function verificarUserName($userName) 
{
	global $dbLink;
	$query = "SELECT * from login_user where user_name='" . $userName . "'";
	
	// return $query;
	$result = mysqli_query ( $dbLink, $query );
	if (!$result)
	{
		die("Error en la consulta de BD [admincuentas.php:208][" . $query . "][" . mysqli_error($dbLink) . "]");
	}
		if (mysqli_num_rows ( $result ) > 0)
			return false;

			require (FOLDER_MODEL_WS . "ws.class.AccountService.isUsernameExists.inc.php");
			$wsUserName = new DAccountServiceIsUsernameExists();
			$wsUserName->Param->setUserName($userName);
			$wsUserName->execute ();
			if ($wsUserName->getError ()) {
				return true;
			} else {
				$respuesta = $wsUserName->Response;
				return ($respuesta->getExists().'')=='0'?true:false;
			}

			return true;
}

function valida_rfc($valor){
	$valor = str_replace("-", "", $valor);
	$cuartoValor = substr($valor, 3, 1);
	//RFC sin homoclave
	if(strlen($valor)==10){
		$letras = substr($valor, 0, 4);
		$numeros = substr($valor, 4, 6);
		if (ctype_alpha($letras) && ctype_digit($numeros)) {
			return true;
		}
		return false;
	}
	// Sólo la homoclave
	else if (strlen($valor) == 3) {
		$homoclave = $valor;
		if(ctype_alnum($homoclave)){
			return true;
		}
		return false;
	}
	//RFC Persona Moral.
	else if (ctype_digit($cuartoValor) && strlen($valor) == 12) {
		$letras = substr($valor, 0, 3);
		$numeros = substr($valor, 3, 6);
		$homoclave = substr($valor, 9, 3);
		if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
			return true;
		}
		return false;
		//RFC Persona Física.
	} else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) {
		$letras = substr($valor, 0, 4);
		$numeros = substr($valor, 4, 6);
		$homoclave = substr($valor, 10, 3);
		if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
			return true;
		}
		return false;
	}else {
		return false;
	}
}//fin validaRFC


function crearUsuario($arrDatos){
	global $dbLink;

	$query = "SELECT idRegisterTmp from registertmp order by idRegisterTmp desc limit 1 ";
	
	$result = mysqli_query ( $dbLink, $query );
	$idRegis=0;
	if ($result){
		$row=mysqli_fetch_assoc($result);
		$idRegis=intval($row['idRegisterTmp'])+1;
	}
	$password=substr( md5(microtime()), 1, 8);
	$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
	$passwordSalt = hash('sha512', $password. $random_salt);
	$query='INSERT INTO registertmp values(NULL,"'.$arrDatos["Cnombre"].'","'.$arrDatos["Capaterno"].' '.$arrDatos["Camaterno"].'","'.$arrDatos["Fempresa"].'",
			"'.$arrDatos["Ctelefono"].'","'.$arrDatos["Cpais"].'","'.$arrDatos["CestadoN"].'","'.$arrDatos["Cciudad"].'","'.$arrDatos["Ccalle"].' Num. '.$arrDatos["Cnumext"].'"
					,"'.$arrDatos["Ccodigo"].'",1,"'.$arrDatos["Fnombre"].' '.$arrDatos["Fapaterno"].' '.$arrDatos["Famaterno"].'","'.$arrDatos["Fcorreo"].'","'.$arrDatos["Ftelefono"].'"
							,"'.$arrDatos["Fcalle"].' Num. '.$arrDatos["Fnumext"].'","'.$arrDatos["Ccodigo"].'","'.$arrDatos["Fpais"].'","'.$arrDatos["FestadoN"].'"
			,"'.$arrDatos["Fciudad"].'","VATFISCAL","'.$arrDatos["UserName"].'","'.$password.'","en","en", " ",0,0,"'.date("Y-m-d H:i:s").'","pendiente"," ","'.$arrDatos["Ccorreo"].'",0,"pendiente","trial","'.$arrDatos["account_id"].'",'.$arrDatos["id_rol"].')';
	if (mysqli_query($dbLink, $query)){
		$idRegis = mysqli_insert_id ($dbLink);
		$sql="INSERT INTO login_user values(null, ".$idRegis.", '".$arrDatos['UserName']."', '".$passwordSalt."', '".$random_salt."', '".$arrDatos['Cnombre']."', '".$arrDatos['Capaterno'].' '.$arrDatos['Camaterno']."',0)";
		if (mysqli_query ( $dbLink, $sql )){
			if ($arrDatos['account_id']==''){
				require(FOLDER_MODEL_WS . "ws.class.AccountService.create.inc.php");
				$WScrea= new DAccountServiceCreate();
				$WScrea->Param->setType(2);
				$WScrea->Param->setTaxable(0);
				$WScrea->Param->setStatus(1);
				$WScrea->Param->setPassword($password);
				$WScrea->Param->setFirstName($arrDatos['Cnombre']);
				$WScrea->Param->setCity($arrDatos['Cciudad']);
				$WScrea->Param->setLastName($arrDatos['Capaterno'].$arrDatos['Camaterno']);
				$WScrea->Param->setUserName($arrDatos['UserName']);
				$WScrea->Param->setEmail($arrDatos['Ccorreo']);
				$WScrea->Param->setCompanyName($arrDatos['Fempresa']);
				$WScrea->Param->setPlanId($arrDatos['Fplan']);
				$WScrea->Param->setPlanType(2);
				$WScrea->Param->setAddress($arrDatos['Ccalle'].' Num. '.$arrDatos["Cnumext"]);
				$WScrea->Param->setPhone($arrDatos['Ctelefono']);
				$WScrea->Param->setCountryId($arrDatos['Cpais']);
				$WScrea->Param->setStateId($arrDatos['Cestado']);
				$WScrea->Param->setZip($arrDatos['Ccodigo']);
				$WScrea->Param->setBillAddress($arrDatos['Fcalle'].' Num. '.$arrDatos["Fnumext"]);
				$WScrea->Param->setBillCity($arrDatos['Fciudad']);
				$WScrea->Param->setBillCountryId($arrDatos['Fpais']);
				$WScrea->Param->setBillStateId($arrDatos['Fciudad']);
				$WScrea->Param->setBillCountry($arrDatos['FpaisN']);
				$WScrea->Param->setBillState($arrDatos['FciudadN']);
				$WScrea->Param->setBillZip($arrDatos['Fcodigo']);
				$WScrea->Param->setBillEmail($arrDatos['Fcorreo']);
				$WScrea->Param->setBillFirstName($arrDatos['Fnombre']);
				$WScrea->Param->setBillLastName($arrDatos['Fapaterno'].$arrDatos['Famaterno']);
				$WScrea->Param->setBillPhone($arrDatos['Ftelefono']);
				$WScrea->execute();
					
				if ($WScrea->getError()){
					return array(false,$WScrea->_salidaHTML);
				}else {
					return array(true,'');
				}
			}else {
				return array(true,'');
			}
		}
	}
	return false;
}

?>