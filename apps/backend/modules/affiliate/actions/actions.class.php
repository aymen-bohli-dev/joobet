<?php

require_once dirname(__FILE__) . '/../lib/affiliateGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/affiliateGeneratorHelper.class.php';

/**
 * affiliate actions.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class affiliateActions extends autoAffiliateActions
{
  public function executeListActivate()
  {
    $affiliate = $this->getRoute()->getObject();
    $affiliate->activate();

    /*$email = $this->getMailer()->compose(
      array('bohliaymen5@gmail.com' => 'aym'),
      'teamwebdev2020@gmail.com',
      'test',
      'Jobeet affiliate token'
    );
    $res = $this->getMailer()->send($email);
    var_dump($res);
    die;
*/
    $this->redirect('jobeet_affiliate');
  }

  public function executeListDeactivate()
  {
    $this->getRoute()->getObject()->deactivate();

    $this->redirect('jobeet_affiliate');
  }

  public function executeBatchActivate(sfWebRequest $request)
  {
    $affiliates = JobeetAffiliatePeer::retrieveByPks($request->getParameter('ids'));

    foreach ($affiliates as $affiliate) {
      $affiliate->activate();
    }

    $this->redirect('jobeet_affiliate');
  }

  public function executeBatchDeactivate(sfWebRequest $request)
  {
    $affiliates = JobeetAffiliatePeer::retrieveByPks($request->getParameter('ids'));

    foreach ($affiliates as $affiliate) {
      $affiliate->deactivate();
    }

    $this->redirect('jobeet_affiliate');
  }
}
