<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clienteModel extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }

    function guardar($post){
        $datosCliente = array();
        $datosCliente['id'] = $post['id'];
        $datosCliente['Nombre'] = $post['Nombre'];
        $datosCliente['Apellido'] = $post['Apellido'];
        $datosCliente['Cedula'] = $post['Cedula'];
        $datosCliente['Edad'] = $post['Edad'];
        $datosCliente['Correo'] = $post['Correo'];
        $ruta = base_url('clienteController');
        
        if ($datosCliente['id'] > 0) {
            $this->db->where('id', $datosCliente['id']);
            $this->db->update('cliente', $datosCliente);
            echo "<script>
                alert('Cliente modificado Correctamente');
                window.location = '{$ruta}';
            </script>";
        }else{
            $this->db->insert('cliente', $datosCliente);
            echo "<script>
                alert('Cliente guardado Correctamente');
                window.location = '{$ruta}';
            </script>";
        }
    }

    function borrar($get){
        $this->db->where('id', $get['borrar']);
        $this->db->delete('cliente');
    }
    
    public function getPersonas(){
		$this->db->select('Nombre,Edad');
		$this->db->from('cliente');
		$query = $this->db->get();
					
		return $query->result();
	}
}