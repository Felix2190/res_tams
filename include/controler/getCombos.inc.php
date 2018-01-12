<?php
if (isset($_POST ['arrPaises'])){
	echo obtenerSelect(obtenerPaises(),$_POST ['arrPaises']);
}

if (isset($_POST ['arrPlan'])){
	echo obtenerSelect(obtenerPlans(),$_POST ['arrPlan']);
}

if (isset($_POST ['arrRutas'])){
	echo obtenerSelect(obtenerRouters(),$_POST ['arrRutas']);
}

if (isset($_POST ['arrEstatus'])){
	echo obtenerSelect(obtenerEstatus(),$_POST ['arrEstatus']);
}

if (isset($_POST ['arrIdioma'])){
	echo obtenerSelect(obtenerLenguajes(),$_POST ['arrIdioma']);
}

if (isset($_POST ['idPais'])){
	echo obtenerSelect(obtenerEstados(),'');
}
if (isset($_POST ['CP'])){ 
	$CP=$_POST['CP'];
	echo obtenerColoniasByCP($CP);
//	echo obtenerSelect($arr);
}
if (isset($_POST ['moneda'])){
	$moneda=$_POST['moneda'];
	echo json_encode(obtenerMoneda($moneda));
}

if (isset($_POST ['idEst'])){
	$idEst=$_POST['idEst'];
	if (isset($_POST ['idMun'])){
		$idMun=$_POST['idMun'];
		$arr=obtenerColonias($idEst, $idMun);
		echo obtenerSelect($arr,'');
	}else {
	$arr=obtenerMunicipios($idEst);
	echo obtenerSelect($arr,'');
	}
}

if (isset($_POST ['nombre'])){
	
	switch ( $_POST ['nombre'] ) {
		case 'est' :
			$query = "SELECT NOM_ENT FROM inegidomgeo_cat_estado WHERE cve_ent='" . $_POST ['idE'] . "'";
			$dato = 'NOM_ENT';
			break;
		case 'mun' :
			$query = "SELECT NOM_MUN FROM inegidomgeo_cat_municipio WHERE cve_ent='" . $_POST ['idE'] . "' and cve_mun='" . $_POST ['idM'] . "'";
			$dato = 'NOM_MUN';
			break;
		case 'col' :
			$query = "SELECT d_asenta FROM postales WHERE idPostal=" . $_POST ['idP'] . " ";
			$dato = 'd_asenta';
			break;
	}

	echo obtenerNombre($query, $dato);
	
}

if (isset($_POST ['getDatos'])){
	echo obtenerDatosAccount();
}

function obtenerNombre($query, $dato){
//	echo $query;
	global $dbLink;
	$result = mysqli_query ( $dbLink, $query );
	$retorno = '';
	if (! $result)
		return  $retorno;
	else 
	if ($row = mysqli_fetch_assoc ( $result ))
		return utf8_encode($row[$dato]);
	else 
	return '';
}

function obtenerPaises(){
	require FOLDER_MODEL_WS . "ws.class.NomenclatureGetCountries.inc.php";
/*	$etiq=array('Name','Table','CountryCode','Currency','CurrencyCode','<NewDataSet>');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,
			'http://www.webservicex.net/country.asmx/GetCurrencyCode'
			);
	$content = curl_exec($ch);
	$conten=str_replace('/Table', '&&&', substr($content,40));
	$conten=explode('&&&', $conten);
	$conten[0]='j';
	$ArrPaises=array(''=>'Selecciona una opci&oacute;n');
	for ($i=1;$i<count($conten)-1;$i++){
		$conten[$i]=substr(str_replace($etiq, '', $conten[$i]),30);
		$conten[$i]=explode('/', $conten[$i]);
		$conten[$i][0]=substr($conten[$i][0], 0, count($conten[$i][0])-5);
		$conten[$i][1]=substr($conten[$i][1], 18, count($conten[$i][1])-5);
		$ArrPaises[strtoupper($conten[$i][1])]=$conten[$i][0];
	}*/
	$ArrPaises=array(''=>'Selecciona una opci&oacute;n');
	$wscountries= new DNomenclatureGetCountries();
	$wscountries->execute();
	if ($wscountries->getError()){
		return $ArrPaises;
	}else {
		$arrCountries=$wscountries->Response;
		foreach ($arrCountries->getCountries() as $campo=>$pais)
			$ArrPaises[$pais['id']]=$pais['name'];
	}
	 
	return $ArrPaises;
}

function obtenerSelect($arr,$select){
	$combo='';
	foreach ($arr as $id=>$item)
		$combo.= '<option value="'.$id.'" '.($id==$select?'selected ':'').'>'.$item.'</option>';
	return $combo;
}

function obtenerEstados(){
	global $dbLink;
	$query = "SELECT CVE_ENT,NOM_ENT FROM inegidomgeo_cat_estado ORDER BY NOM_ENT ASC";
	$result = mysqli_query($dbLink,$query);
	$retorno = array(''=>'Selecciona una opci&oacute;n');
	if (! $result)
		return $retorno;
	while ($row = mysqli_fetch_assoc($result))
		$retorno[$row['CVE_ENT']] =utf8_encode( $row['NOM_ENT']);
	return $retorno;
}

function obtenerMunicipios($idEst){
	global $dbLink;
	$query = "SELECT CVE_MUN,NOM_MUN FROM inegidomgeo_cat_municipio WHERE cve_ent='" . $idEst . "' ORDER BY NOM_MUN ASC";
	$result = mysqli_query($dbLink,$query);
	$retorno = array(''=>'Selecciona una opci&oacute;n');
	if (! $result)
		return $retorno;
	while ($row = mysqli_fetch_assoc($result))
		$retorno[$row['CVE_MUN']] =utf8_encode( $row['NOM_MUN']);
	return $retorno;	
}

function obtenerColonias($idEst, $idMun){
	global $dbLink;
	$query="SELECT DISTINCT d_asenta, d_codigo, idPostal FROM postales WHERE c_estado='" . $idEst . "' AND c_mnpio='" . $idMun . "' ORDER BY d_asenta ASC";
	$result = mysqli_query($dbLink,$query);
	$retorno = array(''=>'Selecciona una opci&oacute;n');
	if (! $result)
		return $retorno;
	while ($row = mysqli_fetch_assoc($result))
		$retorno[$row['idPostal'].'_'.$row['d_codigo']] =utf8_encode( $row['d_asenta']);
	return $retorno;
}

function obtenerColoniasByCP($CP){
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	global $dbLink;
	$query="SELECT  d_asenta, d_codigo, c_estado, D_mnpio, c_mnpio, idPostal, NOM_ENT, NOM_MUN FROM postales
			JOIN inegidomgeo_cat_estado AS E ON E.cve_ent=c_estado 
			JOIN inegidomgeo_cat_municipio AS M ON M.cve_ent=c_estado and M.cve_mun=c_mnpio	
			WHERE d_codigo='" . $CP . "' ";
	$result = mysqli_query($dbLink,$query);
	$retorno = array(''=>'');
	if (! $result)
		return $retorno;
	return  json_encode(mysqli_fetch_assoc($result));
			//$retorno[$row['idPostal'].'_'.$row['d_codigo']] =utf8_encode( $row['d_asenta']);
	//$retorno[$row['idPostal'].'_'.$row['d_codigo']] =utf8_encode( $row['d_asenta']);
}

function obtenerPlans(){
	require(FOLDER_MODEL_WS . "ws.class.PlanGetPlans.inc.php");
	$retorno = array(''=>'Selecciona una opci&oacute;n');
	$wsPlan = new DPlanGetPlans();
	$wsPlan->execute();
	if ($wsPlan->getError()){
		return $retorno;
	}else {
		$arrPlans=$wsPlan->Response;
		foreach ($arrPlans->getPlanList() as $campo=>$plan)
			$retorno[$plan['PlanId']]=$plan['Name'];
	}
	return $retorno;
}

function obtenerRouters(){
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require(FOLDER_MODEL_WS . "ws.class.Route.getList.inc.php");
	$retorno = array(''=>'Selecciona una opci&oacute;n');
	
	$wsPlan = new DRouteSetServiceGetList();
	$wsPlan->execute();
	if ($wsPlan->getError()){
		echo $wsPlan->getStrError();
	}else {
		$arrPlans=$wsPlan->Response;
		foreach ($arrPlans as $campo=>$plan)
			foreach ($plan as $c=>$v)
				$retorno[$v['RouteSetId']]=$v['RouteSetname'];
	}
	return $retorno;
	
}

function obtenerMoneda($PlanId){
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require(FOLDER_MODEL_WS . "ws.class.PlanGetDetailsByIdPlan.inc.php");
	$retorno = array();
	
	$wsPlan = new DPlanGetDetailsByIdPlan();
	$wsPlan->Param->setPlanId($PlanId);
	
	$wsPlan->execute();
	if ($wsPlan->getError()){
		return  $retorno;
	}else {
		$arrPlans=$wsPlan->Response;
		foreach ($arrPlans as $campo=>$plan){
		$retorno['id']=$plan['CurrencyId'];
		$retorno['name']=$plan['CurrencyName'];
		$retorno['simbolo']=$plan['CurrencySymbol'];
		}
	}
	return ($retorno);
}

function obtenerEstatus(){
	 return array(''=>'Selecciona una opci&oacute;n',1=>'Activo',2=>'Inactivo',3=>'Bloqueado');
	
}

function obtenerLenguajes(){
	require(FOLDER_MODEL_WS . "ws.class.NomenclatureGetCRMLanguages.inc.php");
	$retorno = array(''=>'Selecciona una opci&oacute;n');
	
	$wsIdioma = new DNomenclatureGetCRMLanguages();
	
	$wsIdioma->execute();
	if ($wsIdioma->getError()){
		return  $retorno;
	}else {
		$arrIdiomas=$wsIdioma->Response;
		foreach ($arrIdiomas as $campo=>$idioma)
			$retorno[$idioma['language_id']]=$idioma['language_name'];
	}
	return $retorno;
}

function obtenerDatosAccount(){
	require_once FOLDER_MODEL_WS . "ws.class.Plan.getAccountPlan.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.Route.getRouteByAccount.inc.php";
	require_once FOLDER_MODEL_WS . "ws.class.AccountService.getAccountCRMLanguage.inc.php";
	global $objSession;
	$arrDatos=array();
	
	$wsPlan = new DPlanGetAccountPlan();
	$wsPlan->Param->setAccountId($objSession->getAccountId());
	$wsPlan->execute();
	$arrPlan=$wsPlan->Response->PlanDetails;

	$arrDatos['PlanId']=$arrPlan['PlanId'];
	$arrDatos['PlanName']=$arrPlan['Name'];
	
	$wsRoute=new DRouteServiceGetAccountRoute();
	$wsRoute->Param->setAccountId($objSession->getAccountId());
	$wsRoute->execute();
	$arrRoute=$wsRoute->Response;
	
	$arrDatos['RouteId']=$arrRoute->getRouteSetId();

	$wsLanguage=new DAccountCRMLanguage();
	$wsLanguage->Param->setAccountId($objSession->getAccountId());
	$wsLanguage->execute();
	$arrLanguage=$wsLanguage->Response->getLanguage();
	
	$arrDatos['language_id']=$arrLanguage['language_id'];
	
	return json_encode($arrDatos);
}
?>