<?php
function decorate($class, $source_method, $new_code) {
    static $decorators_count;
    if(!isset($decorators_count["$class@$source_method"])) {
        $decorators_count["$class@$source_method"] = 0;
    }
    $decorators_count["$class@$source_method"] ++;
    $new_method = $source_method;
    $method = '';
    for($i=0; $i<$decorators_count["$class@$source_method"]; $i++) {
        $method = $new_method;
        $new_method = $new_method . '_decorated';
    }
    runkit_method_rename($class, $source_method, $new_method);
    $new_method_code = str_replace('base_method()', "call_user_func_array(array(\$this, '$new_method'), func_get_args())",
        $new_code
    );
    runkit_method_add($class, $source_method, '', $new_method_code);
}

?>
