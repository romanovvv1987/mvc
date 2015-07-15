<?php
namespace models;
use Core\Model;

/**
 * Class User
 * @package models
 */
class Messages extends Model
{

    public function fieldsTable(){
        return array(
            'id' => 'id',
	        'text'=> 'text'

        );
    }

}