<?php
class MY_Model extends CI_Model{
	protected $hidden = array();
	function __construct()
	{
		parent::__construct();
    }

	function get_sql($condition)
    {
		$db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';
    	if(isset($condition['sql']) and !empty($condition['sql'])):
    		$query = $this->{$db}->query($condition['sql']);
			$code = @explode(' ',$sqlQuery);
			if(strtolower($code[0])=='select'):
				$result = $query->result_array();
				return $result;
			else:
				return $query;
			endif;
    	endif;
    }

	function get_query($sqlQuery,$condition=NULL)
	{
		$db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';
        $query = $this->{$db}->query($sqlQuery);

		$code = @explode(' ',$sqlQuery);
		if(strtolower($code[0])=='select'):
			$result = $query->result_array();
			return $result;
		else:
			return $query;
		endif;

	}

	function get_insert($condition)
	{
		$condition['encode'] = TRUE;
        $db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';
		if(isset($condition['data']) and !empty($condition['data'])):
			$data = array();
			foreach($condition['data'] as $key => $val):
				if($condition['encode'] == FALSE):
					$data[$key] = $val;
				else:
					$data[$key] = htmlspecialchars_decode($val, ENT_QUOTES);
				endif;
			endforeach;
			$result = $this->{$db}->insert($this->table, $data);
			return $result;
		endif;
	}

	function get_select($condition=NULL)
	{
    	$db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';

		if(!empty($condition['distinct'])){
			$this->{$db}->distinct($condition['distinct']);
		}
		if(!empty($condition['select'])):
			$this->{$db}->select($condition['select']);
		else:
			$this->{$db}->select('*');
		endif;
		if(!empty($condition['table'])):
			$this->{$db}->from($condition['table']);
		else:
			$this->{$db}->from($this->table);
		endif;
		if(isset($condition['join']) and !empty($condition['join'])):
			foreach($condition['join'] as $join):
				$j = explode(',', $join);
				if(count($j)==3):
					$this->{$db}->join($j[0],$j[1],$j[2]);
				endif;
			endforeach;
		endif;

		if(isset($condition['where']) and !empty($condition['where'])):
			$this->{$db}->where($condition['where']);
		endif;
		if(isset($condition['group_by']) and !empty($condition['group_by'])):
			$this->{$db}->group_by($condition['group_by']);
		endif;
		if(isset($condition['having']) and !empty($condition['having'])):
			$this->{$db}->having($condition['having']);
		endif;
		if(isset($condition['order_by']) and !empty($condition['order_by'])):
			$this->{$db}->order_by($condition['order_by']);
		endif;
		if(isset($condition['limit']) and !empty($condition['limit'])):
			$l = explode(',', $condition['limit']);
			if(count($l)==2) $this->{$db}->limit($l[1],$l[0]);
		endif;

		$result = $this->{$db}->get()->result_array();
		#Debug SQL syntax
		if(isset($condition['debug']) and $condition['debug']==true){
			echo $this->{$db}->last_query();
		}
		if(isset($condition['array_key'])):
			if($condition['array_key'] == 1):
				$key = $this->getPrimaryKey();
			else:
				$key = $condition['array_key'];
			endif;
			$re = [];
			foreach($result as $r):
				$re[$r[$key]] = $r;
			endforeach;
			$result = $re;
		endif;
		if(sizeof($this->hidden) == 0 OR isset($condition['unhidden'])) {
			return $result;
		}
		if(sizeof($result) > 0) {
			if(sizeof($this->hidden) > 0) {
				$result = $this->hideData($result);
			}
		}

		return $result;
	}

	function get_update($condition)
	{
		$condition['encode'] = TRUE;
		$db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';
		if(isset($condition['where']) and !empty($condition['where'])):
			$data = array();
			foreach($condition['data'] as $key => $val):
				if($condition['encode'] == FALSE):
					$data[$key] = $val;
				else:
					$data[$key] = htmlspecialchars_decode($val, ENT_QUOTES);
				endif;
			endforeach;
			$this->{$db}->where($condition['where']);
			$result = $this->{$db}->update($this->table, $data);
			return $result;
		endif;
	}

	function get_delete($condition)
	{
        $db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';
		if(isset($condition['where']) and !empty($condition['where'])):
			return $this->{$db}->delete($this->table, $condition['where']);
		endif;
	}

	function get_insert_last_id($condition)
	{
        $db = (isset($condition['db']) and $condition['db']!='') ? $condition['db'] : 'db';
		if(isset($condition['data']) and !empty($condition['data'])):
			$data = array();
			foreach($condition['data'] as $key => $val):
				$data[$key] = htmlspecialchars($val, ENT_QUOTES);
			endforeach;
			$result = $this->{$db}->insert($this->table, $data);
			return $this->{$db}->insert_id();
		endif;
	}

	protected function hideData($result) {
		$type = '';

		foreach($result as $res) {

			if($type == '') {
				if(is_object($res)) {
					$type = 'object';
				}
				else if(is_array($res)) {
					$type = 'array';
				}
			}

			foreach($this->hidden as $hide) {
				if($type == 'object') {
					if(isset($res->$hide)) {
						unset($res->$hide);
					}
				}
				else if($type == 'array') {
				 if(isset($res[$hide])) {
						unset($res[$hide]);
					}
				}
			}

		}
		return $result;
	}

	function getPrimaryKey(){
		  $query = $this->db->query('SHOW KEYS FROM '.$this->table.' WHERE Key_name = "PRIMARY"');
		  $data = $query->result_array();
		  return $data[0]['Column_name'];
	}

	public function getAll(){
        $con = array();
        $con['where'] = 'status >= 0';
            return $this->get_select($con);
    }

    public function find($id){
        $con = array();
        $con['where'] = 'id ='.intval($id);
        $data =  $this->get_select($con);
        return !empty($data)?$data[0]:FALSE;
    }

	public function findField($id,$column = null){
		$con = array();
		if($column != null):
			$con['select'] = $column;
		endif;
		$con['where'] = 'id ='.intval($id);
		$data =  $this->get_select($con);
		return !empty($data)?$data[0]:FALSE;
	}

    public function findUUID($uuid){
        $con = array();
        $con['where'] = 'uuid ="'.$uuid.'"';
        $data =  $this->get_select($con);
        return !empty($data)?$data[0]:FALSE;
    }

	public function create($data,$id = FALSE){
        $con = array(
            'data' => $data
        );
		if($id):
			return $this->get_insert_last_id($con);
		else:
			return $this->get_insert($con)?TRUE:FALSE;
		endif;
    }

    public function update($data,$id){
        $con = array(
            'data' => $data,
            'where' => 'id ='.$id
        );
        return $this->get_update($con);
    }

	public function updateUUID($data,$uuid){
		$con = array(
			'data' => $data,
			'where' => 'uuid = "'.$uuid.'"'
		);
		return $this->get_update($con);
	}

    public function delete($id){
		$data= array();
		$data['status'] = -1;
        $con = array(
            'data' => $data,
            'where' => 'id ='.$id
        );
        return $this->get_update($con);
    }

	public function deleteUUID($uuid){
		$data['status'] = -1;
		$con = array(
			'data' => $data,
			'where' => 'uuid = "'.$uuid.'"'
		);
		return $this->get_update($con);
	}

    public function genUUID(){
		$this->load->helper('string');
        $uuid = random_string('alnum', 16);
        $con = array();
        $con['where'] = 'uuid = "'.$uuid.'" AND status <> -1';
        $user = $this->get_select($con);
        return empty($user)?$uuid:$this->genUUID();
    }

	public function genTOKEN($num = 16,$db = false){
		$this->load->helper('string');
		$token = random_string('alnum', $num);
		if($db == true):
		$con = array();
		$con['where'] = 'token = "'.$token.'" AND status <> -1';
		$used = $this->get_select($con);
		return empty($used)?$token:$this->genTOKEN();
		else:
			return $uuid;
		endif;
	}

	public function genPassword($num = 6){
		$this->load->helper('string');
		return random_string('alnum', $num);
	}


}

?>
