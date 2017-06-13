<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Admin\Form\CategoryAddForm;
use Blog\Entity\Category;

class CategoryController extends BaseController
{
    public function indexAction()
    {
        //$entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        //$em = $this->getEntityManager();
        
        $query = $this->getEntityManager()->createQuery('SELECT u FROM Blog\Entity\Category u ORDER BY u.id DESC');
        $rows = $query->getResult();
        
        return array('category' => $rows);
        
    }
    
    public function addAction() {
        $form = new CategoryAddForm;
        $status = $message = '';
        $em = $this->getEntityManager();
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $category = new Category();
                $category->exchangeArray($form->getData());
                $em->persist($category);
                $em->flush();
                $status = 'success';
                $message = 'Category added';
            } else {
                $status = 'error';
                $message = 'Parameter error';
            }
        } else {
            return array('form' => $form);
        }            
        if($message){
            $this->flashMessenger()->setNamespace($status)
                    ->addMessage($message);
        }
        return $this->redirect()->toRoute('admin/category');
    }
    
    
    public function editAction() {
        $status = $message = '';
        $em = $this->getEntityManager();
        $form = new CategoryAddForm;
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $category = $em->find('Blog\Entity\Category', $id);
        if(empty($category)){
            $status = 'error';
            $message = 'Category not found';
            $this->flashMessenger()->setNamespace($status)
                    ->addMessage($message);
            return $this->redirect()->toRoute('admin/category');
        }
        
        $form->bind($category);
        $request = $this->getRequest();
        
        if($request->isPost()){
            $data = $request->getPost();
            $form->setData($data);
            if($form->isValid()){
                $em->persist($category);
                $em->flush();
                
                $status = 'success';
                $message = 'Category updated';
            } else {
                $status = 'success';
                $message = 'Parameter error';
                foreach($form->getInputFilter()->getInvalidInput() as $errors){
                    foreach ($errors->getMessages() as $error){
                        $message .= ' ' . $error;
                    }
                }
            }
        } else {
            return array('form' => $form, 'id' => $id);
        }
        if($message){
            $this->flashMessenger()->setNamespace($status)
                    ->addMessage($message);
        }
        return $this->redirect()->toRoute('admin/category');
    }
    
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $status = 'success';
        $message = 'Post deleted';
        
        try {
            $repository = $em->getRepository('Blog\Entity\Category');
            $category = $repository->find($id);
            $em->remove($category);
            $em->flush();
        }
        catch(\Exception $ex){
            $status = 'error';
            $message = 'Error removing post: ' . $ex->getMessage();
        }
        $this->flashMessenger()->setNamespace($status)
                ->addMessage($message);

        return $this->redirect()->toRoute('admin/category');
    }
}

