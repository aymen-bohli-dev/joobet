<?php

/**
 * category actions.
 *
 * @package    jobeet
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeShow(sfWebRequest $request)
    {
        $this->category = $this->getRoute()->getObject();

        $this->pager = new sfPropelPager(
            'JobeetJob',
            sfConfig::get('app_max_jobs_on_category')
        );
        $this->pager->setCriteria($this->category->getActiveJobsCriteria());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

}
