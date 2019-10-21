<?php
spl_autoload_register(function($className) {

  $model_folder_names=array('classes','helpers');
  $classes_folder_names=array('categories','comments','database',
                          'messages','orders','products','users');

  $count_one=count($model_folder_names);
  $count_two=count($classes_folder_names);

  $dash='\\';
  $root=__DIR__ . $dash;

  for ($i=0; $i < $count_one; $i++) {
    $suffix_one=$model_folder_names[$i];
    if($suffix_one=='classes'){
      for ($j=0; $j < $count_two; $j++) {
        $suffix_two=$classes_folder_names[$j];
        $file=$root.$suffix_one.$dash.$suffix_two.$dash.$className.'.php';
        if (file_exists($file)) {
		        include $file;
        }
      }
    }else{
      $file=$root.$suffix_one.$dash.$className.'.php';
      if(file_exists($file)){
        include $file;
      }
    }
  }
});
?>
