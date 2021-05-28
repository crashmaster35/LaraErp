<?php

require_once 'exceptions.class.php';
require_once 'parameter.class.php';
require_once 'db.class.php';

class installer {

	
	private $mParameters;
	private $mFiles;
	private $mDbFiles;
	private $mActions;
	private $mName;
	private $mVersion;	
	private $mAuthor;
	private $mPackager;

	private $mStartPage;

	private $mInstallPackage;
	private $mInstallFileSource;
	private $mInstallDbFileSource;
	
	private $mInstallDir;
	private $mSiteFiles;
	private $mNeedsOwnFolder;

	function __construct() {

		$mParameters = array();
		$mFiles = array();
		$_actions = array();

	}
	
	function init($manifest, $package) {
		
			$this->mInstallPackage = 'phar://' . $package;
			$this->mInstallFileSource = $this->mInstallPackage . '/contents/files';
			$this->mInstallDbFileSource = $this->mInstallPackage . '/contents/db';

			// add mandatory parameters
			$p = new parameter('MAMP_EXTRA_DOCUMENT_ROOT', PARAM_TYPE_TEXT);
			$p->value = MAMP_EXTRA_DOCUMENT_ROOT;
			$this->mParameters['MAMP_EXTRA_DOCUMENT_ROOT'] = $p;
			
			$p = new parameter('MAMP_EXTRA_INSTALLATION_HOST', PARAM_TYPE_TEXT);
			$p->value = MAMP_EXTRA_INSTALLATION_HOST;
			$this->mParameters['MAMP_EXTRA_INSTALLATION_HOST'] = $p;

			if(file_exists($manifest)) {
	       		$str_data = file_get_contents($manifest);
		   		$data = json_decode($str_data,true);
				$allDefines = get_defined_constants(true);
				$paramValues = $allDefines['user'];
				foreach ($data as $key => $value) {
					if($key=='parameters') {
						//$param_keys = array_keys($value);
						foreach ($value as $param) {
							$param_key = isset($param['name']) ? $param['name'] : '';
							if(!empty($param_key)) {
								if(defined($param_key)) {
									$p = new parameter($param_key, PARAM_TYPE_TEXT);
									$p->setup($param);
									$p->value = $paramValues[$param_key];
									$this->mParameters[$param_key] = $p;
	
								} else {
									$e = new MissingParamValueException();
									$e->description = sprintf($e->description,$param_key);
									throw $e;
								}
							} else {
								$e = new MissingParamValueException();
								$e->description = sprintf($e->description,$param_key);
								throw $e;
							}
						}
					} else if($key=='contents') {
						if(isset($value['files'])) {
							$this->mFiles = $value['files'];
						}
						if(isset($value['db'])) {
							$this->mDbFiles = $value['db'];
						}
					} else if($key=='actions') {
						$this->mActions = $value;
					} else if($key=='name') {
						$this->mName = $value;
					} else if($key=='version') {
						$this->mVersion = $value;
					} else if($key=='author') {
						$this->mAuthor = $value;
					} else if($key=='packager') {
						$this->mPackager = $value;
					} else if($key=='start_page') {
						$this->mStartPage = $value;
					} else if($key=='needs_own_folder') {
						$this->mNeedsOwnFolder = $value;
					}
					
					
				}
			} else {
				throw new ManifestNotFoundException();
			}
			
			$sitePath = $this->getParameter('MAMP_EXTRA_SITE_PATH');

			if(isset($sitePath)) {
				$_folderName = $sitePath->value;
				if(isset($_folderName))  {
					if(strlen($_folderName)==0) {
						if($this->mNeedsOwnFolder) {
							throw new ParamConflictException();
						}
						$this->mInstallDir = MAMP_EXTRA_DOCUMENT_ROOT;
					} else {
						$pos = strpos($_folderName,'/');
						if($pos===FALSE or $pos!=0) {
							$_folderName = '/' . $_folderName;
						}				
						$this->mInstallDir = MAMP_EXTRA_DOCUMENT_ROOT . $_folderName;
					}
				}
			}

			if(!isset($this->mInstallDir)) {
				throw new InstFolderNotDefinedException();
			} 
		
   }

	function executeFiles() {
		// copy files only if the install directory has been defined
		if(isset($this->mInstallDir) && strlen($this->mInstallDir)>0){
			if(!is_dir($this->mInstallDir)) {
				mkdir($this->mInstallDir,0777,true);
			}

			$this->mSiteFiles = array();	

			$sitePath = $this->getParameter('MAMP_EXTRA_SITE_PATH');
			if(!empty($sitePath->value)) {
				array_push($this->mSiteFiles,$sitePath->value);
			}

			$this->processDir($this->mInstallFileSource);
		}
		
		if(isset($this->mDbFiles)){
			// only process db files for CMSs that need it.
			if(defined('MAMP_EXTRA_DB_NAME')) { 
				$this->processDbFiles();
			}
		}
		
		//setup files parameter
		$p = new parameter('MAMP_EXTRA_SITE_FILES', PARAM_TYPE_ARRAY);
		$p->value = $this->mSiteFiles;
		$this->mParameters['MAMP_EXTRA_SITE_FILES'] = $p;
		
	}
	
	function processDir($dirStr) {
		
		// copy all files and check if the file should be parsed
		$dir = new DirectoryIterator($dirStr);
		
		$isRootInstall = $this->mInstallDir == MAMP_EXTRA_DOCUMENT_ROOT;
		$isFirstLevel = false;

		if($dirStr!=$this->mInstallFileSource){
			// In the case of the recursion, the dirStr != mInstallDir
			$_target_dir = $this->mInstallDir  . str_replace($this->mInstallFileSource, '', $dirStr);
			if(!file_exists($_target_dir)) mkdir($_target_dir);	
		} else {
			$_target_dir = $this->mInstallDir; 
			$isFirstLevel = $isRootInstall && true;
		}

		$_target_dir .= '/'; 

		foreach ($dir as $fileinfo) {
			if($isFirstLevel) {
    			$this->mSiteFiles[] = $fileinfo->getBasename();
    		}
    		if ($fileinfo->isFile()) {
    			$_target = $_target_dir . $fileinfo->getBasename();
        		if(isset($this->mFiles) && in_array($fileinfo->getBasename(),$this->mFiles)) {
        			$_content = file_get_contents($fileinfo->getPathname());
					$_content = $this->processContent($_content);
					
					if(file_put_contents($_target, $_content)===FALSE) {
						throw new FileNotWritableException($_target);
					}
        		} else {
        			copy($fileinfo->getPathname(),$_target);
        		}
    		} else {
    			$this->processDir($fileinfo->getPathname());
    		}
		}
	}
	
	function processDbFiles() {
		$delimiter = ';';
		foreach ($this->mDbFiles as $dbFileName) 
		{
			
			set_time_limit(0);
			$_fileName = $this->mInstallDbFileSource . '/' . $dbFileName;  

			$_db = new db();
			
			$_host = $this->getParameterValue('MAMP_EXTRA_DB_HOST');
			if(defined('MAMP_EXTRA_DB_CONF_PORT')) {
				$_host .= ':' . MAMP_EXTRA_DB_CONF_PORT; 
			}
			
			$cs = $this->getParameterValue('MAMP_EXTRA_DB_CHARSET');
			$cs = $cs==null ? DB_DEFAULT_CHARSET : $cs;
			if(	$_db->connect($_host,
				$this->getParameterValue('MAMP_EXTRA_DB_USERNAME'),
				$this->getParameterValue('MAMP_EXTRA_DB_PASSWORD'),
				$this->getDatabaseName(), $cs,true)===false){
					
				throw new DbException();
			}
			
			if (is_file($_fileName) === true) {
				$file = fopen($_fileName, 'r');

				if (is_resource($file) === true) {
					$query = array();
	
					while (feof($file) === false) {
						$query[] = fgets($file);
	
						if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1) {
							$query = trim(implode('', $query));
							$query = $this->processContent($query);
							if ($_db->query($query) === false) {
								error_log('Extra -> installer.class: SQL ERROR: ' . $query);
							}

						}
	
						if (is_string($query) === true) {
							$query = array();
						}
					}
	
					return fclose($file);
				}
			}
			
		}
	} 
	
	function getParameters() {
		return $this->mParameters;	
	}
	
	function getParameter($name) {
		if(isset($this->mParameters[$name]))
			return $this->mParameters[$name];	
		else return null;
	}
		
	function getParameterValue($name) {
		$p = $this->getParameter($name);
		if($p) {
			return $p->value;
		}
		return null;
	} 
		
	function getName() {
		return $this->mName;
	}
		
	function getAuthor() {
		return $this->mAuthor;
	}
	
	function getVersion() {
		return $this->mVersion;
	}
	
	function getPackeger() {
		return $this->mPackager;
	}
	
	function getAction($section) {
		return $this->mActions[$section];
	}
	
	function processContent($content) {
		foreach($this->mParameters as $_p) {
			if($_p->name === 'MAMP_EXTRA_SITE_PATH' and $_p->value === ''){
				$content = str_replace('/<!#' . $_p->name . '#!>/', '/', $content);
				$content = str_replace('<!#' . $_p->name . '#!>', $_p->value, $content);
			}else if($_p->name === 'MAMP_EXTRA_INSTALLATION_HOST' or $_p->name === 'MAMP_EXTRA_SITE_ADDRESS'){
				$_pattern = '<!#' . $_p->name . '#!>';
				$content = str_replace($_pattern, strtolower($_p->value), $content);
			}else{
				$_pattern = '<!#' . $_p->name . '#!>';
				$content = str_replace($_pattern, $_p->value, $content);
			}	
		}
		$content = $this->processFunction($content);
		return $content;
	}
	
	function processFunction($content) {
		$pattern = '/<\!#MAMP_FUNCTION_([a-zA-Z0-9]+)\(([^\)]*)/i';

		preg_match_all($pattern, $content, $matches);
		//error_log("process function count matches = " . count($matches) . "\n");
		if(count($matches)==3) {
			$musters = $matches[0];
			$functions = $matches[1];
			$args = $matches[2];
			$size = count($musters);
			//error_log("size = " . $size . "\n");
			for ($i=0; $i < $size; $i++) { 
				$search = $musters[$i] . ")#!>";
				
				//error_log("search = " . $search . "\n");
				$replace = $this->applyFunction($functions[$i],$args[$i]);
				
				//error_log("replace = " . $replace . "\n");
				$content = str_replace($search, $replace, $content);	
			}
		}
		
		return $content;
	}
	
	function applyFunction($name,$arg) {
		if($name=="SERIALIZE") {
			return serialize($arg);
		} else if($name=="BASE64") {
			return base64_encode($arg);
		} else if($name=="TRIMPROTOCOL") {
			$parts = parse_url($arg);
			
			// alex change
			if ( $parts['port'] ){
			
				return $parts['host'] . ":" . $parts['port'];
			}
			else{
				return $parts['host'];
			}
		} else if($name=="TRIMPORT") {
			$parts = parse_url($arg);
			$port = ":" . $parts['port'];
			return str_replace($port, "", $arg);	
		} else if($name=="TRIMPROTOCOLPORT") {
			$parts = parse_url($arg);
			return $parts['host'];
		} else if($name=="ADDLEADINGSLASHIFNOTEMPTY"){
			//error_log("arg = " . $arg . "\n");
			if($arg === ''){
				return $arg;
			}else{
				return "/".$arg;
			}
		} else if($name=="WPHASH") {
            //error_log("path = " . $this->mInstallFileSource . "\n");
        	require_once $this->mInstallFileSource . "/wp-includes/class-phpass.php";
        	$wp_hasher = new PasswordHash(8, true);
        	return $wp_hasher->HashPassword(trim(addslashes($arg)));
		}
		return "";
	}
		
	function getDatabaseName() {		
		$p = $this->mParameters['MAMP_EXTRA_DB_NAME'];
		if($p) {
			return $p->value;
		}
		// throw Exception ??
		return '';
		
	}
	
	function getInstallDir() {
		return $this->mInstallDir;
	}
	
	function getDbNameProposal($default) {
		$_db = new db();
		
		if(!defined('MAMP_EXTRA_DB_CONF_HOST') || !defined('MAMP_EXTRA_DB_CONF_USERNAME') || !defined('MAMP_EXTRA_DB_CONF_PASSWORD')){
			throw new DbInsufficientParamsException();
		}

		$_host = MAMP_EXTRA_DB_CONF_HOST;
		if(defined('MAMP_EXTRA_DB_CONF_PORT')) {
			$_host .= ':' . MAMP_EXTRA_DB_CONF_PORT; 
		}
			
		if(	$_db->connect($_host,MAMP_EXTRA_DB_CONF_USERNAME,MAMP_EXTRA_DB_CONF_PASSWORD)===false){
			throw new DbException();
		} else {
			$_proposal = $default;
			$_counter = 0;
			do {
				$ret = $_db->selectDb($_proposal);
				if($ret!=0) {
					$_counter++;
					$_proposal = sprintf("%s_%d",$default,$_counter);
				}
			} while($ret!=0);
			return $_proposal;
		}
	}
	
	function getPathProposal($default) {
		$iDir = true;
		$_proposal = $default;
		$_counter = 0;
		do {
			$_dir = $_SERVER['DOCUMENT_ROOT'] . '/' . $_proposal;
			$iDir = is_dir($_dir);
			if($iDir) {
				$_counter++;
				$_proposal = sprintf("%s_%d", $default, $_counter);
			} 
		} while($iDir);
		return $_proposal;
	}

}

?>
