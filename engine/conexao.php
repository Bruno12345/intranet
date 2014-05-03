<?php
class Conexao{

        
        private $strUsuario     = "glbrintr_intra12";
        private $strSenha       = "Q1w2e3r4t52@13@#$";
        private $strBD          = "glbrintr_intranet";
        private $strServidor    = "localhost";
        private $conn;

   /*
	private $strUsuario     = "grandein_userint";
        private $strSenha       = "LeandroGLS";
        private $strBD          = "grandein_Intranet";
        private $strServidor    = "50.97.101.244";
        private $conn;
        
        private $strUsuario     = "helpdesk_intrane";
        private $strSenha       = "leandroGL$";
        private $strBD          = "helpdesk_intranet";
        private $strServidor    = "50.116.87.164";
        private $conn;
    */
        
        public function conectar(){
            // Estabelecendo conexao com o banco de dados.
            $conn = mysql_pconnect($this->strServidor, $this->strUsuario, $this->strSenha) or die ("<br /><br />N&atilde;o foi poss&iacute;vel conectar ao Banco de Dados.<br />Contacte o Administrador do Sistema.<br /><br />".mysql_error());
            mysql_set_charset('utf8', $conn); 
            return $conn;
        }
        
        public function selecionaBD(){
            // Selecionando o banco de dados a ser utilizado pelo sistema.
            if(mysql_select_db($this->strBD)){
                return true;
            }else{
                return false;
            }
        }
        
        public function __destruct(){settype($this, "null");}
        
        public function desconectar(){@mysql_close($this->conn);}
        
    }
    
    $Conexao = new Conexao;
    $Conexao->conectar();
    $Conexao->selecionaBD();
?>
