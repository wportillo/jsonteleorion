<?php
/**
 * RS Class
 *
 * @author William
 * @package Core
 */
class rs{
	
	/**
	 * Table
	 */
	public $table;
	
	/**
	 * Primary Key
	 */
	public $primary_key;
	
	/**
	 * Pivot Tables
	 */
	public $pivot_tables;
	
	/**
	 * Debug
	 *
	 * @var booelan
	 */
	public $debug = false;
	
	/**
	 * Get Limit
	 *
	 * @var booelan
	 */
	public $nolimit		=false;
	
    /**
	 *	Unique
	 *
	 * @var booelan
	 */
	public $unique= false;
	/**
	 *	Table Fields
	 *
	 * @var array
	 */
	public $fields=false;
	
	/**
	 * Condition Default
	 * 
	 * @var string
	 */
		public $condition =false;
	/**
	 * Constructor
	 *
	 * @return rs
	 */
		function __construct() {
			
			if(DEBUG_DB){
				$this->debug = true;
			}
	        
		}
	/**
	 * Get Pivot SQL
	 *
	 * @return string
	 */
		private function get_pivot(){
			
			$sql = '';
			
			if(is_array($this->pivot_tables)){
	
				$last_table = $this->table;
				
				foreach($this->pivot_tables as $pivot){
					
					if(isset($pivot['type'])){
						$pivot_type = $pivot['type'];
					}else {
						$pivot_type = ' INNER JOIN ';
					}	
					/*
					 * Reload same table
					 */
					if(isset($pivot['similar'])){
						$similar = $pivot['similar'];
					}else {
						$similar = $pivot['table'];
					}	
					
					if($last_table != $this->table){
						$sql .= ' ' . $pivot_type . ' ' . db::ftquote($pivot['table']) . ' ';
						$sql .= db::ftquote($pivot['table']) . ' ON ' . db::ftquote($pivot['table']) . '.' . db::ftquote($pivot['link_a']) . ' = ' . db::ftquote($last_table) . '.' . db::ftquote($pivot['link_b']);
					}else {
						$sql .= ' ' . db::ftquote($this->table) . ' ' . $pivot_type . ' ' . db::ftquote($pivot['table']) . ' ';
						$sql .= db::ftquote($similar) . ' ON ' . db::ftquote($this->table) . '.' . db::ftquote($pivot['link_a']) . ' = ' . db::ftquote($similar) . '.' . db::ftquote($pivot['link_b']);					
					}
					
					$last_table = $pivot['table'];
					
				}	
						
			}
			
			return $sql;		
			
		}
	/**
	 * Add
	 * 
	 * @param array $data
	 * @return integer 
	 */
		public function add($data){
			
			foreach($data as $key => $value){
				$arr_fields[] = db::ftquote($key);
				$arr_values[] = db::quote($value);
			}
			
			$fields = implode(", ", $arr_fields);
			$values = implode(", ", $arr_values);
					
			$sql = "INSERT INTO " . db::ftquote($this->table) . " (" . $fields . ") VALUES (" . $values .  ")";
			
			if($this->debug){ $this->show_debug($sql); }
			
			$rst = db::query($sql);
			
			if(!$rst){
				return false;
			}
			
			if(db::affected_rows() != 1){
				return false;
			}
			
			$id = db::insert_id();
			
			return $id;
			
		}
	/**
	 * Get Last Insert Id
	 * @return integer
	 */
		public function get_last_insert_id(){
	
			$sql=' SELECT MAX('.$this->primary_key.') AS last FROM '.db::ftquote($this->table);
		
			$rst 	= db::query($sql);
			
			$result = db::fetch_assoc($rst);
	
			if($this->debug){
				$this->show_debug($sql);
			}
			
			return $result['last'];
		}
	/**
	 * Show SQL
	 * 
	 * @params string $sql
	 */
		public function show_debug($sql){
			
			echo '<div class="sql_debug">' . $sql . '</div>';		
			
		}
		
	/**
	 * Update
	 * 
	 * @param array $data
	 * @param integer $id
	 * @return boolean
	 */
	public function update($data, $id){
		
		$sql = "UPDATE " . db::ftquote($this->table) . " SET ";

		$update = array();
		
		foreach($data as $key => $value){
			$update[] = db::ftquote($key) . " = " . db::quote($value);
		}
		
		$sql .= implode(", ", $update);
		$sql .= " WHERE " . db::ftquote($this->primary_key)  . " = " . db::quote($id) .  " LIMIT 1";
		
		if($this->debug){ $this->show_debug($sql); }
		
		$rst = db::query($sql);

		return $rst;
		
	}
	
	/**
	 * Delete
	 * 
	 * @param integer $id
	 *  
	 * @return boolean
	 */
	public function delete($id){
		
		if($this->nolimit==false){
			$sql = "DELETE FROM " . db::ftquote($this->table) . " WHERE " . db::ftquote($this->primary_key) . " = " . db::quote($id) . " LIMIT 1";
		}else{
			$sql = "DELETE FROM " . db::ftquote($this->table) . " WHERE " . db::ftquote($this->primary_key) . " = " . db::quote($id);
		}
	
		if($this->debug){ $this->show_debug($sql); }
		
		$rst = db::query($sql);
		
		return $rst;
	}
	
	/**
	 * Get
	 * 
	 * @param integer $id
	 * @return array 
	 */
	public function get($id){
	
	
			$sql = $this->get_fields();
		
			if(is_array($this->pivot_tables)){
				foreach($this->pivot_tables as $pivot){
						if($this->unique==false){
							$sql .= ', ' . db::ftquote($pivot['table']) . '.*';
						}else{
							$sql .= '*';
						}
					}
			}
		
		$sql .= ' FROM ' . db::ftquote($this->table) . ' ';
		
		$sql .= $this->get_pivot();
		
		if($this->nolimit==false){
			
			$sql .= " WHERE " . db::ftquote($this->table) . '.' . db::ftquote($this->primary_key) . " = " . db::quote($id) . " LIMIT 1";
		}else{
		
			$sql .= " WHERE " . db::ftquote($this->table) . '.' . db::ftquote($this->primary_key) . " = " . db::quote($id);
		}
		
		if($this->debug){ $this->show_debug($sql); }
		
		$rst = db::query($sql);
				
		if(!$rst){
			return false;
		}
		
		if(db::num_rows($rst) == 0){
			return false;
		}
		
		
		if($this->nolimit==false){
			$data = db::fetch_assoc($rst);
		}else{
				
				while($data[] = db::fetch_assoc($rst)){}
				
				$data = array_filter($data);
		}
		
			return $data;
	}
	
	/**
	 * Get List
	 * 
	 * @param integer $max
	 * @param integer $pag
	 * @param string $where
	 * @param string $order
	 * @return mysql_resource
	 */
	public function get_list($max = 0, $pag = 1, $where = '', $order = ''){
        $max = (int) $max;
		if(is_numeric($pag)){
            $pag = ((int) $pag) - 1;
        }else{
            $pag = 0;
        }
        
        if($where!=''){
            if($this->condition !=false){
                $where = $this->condition."AND ".$where;
            }
        }else{
        	if($this->condition !=false){
        		$where = $this->condition;
        	}
        }
		
		if($this->unique==false){
				
			$sql = $this->get_fields();
				
		}else{
			$sql = " SELECT *";	
		
		}

			if(is_array($this->pivot_tables)){
				foreach($this->pivot_tables as $pivot){
				 $sql .= ", " . db::ftquote($pivot['table']) . ".*";
				}
			}
		
		$sql .= ' FROM ' . db::ftquote($this->table) . ' ';
		
		$sql .= $this->get_pivot();
		
		if($where != ''){
			$sql .= " WHERE " . $where;
		}
		
		if($order != ''){
			$sql .= " ORDER BY " . $order;
		}
		
		if($max != 0){
			$from = $max * $pag;
			$sql .= " LIMIT " . $from . ", " . $max;
		}

		if($this->debug){ $this->show_debug($sql); }	
		
		$rst = db::query($sql);
		
		if(!$rst){
			return false;
		}
	
		return $rst;	
		
	}
		
	/**
	 * Count
	 * 
	 * @param string $where
	 * @return integer
	 */
	public function count($where = ''){

		$sql = "SELECT COUNT(*) AS `count` FROM " . db::ftquote($this->table) . ' ';
		$sql .= $this->get_pivot();
		
       if($where!=''){
            if($this->condition !=false){
                $where = $this->condition."AND ".$where;
            }
        }else{
        	if($this->condition !=false){
        	$where = $this->condition;
        	}
        }
        
		if($where != ''){
			$sql .= " WHERE " . $where; 
		}

		if($this->debug){ $this->show_debug($sql); }
		
		$rst = db::query($sql);
		
		if(!$rst){
			return false;
		}
		
		$count = db::fetch_assoc($rst);
		
		return $count['count'];
		
	}
	
	/**
	 * Get Fields
	 *
	 * @return string
	 */
	private function get_fields(){
	
			$result;
			
			$sql='SELECT ';
			
			if(is_array($this->fields)){


					$result= $sql.' '.implode(',', $this->fields);
			
			}else{
					
					$result=$sql.'*';
			}
			
			return $result;
	}
}
?>