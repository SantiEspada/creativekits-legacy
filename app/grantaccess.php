<?php
if(setcookie('testsite_access', 'GRANTED', time()+259200, '/', 'localhost')){
    echo 'ACCESS GRANTED!';
}
?>