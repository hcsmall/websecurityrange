<?php
//disable_functions 禁用函数查看 
$disabledFunctions = ini_get('disable_functions');

if (empty($disabledFunctions)) {
    echo "所有函数都是可用的。";
} else {
    $disabledFunctions = explode(',', $disabledFunctions);
    echo "被禁用的函数列表：\n";
    foreach ($disabledFunctions as $disabledFunction) {
        echo trim($disabledFunction) . "\n";
    }
}
?>
