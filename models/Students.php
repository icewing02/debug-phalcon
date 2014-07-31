<?php
use Phalcon\Mvc\Model,
    Phalcon\Mvc\Model\Message,
    Phalcon\Mvc\Model\Validator\PresenceOf,
    Phalcon\Mvc\Model\Validator\Email;

class Students extends Model {

    public function validation() {
        $this->validate(new PresenceOf(
            array(
                'field'  => 'id',
                'message' => 'The ID is required'
            )
        ));
        $this->validate(new PresenceOf(
            array(
                'field'  => 'name',
                'message' => 'The name is required'
            )
        ));
        $this->validate(new PresenceOf(
            array(
                'field'  => 'email',
                'message' => 'The email is required'
            )
        ));
        $this->validate(new Email(
            array(
                'field'  => 'email',
                'message' => 'The email is not valid'
            )
        ));

        if(true == $this->validationHasFailed()) {
            return false;
        }
    }

}