<?php
namespace Framework\Exception;

/**
 * Description of dispatcherexception
 *
 * @author cyber02
 */
class DispatcherException extends \Exception
{
     function __construct($message = '', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
