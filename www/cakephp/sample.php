<?php

function handleError(int $code, string $description, ?string $file = null, ?int $line = null)
{
    var_dump(__METHOD__ . __LINE__);
    var_dump($code, $description, $file, $line);
}

function handleException(Throwable $exception)
{
    var_dump(__METHOD__ . __LINE__);
    var_dump($exception);
}

function shutdown()
{
    var_dump(__METHOD__ . __LINE__);
    $error = error_get_last();
    var_dump($error);
}

set_error_handler('handleError');
set_exception_handler('handleException');
register_shutdown_function('shutdown');

// // set_error_handler()で捕捉できるエラー例
// $hoge = $a;
// // Warning: Undefined variable $a in /var/www/cakephp/sample.php on line 27
// ob_clean();
// // Notice: ob_clean(): Failed to delete buffer. No buffer to delete in /var/www/cakephp/sample.php on line 28
// $arr = [PHP_INT_MAX + 1 => 'hoge'];
// Deprecated: Implicit conversion from float 9.223372036854776E+18 to int loses precision in /var/www/cakephp/sample.php on line 30

// trigger_error('E_USER_DEPRECATEDです', E_USER_DEPRECATED);
// // Deprecated: E_USER_DEPRECATEDです in /var/www/cakephp/sample.php on line 31
// trigger_error('E_USER_NOTICEです', E_USER_NOTICE);
// // Notice: E_USER_NOTICEです in /var/www/cakephp/sample.php on line 32
// trigger_error('E_USER_WARNINGです', E_USER_WARNING);
// // Warning: E_USER_WARNINGです in /var/www/cakephp/sample.php on line 33
// trigger_error('E_USER_ERRORです', E_USER_ERROR);
// // Fatal error: E_USER_ERRORです in /var/www/cakephp/sample.php on line 34

// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// error_reporting(E_PARSE);

// set_exception_handler()で捕捉できるエラー例
// throw new Exception('Exceptionです');
// Fatal error: Uncaught Exception: Exceptionです in /var/www/cakephp/sample.php:44
// $hoge = 1 / 0;
// Fatal error: Uncaught DivisionByZeroError: Division by zero in /var/www/cakephp/sample.php:46
// aaa();
// Fatal error: Uncaught Error: Call to undefined function aaa() in /var/www/cakephp/sample.php:48
// eval("echo 'hoge' echo 'fuga'");
// Parse error: syntax error, unexpected token "echo", expecting "," or ";" in /var/www/cakephp/sample.php(50) : eval()'d code on line 1

// register_shutdown_function()で捕捉できるエラー例
// ini_set("max_execution_time", "1");for(;;){};
// Fatal error: Maximum execution time of 1 second exceeded in /var/www/cakephp/sample.php on line 54
// str_repeat("aaa", PHP_INT_MAX);
// Fatal error: Possible integer overflow in memory allocation (3 * 9223372036854775807 + 32) in /var/www/cakephp/sample.php on line 57
// eval('function foo($a, $b, $unused, $unused) {}');
// Fatal error: Redefinition of parameter $unused in /var/www/cakephp/sample.php(60) : eval()'d code on line 1

echo "---end---\n";
