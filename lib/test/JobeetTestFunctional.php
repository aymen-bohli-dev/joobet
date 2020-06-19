<?php
// lib/test/JobeetTestFunctional.class.php
class JobeetTestFunctional extends sfTestFunctional
{
    public function loadData()
    {
        $loader = new sfPropelData();
        $loader->loadData(sfConfig::get('sf_test_dir').'/fixtures');

        return $this;
    }

    public function getProgrammingCategory()
    {
      $criteria = new Criteria();
      $criteria->add(JobeetCategoryPeer::SLUG, 'programming');
   
      return JobeetCategoryPeer::doSelectOne($criteria);
    }
}