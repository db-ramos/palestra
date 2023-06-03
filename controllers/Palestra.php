

<?php
require_once 'Consulta.php';
class Palestra extends Consulta{
  
    public function cadastrar($titulo,$palestrante,$data,$hora){      

      $sql = "INSERT INTO palestra(titulo,palestrante,data,hora)  
                   values('$titulo','$palestrante','$data','$hora')";
      return $this->insert($sql);
    }
  
    public function excluir($id){
      $sql= "DELETE FROM palestra WHERE id=$id";
      return $this->delete($sql); 
    }

    public function alterar($id,$titulo,$palestrante,$data,$hora){
      $sql = "UPDATE palestra 
                SET titulo='$titulo', palestrante='$palestrante', data='$data', hora='$hora' 
                WHERE id=$id";
       return $this->update($sql);
    }

    public function getPalestras(){   
        $sql = "SELECT id,titulo,palestrante,data,hora FROM palestra";
        $objetos = $this->selectObjects($sql);
        $listaPalestras = array();
        foreach($objetos as $obj){
            $listaPalestras[] = $obj;
        }
        return $listaPalestras;
    }

    public function getPalestra($id){   
      $sql = "SELECT id,titulo,palestrante,data,hora FROM palestra WHERE id=$id";
      $objeto = $this->selectObject($sql);
      return $objeto;
    }
  }
