<?php
namespace Riot\Exceptions;

use Guzzle\Common\Exception\RuntimeException;

/**
* @package MyExceptions
* MyWrongTypeException occurs when an object or 
* datastructure is of the incorrect datatype.
* Program defensively!
* @param $objectName string name of object, eg "\$myObject"
* @param $object object object of the wrong type
* @param $expect string expected type of object eg 'integer'
* @param $message any additional human readable info.
* @param $code error code.
* @return Informative exception error message.
* @author secoif
*/
class WrongHttpResponse extends RuntimeException {
    public function __construct($message = '', $code = 0) {     
        return parent::__construct($message, $code);
    }
}