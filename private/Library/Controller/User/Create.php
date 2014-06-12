<?php


class Controller_User_Create {


    // default errors to an empty array
    public $errors = null;

    // default success to false
    public $success = false;


    public function __construct($postData) {

        // if form has been submitted
        if (!empty($postData)) {

            // is the form valid
            if ($this->isValidForm()) {
                // its valid so create the row
                $this->success = $this->create();
            }
        }

        return array('success' => $this->success, 'errors' => $this->errors);
    }


    public function isValidForm() {

        // empty the array
        $this->errors = array();

        // is it a valid email address
        if (isset($_POST['email']) && !empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email Address is not valid';
        }

        // is it a valid name
        if (isset($_POST['name']) && strlen($_POST['name']) < 4) {
            $this->errors['name'] = 'Name must be three letters long';
        }

        // is it a valid name
        if (isset($_POST['phone']) && !empty($_POST['phone']) && !is_numeric($_POST['phone'])) {
            $this->errors['phone'] = 'Phone number must be numeric';
        }

        // fields that cannot be empty
        $cannotBeEmpty = array('name', 'email', 'phone');

        // loop cannot be emptyfields and set them to the errors array if its a problem
        foreach ($cannotBeEmpty as $field) {
            if (empty($_POST[$field])) {
                $this->errors[$field] = $field.' cannot be empty';
            }
        }

        // if errors are empty then return true, its valid
        return empty($this->errors) ? true : false;
    }


    public function create() {
        //create model call would go here
        return true;
    }
}