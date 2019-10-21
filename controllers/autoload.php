<?php
spl_autoload_register(function($className) {
  $file = __DIR__ . '\\classes\\' . $className . '.php';
  $file_two = dirname(__DIR__)."\\models\\autoloader.php";
	if (file_exists($file)) {
		include $file;
	}
  if (file_exists($file_two)) {
		include $file_two;
	}
});
?>
