<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 */
class jobActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        if (!$request->getParameter('sf_culture')) {
            if ($this->getUser()->isFirstRequest()) {
                $culture = $request->getPreferredCulture(array('en', 'fr'));
                $this->getUser()->setCulture($culture);
                $this->getUser()->isFirstRequest(false);
            } else {
                $culture = $this->getUser()->getCulture();
            }

            $this->redirect('localized_homepage');
        }
        $this->categories = JobeetCategoryPeer::getWithJobs();
    }


    public function executeShow(sfWebRequest $request)
    {

        $this->JobeetJob = JobeetJobPeer::retrieveByPk($request->getParameter('id'));

        $this->job = $this->getRoute()->getObject();
        $this->getUser()->addJobToHistory($this->job);

        $this->forward404Unless($this->JobeetJob);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new JobeetJobForm();
    }


    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new JobeetJobForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($JobeetJob = JobeetJobPeer::retrieveByPk($request->getParameter('id')), sprintf('Object JobeetJob does not exist (%s).', $request->getParameter('id')));
        $this->form = new JobeetJobForm($JobeetJob);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($JobeetJob = JobeetJobPeer::retrieveByPk($request->getParameter('id')), sprintf('Object JobeetJob does not exist (%s).', $request->getParameter('id')));
        $this->form = new JobeetJobForm($JobeetJob);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($JobeetJob = JobeetJobPeer::retrieveByPk($request->getParameter('id')), sprintf('Object JobeetJob does not exist (%s).', $request->getParameter('id')));
        $JobeetJob->delete();

        $this->redirect('job/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $JobeetJob = $form->save();

            $this->redirect('job/edit?id=' . $JobeetJob->getId());
        }
    }

    public function executePublish(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $job = $this->getRoute()->getObject();
        $job->publish();

        $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));

        $this->redirect('job_show_user', $job);
    }

    public function executeSearch(sfWebRequest $request)
    {

        $query = $request->getParameter('query');

        $this->forwardUnless($query, 'job', 'index');

        $this->jobs = JobeetJobPeer::getForLuceneQuery($query);

        if ($request->isXmlHttpRequest()) {
            if ('*' == $query || !$this->jobs) {
                return $this->renderText('No results.');
            }

            return $this->renderPartial('job/list', array('jobs' => $this->jobs));
        }
    }
}
