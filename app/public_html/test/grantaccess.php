<?php
if(setcookie('testsite_access', 'GRANTED', time()+259200, '/', '.creativekits.es')){
    echo 'ACCESS GRANTED!';
}
?>