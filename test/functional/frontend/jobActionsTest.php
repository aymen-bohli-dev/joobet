<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

///$browser = new sfTestFunctional(new sfBrowser());
$browser = new JobeetTestFunctional(new sfBrowser());


$browser->
  get('/job/index')->

  with('request')->begin()->
    isParameter('module', 'job')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;


