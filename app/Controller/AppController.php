<?php

class AppController extends Controller {

  // We need the Auth component for our authentication system
  // And the Session component is needed for displaying flash messages.
  var $components = array('Auth','Session');

  // if a user is successfully logged in we store that user's record in this variable
  var $current_user = false;

  function beforeFilter() {
    // Specify which controller/action handles logging in:
    $this->Auth->loginAction = array('controller' => 'sessions', 'action' => 'create');
    // Where to redirect to after successfully logging in:
    // This can also be an array() with 'controller' and 'action' keys like above.
    $this->Auth->loginRedirect = '/';
    // Where to redirect to after successfully logging out:
    $this->Auth->logoutRedirect = '/';

    // By default, the Auth component expects a username and a password
    // columns in the User table. But we would like to override those defaults
    // and use the email column instead of the username column.
    $this->Auth->authenticate = array(
        AuthComponent::ALL => array(
            'fields' => array(
                'username' => 'email',
                'password' => 'password'),
            'userModel' => 'Users.User'
        ), 'Form'
    );

    // store a reference to the current user
    $this->current_user = $this->Auth->user();
  }

  function beforeRender()
  {
      // Make the current_user variable available in all of our views
      // For example, in your view you can reach the current user's
      // email address as follows: echo $current_user['email'];
      $this->set('current_user',$this->current_user );
  }
}