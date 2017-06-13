<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Blog\Entity\Comment;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;

class CommentController extends BaseController {
    
    public function indexAction()
    {
        $query = $this->getEntityManager()->createQueryBuilder();
        
        $query ->select('a')
                ->from('Blog\Entity\Comment', 'a')
                ->orderBy('a.id', 'DESC');   
        
        //$query ->add('select','a')
           //     ->add( 'from','Blog\Entity\Comment a')
           //     ->add('orderBy','a.id DESC');  
        
        $adapter = new DoctrineAdapter(new ORMPaginator($query));
        
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(5);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        
        return array('comments' => $paginator);
    }
    
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $status = 'success';
        $message = 'The comment deleted';
        
        try {
            $repository = $em->getRepository('Blog\Entity\Comment');
            $comment = $repository->find($id);
            $em->remove($comment);
            $em->flush();
        }
        catch(\Exception $ex){
            $status = 'error';
            $message = 'Error removing the comment: ' . $ex->getMessage();
        }
        $this->flashMessenger()->setNamespace($status)
                ->addMessage($message);

        return $this->redirect()->toRoute('admin/comment');
    }
}