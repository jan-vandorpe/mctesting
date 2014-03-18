<?php
namespace Framework\Exception;

/**
 * Description of dispatcherexception
 *
 * @author cyber02
 */
class FrameworkException extends \Exception
{
    function __construct($message = '', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}
