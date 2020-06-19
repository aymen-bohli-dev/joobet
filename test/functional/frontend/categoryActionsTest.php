<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
get('/category/:slug')->
with('request')->begin()->
isParameter('module', 'category')->
isParameter('action', 'show')->
end()->
with('response')->begin()->
isStatusCode(200)->
checkElement('body', '!/This is a temporary page/')->
end()
;
