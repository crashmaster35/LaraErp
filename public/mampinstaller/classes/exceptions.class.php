<?php
 
 require_once 'defines.php';
 	
 	class MAMPException extends Exception{};
 
 
 	class GeneralException extends MAMPException {
		public $code = ERROR_UNKNOWN;
		public $description = 'An error occured. Please, check your setup and try again.';
	}
	
	class DbException extends MAMPException {
		public $code = ERROR_DB_CONNECTION;
		public $description = 'Database error occured. Please, check your databse parameters and try again.';
	}

	class FileNotWritableException extends MAMPException {
		public $code = ERROR_FILE_NOT_WRITABLE;
		public $description = 'The path is not writable.';
	}
	
	class PackageNotFoundException extends MAMPException {
		public $code = ERROR_PACKAGE_NOT_FOUND;
		public $description = 'The extra package file not found';
	}

	class InstFolderNotDefinedException extends MAMPException {
		public $code = ERROR_INST_FOLDER_NOT_DEFINED;
		public $description = 'Installation directory must be defined!';
	}

	class FileInsufficientParamsException extends MAMPException {
		public $code = ERROR_INSUFFICIENT_PARAMS;
		public $description = 'Extra installation parameters are insufficient. Please, check the installation parameters.';
	}

	class DbInsufficientParamsException extends MAMPException {
		public $code = ERROR_DB_INSUFFICIENT_PARAMS_CONNECTION;
		public $description = 'Database parameters are insufficient. Please, check the database parameters.';
	}

	class ConfigurationMissingException extends MAMPException {
		public $code = ERROR_CONF_MISSING;
		public $description = 'Config file is missing! Please insert the config file and restart the script.';
	}
	
	class InstFolderNotFoundException extends MAMPException {
		public $code = ERROR_INST_FOLDER_NOT_FOUND;
		public $description = 'Installation directory has not been found!';
	}
	
	class ManifestNotFoundException extends MAMPException {
		public $code = ERROR_MANIFEST_NOT_FOUND;
		public $description = 'The extra manifest file not found.';
	}
	
	class MissingParamValueException extends MAMPException {
		public $code = ERROR_MISSING_PARAM_VALUE;
		public $description = 'The value for parameter %s is missing.';
	}

	class ParamNotValidException extends MAMPException {
		public $code = ERROR_PARAM_NOT_VALID;
		public $description = 'The parameter is not valid. Please check if all mandatory elements are defined.';
	}

	class ParamConflictException extends MAMPException {
		public $code = ERROR_PARAM_CONFLICT;
		public $description = 'Some parameters are conflicting. Please, check the installation parameters.';
	}

	

?>