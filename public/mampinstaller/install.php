<?php

	//error_reporting(0);
	require_once __DIR__ . '/classes/utils.class.php';
	require_once __DIR__ . '/classes/installer.class.php';
	require_once __DIR__ . '/classes/exceptions.class.php';

	if(!file_exists((__DIR__ . '/conf_installer.php'))) {
		$cme = new ConfigurationMissingException();
		fwrite(STDERR, utils::formatExceptionResponse($cme));	
		exit($cme->code);
	}
	require_once 'conf_installer.php';
	
	if(!defined('MAMP_EXTRA_DOCUMENT_ROOT') or !defined('MAMP_EXTRA_SITE_PATH') or !defined('MAMP_EXTRA_INSTALLATION_HOST')) {
		$cme = new InstFolderNotDefinedException();
		fwrite(STDERR, utils::formatExceptionResponse($cme));	
		exit($cme->code);
	}
	
	$EXTRA_PACKAGE_FILE = __DIR__ . '/package.zip';
	if(!file_exists($EXTRA_PACKAGE_FILE)) {
		$cme = new PackageNotFoundException();	
		fwrite(STDERR, utils::formatExceptionResponse($cme));
		exit($cme->code);
	}
	
	$EXTRA_MANIFEST = __DIR__ . '/manifest.json';
	if(!file_exists($EXTRA_MANIFEST)) {
		$cme = new ManifestNotFoundException();	
		fwrite(STDERR, utils::formatExceptionResponse($cme));
		exit($cme->code);
	}
		
	try {
		
		$i = new installer();
		$i -> init($EXTRA_MANIFEST,$EXTRA_PACKAGE_FILE);
		$i -> executeFiles();

		fwrite(STDOUT, utils::formatResponse($i->getParameters()));
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
		fwrite(STDERR, utils::formatDefaultExceptionResponse($e));
		exit($e->code);
	}
	
		

?>