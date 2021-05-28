<?php

	require_once('db.class.php');

	class recordset {
	
		var $table = '';
		var $fields = array();
		var $primary = 'id';
	
		function recordset() {
			
		}//constructor
	
		function initNew() {
			$_p = $this->primary;
			$this->$_p = 0;
			foreach($this->fields as $field) {
				$this->$field = '';
			}
		}
		
		function initByData($data) {
			foreach($this->fields as $field) {
				if(isset($data[$field])) {
					$this->$field = $data[$field];
				}
			}
		}
	
		function load($id) {
			$this->loadByField($this->primary,$id);
		}
	
		function loadByField($field,$value) {
			
			$db = new db();
			$db->query('SELECT ' . implode(',',$this->fields) . ' FROM `' . $this->table . '` WHERE ' . addslashes($field) . "='" . addslashes($value) . "';");
			if($db->next_row()) {
				$this->initByData($db->getRow());
			}
                        unset($db);
		}

                function loadByFields($values) {
                    $keys=array();
                    foreach($values as $key=>$field) {
                        if(in_array($key,$this->fields)) {
                                $keys[] = '`' . $key."`='" . addslashes($field) . "'";
                        }
                    }
                    $_where=implode(' AND ',$keys);
                    $db = new db();
                    $db->query('SELECT ' . implode(',',$this->fields) . ' FROM `' . $this->table . '` WHERE ' . $_where . ';');
                    if($db->next_row()) {
			$this->initByData($db->getRow());
                    }
                    unset($db);
                }

	
		function rowCounter($field,$value) {
			$db = new db();
			if ($field == '*' && $value == '*'){
				$db->query('SELECT * FROM `' . $this->table .'`;');
			}else{
				$db->query('SELECT ' . implode(',',$this->fields) . ' FROM `' . $this->table . "` WHERE " . addslashes($field) . "='" . addslashes($value) . "'");
			}
			$count = $db->getRowNum();
                        unset($db);
			return $count;
		}
	
		/*function sortQuery($field,$value,$sort_criterion){
			$db = new db();
			$db->query('SELECT ' . implode(',',$this->fields) . ' FROM ' . $this->table . ' WHERE ' . addslashes($field) . '=' . addslashes($value) . ' ORDER BY '.$sort_criterion.' LIMIT 0,30');
			if($db->next_row()) {
				$this->initByData($db->getRow());
				echo 'ovde smo stigli, ali sta dalje?';
			}
		}*/
	
		function save($force_new=false) {
			$db = new db();
			
			$keys=array();
			foreach($this->fields as $field) {
				if(isset($this->$field)) {
					$keys[] = '`' . $field."`='" . addslashes($this->$field) . "'";
				}
			}
			
			$set=implode(",",$keys);
	
			if(!empty($this->{$this->primary}) && !$force_new) {
				// update existing
                                //error_log('UPDATE `'.$this->table.'` SET '.$set.' WHERE ' . $this->primary . '=' . $this->{$this->primary} . ';');
				$_ret = $db->query('UPDATE `'.$this->table.'` SET '.$set.' WHERE ' . $this->primary . '=' . $this->{$this->primary} . ';');
                                unset($db);
                                return $_ret;
			} else {
				
				// insert new
				//error_log('INSERT INTO `' . $this->table . '` SET ' . $set);
				$query = 'INSERT INTO `' . $this->table . '` SET ' . $set;

				$_ret = $db->query($query);
				if($_ret>0) {
                                    $_id = $db->getLastId();

                                    if($_id) {
                                            $this->{$this->primary} = $_id;
                                    }
                                }
                                unset($db);
				return $_ret;
			}
		}


                function update($values) {
                    if(empty($this->{$this->primary})) {
                        return -1;
                    }
                    $keys=array();
                    foreach($values as $key=>$field) {
                        if(in_array($key,$this->fields)) {
                                $keys[] = '`' . $key."`='" . addslashes($field) . "'";
                        }
                    }
                    $set=implode(",",$keys);
                    $db = new db();
                    $_ret = $db->query('UPDATE `'.$this->table.'` SET '.$set.' WHERE ' . $this->primary . '=' . $this->{$this->primary} . ';');
                    unset($db);
                    return $_ret;
                }

		function remove($id){
			$db = new db();
			return $db->query('DELETE FROM `' . $this->table . '` WHERE ' . $this->primary . '=' . $id . ';');
		}

                function count($values,$not_values=array()) {
                    $db = new db();
                    $_w = array();
                    foreach ($values as $k=>$v){
                        $_w[] = '`'.$k.'`="'.addslashes($v).'"';
                    }
		    if(!empty ($not_values)) {
			foreach ($not_values as $k=>$v){
			    $_w[] = '`'.$k.'`<>"'.addslashes($v).'"';
			}
		    }

                    $_f = array_keys($values);
                    $db->query('SELECT ' . $_f[0] . ' FROM `' . $this->table . '` WHERE ' . implode(' AND ',$_w) . ';');
                    $_ret = $db->getRowNum();
                    unset($db);
                    return $_ret;
                }

                function exists($values,$not_values=array()) {
                    return $this->count($values,$not_values)>0;
                }
                
		function isNew() {
                    return empty ($this->{$this->primary});
                }

	}

?>