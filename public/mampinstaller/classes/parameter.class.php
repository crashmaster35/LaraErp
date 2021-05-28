<?php

	class parameter {
		
		
		public $value;
		public $name;
		public $type;
		public $default;
		public $editable = true;
		public $show = true;
		
		
		function __construct($param,$typ) 
		{
			$this->name = $param;
			$this->type = $typ;
		}
		
		function setup($data)
		{
			if(isset($data['name'])) $this->name = $data['name'];
			if(isset($data['default'])) $this->default = $data['default'];
			if(isset($data['editable'])) $this->editable = $data['editable'];
			if(isset($data['show'])) $this->show = $data['show'];

		}
		
	}

?>