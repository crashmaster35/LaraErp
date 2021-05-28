<?php


	//error_reporting(0);
	require_once __DIR__ . '/classes/utils.class.php';
	require_once __DIR__ . '/classes/installer.class.php';
	require_once __DIR__ . '/classes/exceptions.class.php';

	if(!file_exists((__DIR__ . '/conf_uninstaller.php'))) {
		$cme = new ConfigurationMissingException();
		fwrite(STDERR, utils::formatExceptionResponse($cme));	
		exit($cme->code);
	}
	require_once 'conf_uninstaller.php';
	
	if(!defined('MAMP_EXTRA_DOCUMENT_ROOT') or !isset($MAMP_EXTRA_SITE_FILES)) {
		$cme = new InstFolderNotDefinedException();
		fwrite(STDERR, utils::formatExceptionResponse($cme));	
		exit($cme->code);
	}
	if(!defined('MAMP_EXTRA_OPTION_REMOVE_FILES')) {
		$cme = new MissingParamValueException();
		$cme->description = sprintf($cme->description,'MAMP_EXTRA_OPTION_REMOVE_FILES');
		fwrite(STDERR, utils::formatExceptionResponse($cme));	
		exit($cme->code);
	}
	if(!defined('MAMP_EXTRA_OPTION_REMOVE_DATABASE')) {
		$cme = new MissingParamValueException();
		$cme->description = sprintf($cme->description,'MAMP_EXTRA_OPTION_REMOVE_FILES');
		fwrite(STDERR, utils::formatExceptionResponse($cme));	
		exit($cme->code);
	}
	
	try {
		
		/*
		 * disable install folder check
		 *  
		if(!is_dir($install_path)) {				
			throw new InstFolderNotFoundException();
		}
		 */

		//$remove_files = (isset($_REQUEST['extras']['MAMP_EXTRA_REMOVE_FILES']) && $_REQUEST['extras']['MAMP_EXTRA_REMOVE_FILES']=='on') ? true : false;
		//$remove_db = (isset($_REQUEST['extras']['MAMP_EXTRA_REMOVE_DB']) && $_REQUEST['extras']['MAMP_EXTRA_REMOVE_DB']=='on') ? true : false;
		
		
		if (MAMP_EXTRA_OPTION_REMOVE_DATABASE && defined('MAMP_EXTRA_DB_DATABASE')) {
			if (!defined('MAMP_EXTRA_DB_DATABASE') && !defined('MAMP_EXTRA_DB_HOST') || !defined('MAMP_EXTRA_DB_USERNAME') || !defined('MAMP_EXTRA_DB_PASSWORD')) {
				throw new DbInsufficientParamsException();
			}
			$_host = MAMP_EXTRA_DB_HOST;
			if (defined('MAMP_EXTRA_DB_PORT')) {
				$_host = $_host . ':' . MAMP_EXTRA_DB_PORT;
			}

			$db = new db();
			$db -> connect($_host, MAMP_EXTRA_DB_USERNAME, MAMP_EXTRA_DB_PASSWORD, MAMP_EXTRA_DB_DATABASE);
			if(defined('MAMP_EXTRA_DB_PREFIX')) {
				$tables = array();
				$other = false;
				if ($db -> query('SHOW TABLES;')>=0) {
					while($db -> next_row()) {
						$tn = $db -> getField(0);
						if(strpos($tn,MAMP_EXTRA_DB_PREFIX)===0) {
							$tables[] = $tn;
						} else {
							$other = true;
						}
					}					
				}

				foreach($tables as $key=>$value) {
					$db -> query('DROP TABLE `' . $value . '`;');
				}

				if (!$other) {
					// 	check if more tables are existing in the db. If not remove database
					$db -> query('DROP DATABASE `' . MAMP_EXTRA_DB_DATABASE . '`;');
				}				
			} else {
				$db -> query('DROP DATABASE `' . MAMP_EXTRA_DB_DATABASE . '`;');
			}

		}

		if (MAMP_EXTRA_OPTION_REMOVE_FILES) {
			if(!empty($MAMP_EXTRA_SITE_FILES) && is_array($MAMP_EXTRA_SITE_FILES)) {
				foreach($MAMP_EXTRA_SITE_FILES as $file) {
					if(!empty($file) && $file!='..' && $file!='.') {
						$path = MAMP_EXTRA_DOCUMENT_ROOT . '/' . $file;
						if(is_dir($path)) {
							utils::deleteDir($path);
						} else if(file_exists($path)) {
							unlink($path);
						}
					}
				}
			} 
		}

		exit(0);

	} catch (DbException $dbe) {
		fwrite(STDERR, utils::formatExceptionResponse($dbe));
		exit($dbe->code);
	} catch (DbInsufficientParamsException $dbe) {
		fwrite(STDERR, utils::formatExceptionResponse($dbe));
		exit($dbe->code);
	} catch (FileNotWritableException $fe) {
		fwrite(STDERR, utils::formatExceptionResponse($fe));
		exit($fe->code);
	} catch (PackageNotFoundException $pe) {
		fwrite(STDERR, utils::formatExceptionResponse($pe));
		exit($pe->code);
	} catch (MissingParamValueException $pe) {
		fwrite(STDERR, utils::formatExceptionResponse($pe));
		exit($pe->code);		
	} catch (Exception $e) {
		fwrite(STDERR, utils::formatExceptionResponse($e));
		exit($e->code);
	}

?>