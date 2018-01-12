<?php
	//error_reporting(E_ALL);
	//ini_set("display_errors", "1");
	require("masterInclude.inc.php");
	
	require_once FOLDER_MODEL_EXTEND . 'model.pago.inc.php';
	
	/* connect to gmail */
	$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
	$username = 'banco@aiidia.com';
	$password = '270785LfLx';
	
	/* try to connect */
	$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
	
	/* grab emails */
	$emails = imap_search($inbox,'UNSEEN');
	
	
	
	
	
	/* if emails are returned, cycle through each... */
	if($emails)
	{
			
		/* put the newest emails on top */
		rsort($emails);
	
		/* for every email... */
		foreach($emails as $email_number)
		{
	
			/* get information specific to this email */
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,"1");
				
				
				
			$campos=explode("\n",$message);
			print_r($campos);
			foreach($campos AS $k=>$linea)
			{
				$llaveValor=explode(":",$linea);
				//print_r($llaveValor);
	
	
				if($llaveValor[0]=="idTurno")
				{
					echo "[idTurno encontrado: (" . $llaveValor[1] . ")]";
					$Pago=new ModeloPago();
					
					if($Pago->existePago($llaveValor[1]))
					{
						echo "[Existe pago]";
						continue;
					}
					else
					{
					
						$Pago->getPagoPendienteByIdTurno($llaveValor[1]);
						
						if($Pago->getError())
						{
							die($Pago->getStrError());
						}
						
						if($Pago->getEstatus()!="pagado")
						{
							$Pago->setEstatusPagado();
							$Pago->setFechaPago(_NOW_);
							$Pago->Guardar();
							if($Pago->getError())
							{
								die($Pago->getStrError());
							}
							echo "[Registro pago]";
						}
					}
					
				}
			}
		}
	}
	
	/* close the connection */
	imap_close($inbox);
	
	echo "[FIN]";
	