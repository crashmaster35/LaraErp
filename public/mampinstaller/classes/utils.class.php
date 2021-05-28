<?php

class utils {

	static function createExtra($extraname, $direcory) {
		try {
			$tarphar = new Phar($extraname . '.phar');
			$zip = $tarphar -> convertToData(Phar::ZIP);
			$zip -> buildFromDirectory($direcory);
		} catch (Exception $e) {
			print $e;
		}
	}
	
	
	static function getLocalizedString($name) {		
		return $GLOBALS['MAMP_LOCALISATION'][$name];
	}



	static function isEmailValid($email) {
		#RFC 2822
		$regEx = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/';
		//$regEx = '/[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/';
		return (preg_match($regEx, $email));
	} 

	static function isFolderNameValid($name) {
		return !preg_match('/[^a-zA-Z0-9._-]/',$name);
	}
	
	static function formatJS($jsBody) {
		return sprintf('<script type="text/javascript">%s</script>',$jsBody);
	}
	
	
	static function deleteDir($dir) {

		$it = new RecursiveDirectoryIterator($dir);
		$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
		foreach ($files as $file) {
			if ($file -> getFilename() === '.' || $file -> getFilename() === '..') {
				continue;
			}
			if ($file -> isDir()) {
				rmdir($file -> getRealPath());
			} else {
				unlink($file -> getRealPath());
			}
		}
		rmdir($dir);

	}
	
	static function formatExceptionResponse(MAMPException $exception) {
		return sprintf('{"code": %d,"description": "%s"}',$exception->code,$exception->description);
	}


	static function formatDefaultExceptionResponse(Exception $exception) {
		return sprintf('{"code": %d,"description": "%s"}',ERROR_UNKNOWN,$exception->getMessage());
	}
	
	static function formatResponse($parameters) {
		
		if(isset($parameters['MAMP_EXTRA_DB_NAME'])) {
			if(isset($parameters['MAMP_EXTRA_DB_PREFIX'])) {
				return sprintf('{"code": 0,"description": "Success","path" : %s, "database" : "%s", "table_prefix" : "%s"}',json_encode($parameters['MAMP_EXTRA_SITE_FILES']->value), $parameters['MAMP_EXTRA_DB_NAME']->value, $parameters['MAMP_EXTRA_DB_PREFIX']->value);
			} else {
				return sprintf('{"code": 0,"description": "Success","path" : %s, "database" : "%s"}',json_encode($parameters['MAMP_EXTRA_SITE_FILES']->value),$parameters['MAMP_EXTRA_DB_NAME']->value);
			}	
		} else {
			return sprintf('{"code": 0,"description": "Success","path" : %s}', json_encode($parameters['MAMP_EXTRA_SITE_FILES']->value));
		}
	}
	
}
?>