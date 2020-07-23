<?php
namespace News\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class NewsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('news');
        $this->setAttribute('method', 'post');
        // $this->setInputFilter(new \News\Form\NewsInputFilter());
        // $this->setAttribute('enctype', 'multipart/form-data');
        // $this->add(array(
        //     'name' => 'security',
        //     'type' => 'Zend\Form\Element\Csrf',
        // ));
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'created',
            'type' => 'Hidden',
        ));
        
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'min' => 3,
                'max' => 25,
                'label' => 'Название новости',
            ),
        ));
        $this->add(array(
            'name' => 'preview',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Аннонс новости',
            ),
        ));
        $this->add(array(
            'name' => 'body_text',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Текст новости',
            ),
        ));
        $this->add(array(
            'name' => 'publish',
            'type' => 'Checkbox',
            'options' => array(
                'label' => 'Публикация',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Save',
                'id' => 'submitbutton',
            ),
        ));
    }
}