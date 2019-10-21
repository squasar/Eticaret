<?php
class MySQLQueries{

  //It creates a secure connection and builds queries
  function _execQ($query, $param_strs, $params){
      $db = MySQLConnect::get_instance();
      $res = $db->prepare($query);
  	  array_unshift($params, $param_strs);
      call_user_func_array(array($res, 'bind_param'), $params);
      $bool = $res->execute();
      $sonuclar = $res->get_result();
      $rows = $sonuclar->fetch_all(MYSQLI_ASSOC);
      return $rows;
  }

  //bu fonksiyon kullanicidan parametre alabilecek sekilde calistirilmamali.
  function c_exec($query_without_params){
    $db=MySQLConnect::get_instance();
    $result=@$db->query($query_without_params);
    if(!$result){
      return false;
    }
    $res_array = array();
    for($sayac=0; $satir=$result->fetch_assoc();$sayac++){
      $res_array[$sayac]=$satir;
    }
    return $res_array;
  }

  function insert_execQ($query, $param_strs, $params){
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
}

?>
