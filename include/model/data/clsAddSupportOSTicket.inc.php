<?php

	require_once FOLDER_MODEL_DATA . "clsBasicCommon.inc.php";
	require OSTICKET_CLASS_PASS;

	if(!defined("DBTYPE"))
	{
		# Encrypt/Decrypt secret key - randomly generated during installation.
		#define('SECRET_SALT','LOjRi375HizCT5JghE.0tGWs-iAEAI74');

		#Default admin email. Used only on db connection issues and related alerts.
		#define('ADMIN_EMAIL','rajesh@damaka.net');

		#Mysql Login info
		
		define('DBTYPE','mysql');
		define('DBHOST','localhost');
		define('DBNAME','osticket');
		define('DBUSER','osticketuser');
		define('DBPASS','osTicketU53r');
	}


	class AddSupportSOTickect extends clsBasicCommon
	{
		#-------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades----------------------------------------------#
		#-------------------------------------------------------------------------------------------------------#

		var $_link;

		var $Name;
		var $UserName;
		var $Pass;
		var $Email;


		#-------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Constructor----------------------------------------------#
		#-------------------------------------------------------------------------------------------------------#

		public function __construct()
		{
			$this->_link=mysql_connect(DBHOST,DBUSER,DBPASS);
			if(!$this->_link)
				return $this->setError("Error connection to DB");
			if(!mysql_select_db(DBNAME))
				return $this->setError("Error selecting DB");
		}



		#-------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setters------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------#

		public function setName($Name)
		{
			$this->Name=$Name;
		}

		public function setUserName($UserName)
		{
			$this->UserName=$UserName;
		}

		public function setPass($Pass)
		{
			$this->Pass=$Pass;
		}

		public function setEmail($Email)
		{
			$this->Email=$Email;
		}




		#-------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getters------------------------------------------------#
		#-------------------------------------------------------------------------------------------------------#






		#-------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Acciones-----------------------------------------------#
		#-------------------------------------------------------------------------------------------------------#
		
		public function existUserName()
		{
			$SQL="SELECT count(*) AS cuenta FROM ost_user_account WHERE username='" . $this->UserName . "'";
			$record=mysql_query($SQL,$this->_link);
			if(!$record)
				return $this->setError(mysql_error($this->_link));
			$row=mysql_fetch_assoc($record);
			return $row['cuenta']>0;
			
		}

		public function exec()
		{
			if(!mysql_query("START TRANSACTION",$this->_link))
				return $this->setError(mysql_error($this->_link));

			$time=date("Y-m-d H:i:s");

			$SQL="INSERT INTO ost_user (org_id, status, name, created, updated)
					VALUES(0,0,'" . $this->Name . "','" . $time . "','" . $time . "')";

			$record=mysql_query($SQL,$this->_link);
			if(!$record)
				return $this->setError(mysql_error($this->_link));
			$id=mysql_insert_id($this->_link);

			$pass=new Passwd();
			$strPass=$pass->hash($this->Pass);


			$SQL="INSERT INTO ost_user_account (user_id, status, timezone_id, dst, username, passwd, registered)
					VALUES(" . $id . ",1,7,1,'" . $this->UserName . "','" . $strPass . "','" . $time . "')";


			if(!mysql_query($SQL,$this->_link))
				return $this->setError(mysql_error($this->_link));

			$SQL="INSERT INTO ost_user_email (user_id, address)
					VALUES(" . $id . ",'" . $this->Email . "')";
			if(!mysql_query($SQL,$this->_link))
				return $this->setError(mysql_error($this->_link));
			$idEmail=mysql_insert_id();

			$SQL="UPDATE ost_user SET default_email_id=" . $idEmail . " WHERE id=" . $id;
			if(!mysql_query($SQL,$this->_link))
				return $this->setError(mysql_error($this->_link));

			if(!mysql_query("COMMIT",$this->_link))
				return $this->setError(mysql_error($this->_link));

			return true;
		}
	}