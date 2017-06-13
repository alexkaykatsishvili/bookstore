<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Admin\Filter\ArticleAddInputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Blog\Entity\Article;

class ArticleAddForm extends Form implements ObjectManagerAwareInterface {
    
    protected $objectManager;

    public function setObjectManager(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }
    
    public function getObjectManager() {
        return $this->objectManager;
    }
    
    public function __construct(ObjectManager $objectManager) {
        parent::__construct('articleAddForm');
        $this->setObjectManager($objectManager);
        $this->createElements();
    }
    
    public function createElements() {
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bs-example form-horizontal');
        
        $this->setInputFilter(new ArticleAddInputFilter());
        
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'category',  
            'options' => array(
                'label' => 'Category',
                'empty_option' => 'Choose a category...',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Blog\Entity\Category',
                'property' => 'categoryName',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));
        
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',   
            'options' => array(
                'label' => 'Title',
                'min' => 3,
                'max' => 100,
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));
        
        $this->add(array(
            'name' => 'shortArticle',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Start of article',
            ),
            'attributes' => array(
                'class' => 'form-control ckeditor',
            ),
        ));
        
        $this->add(array(
            'name' => 'article',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Article',
            ),
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'bookImg',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name of the book',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'price',
            'type' => 'Text',
            'options' => array(
                'label' => 'Price',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'isPublic',
            'type' => 'Checkbox',           
            'options' => array(
                'label' => 'Publish',
                'use_hidden_Element' => true,
                'checked_value' => 1,
                'unchecked_value' => 0
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',           
            'attributes' => array(
                'value' => 'Save',
                'id' => 'btn_submit',
                'class' => 'btn btn-primary',
            ),
        ));
    }
}