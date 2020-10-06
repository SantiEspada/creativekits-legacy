<?php

setcookie('test_test', $_COOKIE['test_test'] + 1, time()+259200, '/', '.creativekits.es');

echo $_COOKIE['test_test'];

?>