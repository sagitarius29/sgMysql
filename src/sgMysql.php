<?php 
/**
* Clase para el manejo de Mysql como objeto
* -------------------------------------------------
* Author: Adolfo Cuadros Anco
* Versión: 0.1.0
* Github: github.com/sagitarius29/sgMysql
* E-mail: ronnie.adolfo@gmail.com
* Año: 2014
*/
class sgMysql
{
	//Cambiar los datos
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '';
	private $database = 'pruebas';
	//------------------------

	protected $structure;
	protected $primary_key;
	protected $unique;
	protected $engine;

	protected $mysqli;
	protected $principal_table;

	protected $sentencia;
	var $result;
	protected $where;

	function __construct() {
		$this->Conectar();
	}

	function Conectar() {
		if(is_object($this->mysqli)) {
			return true;
		}
		$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->database);
		if($this->mysqli->connect_error) {
			throw new Exception($this->mysqli->errno, $this->mysqli->connect_error);
			return false;
		}
		return true;
	}

	function CreateTable() {
		if (is_array($this->structure)) {
			$this->sentencia = 'CREATE TABLE IF NOT EXISTS `'.$this->principal_table.'` (';
			$count = 0;
			$hasta = count($this->structure);
			foreach ($this->structure as $key => $value) {
				$count++;
				$this->sentencia .= ' `'.$key.'` '.$value;
				if($count != $hasta) {
					$this->sentencia .= ', ';
				}
			}
			if(!empty($this->primary_key)) {
				$this->sentencia .= ', PRIMARY KEY (`'.$this->primary_key.'`)';
			}
			if (is_array($this->unique)) {
				$hasta = count($this->unique);
				for ($i=0; $i < $hasta; $i++) { 
					$this->sentencia .= ', UNIQUE INDEX `'.$this->unique[$i].'_UNIQUE` (`'.$this->unique[$i].'` ASC)';
					if($hasta-1 != $i) {
						$this->sentencia .= ', ';
					}
				}
			} elseif(!empty($this->unique)) {
				$this->sentencia .= ', UNIQUE INDEX `'.$this->unique.'_UNIQUE` (`'.$this->unique.'` ASC)';
			}
			$this->sentencia .= ')';
			if(!empty($this->engine)) {
				$this->sentencia .= ' ENGINE = '.$this->engine;
			}
			return $this->Query($this->sentencia);
		} else {
			throw new Exception("No se tenemos una estructura para crear esta tabla", 1000);
		}
	}

	private function Query($sql) {
		if(!is_object($this->mysqli)) {
			throw new Exception("Error: Aún no se ha iniciado una conexion a la base de datos.", 1);
		}
		if($this->result = $this->mysqli->query($sql)) {
			return true;
		} else {
			return false;
		}
	}

	private function NumRows() {
		return $this->mysql->num_rows;
	}

	function Save() {
		$this->sentencia = 'INSERT INTO '.$this->principal_table.' (';
		foreach ($this->structure as $key => $valor) {
			if (!empty($this->{$key})) {
				$values[] = $this->{$key};
				$columns .= $key.', ';
			}
		}
		$this->sentencia .= substr($columns, 0, strlen($columns)-2);

		$this->sentencia .= ') VALUES (';
		for ($i=0; $i < count($values); $i++) { 
			$val .= '\''.$values[$i].'\', ';
		}
		$this->sentencia .= substr($val, 0, strlen($val)-2).')';
		return $this->Query($this->sentencia);
	}

	function Delete() {
		$this->sentencia = 'DELETE FROM '.$this->principal_table.' WHERE ';
		foreach ($this->structure as $key => $valor) {
			if (!empty($this->{$key})) {
				$where .= $key.'=\''.$this->{$key}.'\' AND ';
			}
		}
		$this->sentencia .= substr($where, 0, strlen($where)-5);
		return $this->Query($this->sentencia);
	}

	function Update() {
		$this->sentencia = 'UPDATE '.$this->principal_table.' SET ';
		foreach ($this->structure as $key => $valor) {
			if (!empty($this->{$key})) {
				$set .= $key.'=\''.$this->{$key}.'\', ';
			}
		}
		$this->sentencia .= substr($set, 0, strlen($set)-2);
		if(!empty($this->where)) {
			$this->sentencia .= ' WHERE '.substr($this->where, 0, strlen($this->where)-5);
		}
		return $this->Query($this->sentencia);
	}

	function Select() {
		$this->sentencia = 'SELECT ';
		foreach (func_get_args() as $a) {
			$select .= $a.', ';
		}
		$this->sentencia .= substr($select, 0, strlen($select)-2).' FROM '.$this->principal_table;
		if(!empty($this->where)) {
			$this->sentencia .= ' WHERE '.substr($this->where, 0, strlen($this->where)-5);
		}
		return $this->Query($this->sentencia);
	}

	function Where($column, $logica, $valor) {
		$this->where .= $column.$logica.'\''.$valor.'\' AND ';
	}

}
?>