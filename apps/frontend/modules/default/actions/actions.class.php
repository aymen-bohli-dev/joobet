<?php

/**
 * category actions.
 *
 * @package    jobeet
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
    /**
     * @param sfWebRequest $request
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->categories = JobeetCategoryPeer::getWithJobs();
    }

}