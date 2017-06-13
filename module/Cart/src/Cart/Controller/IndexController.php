<?php

namespace Cart\Controller;

use Application\Controller\BaseAdminController as BaseController;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Blog\Entity\Comment;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        $user =  $auth->getIdentity();
        $id = $user->getId();
        $request = $this->getRequest();
        $data = $request->getPost();
        $response = "ok";
        json_encode($response);
        if(isset($data)){
            var_dump($data);
            return array('id' => $id, 'data' =>$data);
        }
       return array('id' => $id);
    }
    public function bookInTheCart(){
        $request = $this->getRequest();
        $data = $request->getPost();
        var_dump($data);
    }
}