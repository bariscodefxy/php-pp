--TEST--
Test for bug #65672: Broken classes inherited from DatePeriod
--INI--
date.timezone=UTC
--FILE--
<?php

$interval = new DateInterval('P1D');
$period = new class(new DateTime, $interval, new DateTime) extends DatePeriod {
    public $extra = "stuff";
};

var_dump($period->extra);
$period->extra = "modified";
var_dump($period->extra);

# Ensure we can modify properties (retrieve for write)
$period->extra = [];
$period->extra[] = "array";
var_dump($period->extra);

var_dump(isset($period->dynamic1));
$period->dynamic1 = "dynamic";
var_dump($period->dynamic1);

# Ensure we can modify properties (retrieve for write)
$period->dynamic2 = [];
$period->dynamic2[] = "array";
var_dump($period->dynamic2);

$period->dynamic3[] = "array";
var_dump($period->dynamic3);

?>
--EXPECTF--
string(5) "stuff"
string(8) "modified"
array(1) {
  [0]=>
  string(5) "array"
}
bool(false)

Deprecated: Creation of dynamic property DatePeriod@anonymous::$dynamic1 is deprecated in %s on line %d
string(7) "dynamic"

Deprecated: Creation of dynamic property DatePeriod@anonymous::$dynamic2 is deprecated in %s on line %d
array(1) {
  [0]=>
  string(5) "array"
}

Deprecated: Creation of dynamic property DatePeriod@anonymous::$dynamic3 is deprecated in %s on line %d
array(1) {
  [0]=>
  string(5) "array"
}
