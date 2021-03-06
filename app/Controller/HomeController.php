<?php

class HomeController extends AppController {

    public $uses = array('Entry','Story', 'EntryStory');

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow('index');
    }

    public function index() {
        $this->layout = 'home';
        $this->set('stories', $this->EntryStory->find('all', array(
                                             'contain' => array(
                                                 'Story' => array(
                                                     'conditions' => array('Story.published' => 1),
                                                     'StoryType' => array(
                                                         'fields' => array('StoryType.name')
                                                     )
                                                 )
                                             ),
                                             'order' => 'Story.created DESC'
                                         )));
    }
}
