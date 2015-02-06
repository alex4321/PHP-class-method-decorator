<?php
include "decorate.php";
class Foo{
    function check() {
        return "Foo";
    }
    function fail() {
        return "Bar";
    }
}
function italic($inner) {
    return "<i>$inner</i>";
}
decorate('Foo', 'check', 'if(isset($_GET["foo"])) { return base_method(); } else { return $this->fail(); }');
decorate('Foo', 'check', 'return italic(base_method());');
$instance = new Foo;
echo $instance->check();

?>
