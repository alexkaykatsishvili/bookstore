<?php

namespace Application\Controller;


class BaseAdminController extends BaseController
{
    protected $entityManager;
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
        if(! $this->identity()){
            return $this->redirect()->toRoute('auth-doctrine/default', array('controller' => 'index', 'action' => 'login'));
        }
        return parent::onDispatch($e);  
    }

}