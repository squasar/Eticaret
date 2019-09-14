<?php
//database setup - singleton design pattern
define('DB_NAME',"sample");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"");
define('DB_ADDRESS',"localhost");

class MySQLConnect{
  private static $result;
  private function __construct(){}
  public static function get_instance(){
    if(empty(self::$result)){
      @self::$result=new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
      if(mysqli_connect_errno()){
        echo 'Error: Veritabanina baglanti saglanamadi. ';
		exit;
      }
    }
    return self::$result;
  }
  private static function reset_mysqli(){
    @self::$result->close();
      @self::$result=new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if(mysqli_connect_errno()){
      echo 'Error: Veritabanina baglanti saglanamadi.';
      exit;
    }
  }
  private static function set_mysqli_connection($web_address, $username, $password, $db_name){
    @self::$result->close();
    @self::$result=new mysqli($web_address, $username, $password, $db_name);
    if(mysqli_connect_errno()){
      echo 'Error: Veritabanina baglanti saglanamadi.';
      exit;
    }
}
  private function __destruct(){
    self::$result->close();
    unset(self::$result);
  }
}

//It creates a secure connection and builds queries
function _execQ($query, $param_strs, $params){
    $db = MySQLConnect::get_instance();
    $res = $db->prepare($query);
	  array_unshift($params, $param_strs);
    call_user_func_array(array($res, 'bind_param'), $params);
    $sonuc=$res->execute();
    return $sonuc;
}
/* SAMPLE USAGE _execQ
$m_query = "insert into kitaplar values(?, ?, ?, ?, ...)";
$param_strs="sssd...";
$param1='1234569658741';
...
$params=array(&$param1,&$param2,...);
_execQ($m_query, $param_strs, $params);
*/
?>
