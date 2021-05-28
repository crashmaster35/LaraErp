<?php

require_once 'defines.php';

class db {

	var $LinkID;
	// Referenz zur Datenbank
	var $QueryID;
	// Referenz zum Resultat der letzten Abfrage
	var $Recordset;
	// eine Zeile des Resultats
	var $Errno;
	// Nummer eventueller Fehlermeldung
	var $Error;
	// Fehlertext

	function db() {

	}

	function connect($host, $user, $pass, $database = null, $charset = DB_DEFAULT_CHARSET, $createdb = false) {

		if ($this -> LinkID == 0) {
			$this -> LinkID = mysql_connect($host, $user, $pass);
			if (!$this -> LinkID) {
				$this -> logError();
				throw new DbException('Db: connect failed.');
			}

			$cs = (($charset != null) and strlen($charset) > 0) ? $charset : DB_DEFAULT_CHARSET;
			@mysql_set_charset($cs, $this -> LinkID);

			if ($database != null) {
				// try to select/create database
				if ($this -> selectDb($database) == 0 && $createdb) {

					$_create_sql = 'CREATE DATABASE ' . $database . ' DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci';
					if (!@mysql_query($_create_sql, $this -> LinkID)) {
						if ($this -> hasError())
							$this -> logError();
						throw new DbException('Error creating database ' . $database . ' - ' . mysql_error());
					}

					if ($this -> selectDb($database) == 0) {
						$this -> logError();
						throw new DbException('Unable to connect to the database ' . $database);
					}
				}
			}
		}

		return $this -> LinkID;

	}

	function close() {
		if ($this -> LinkID) {
			@mysql_close($this -> LinkID);
			$this -> LinkID = null;
		}
	}

	function selectDb($database) {

		if ($this -> LinkID != 0) {
			if (!@mysql_select_db($database, $this -> LinkID)) {
				$this -> logError();
				return 0;
			}
		}
		return $this -> LinkID;
	}

	function select($query) {
		return $this -> query($query);
	}

	function insert($query) {
		return $this -> query($query);
	}

	function query($query) {

		if (empty($query)) {
			return 0;
		}
		$this -> QueryID = mysql_query($query, $this -> LinkID);

		if (!$this -> QueryID && (stristr('alter table', $query) || stristr('drop table', $query))) {
			@mysql_query('FLUSH TABLES', $this -> LinkID);
			$this -> QueryID = @mysql_query($query, $this -> LinkID);
		}

		$this -> Errno = mysql_errno($this -> LinkID);
		$this -> Error = mysql_error($this -> LinkID);

		return $this -> hasError() ? 0 - $this -> Errno : 1;
	}

	function next_row() {
		if (empty($this -> QueryID)) {
			error_log('Extra -> db.class: no query pending');
			return 0;
		}
		$this -> Recordset = mysql_fetch_array($this -> QueryID);
		$this -> Errno = mysql_errno($this -> LinkID);
		$this -> Error = mysql_error($this -> LinkID);

		return is_array($this -> Recordset);

	}

	function getField($name) {
		return $this -> Recordset[$name];
	}

	function getRow() {
		return $this -> Recordset;
	}

	function hasError() {
		return ($this -> Errno != 0);
	}

	function getLastId() {
		return mysql_insert_id();
	}

	function getRowNum() {
		return @mysql_num_rows($this -> QueryID);
	}

	function logError() {
		$this -> Errno = mysql_errno();
		$this -> Error = mysql_error();
		error_log('Extra -> db.class: ' . $this -> Errno . ': ' . $this -> Error);
	}

	function getLastQueryInfo() {
		return array('affected_rows_count' => @mysql_affected_rows($this -> LinkID), 'error_code' => mysql_errno($this -> LinkID), 'error_desc' => mysql_error($this -> LinkID));
	}

}
?>