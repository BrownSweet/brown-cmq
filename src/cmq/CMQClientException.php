<?php
/**
 * Created by Same.Inc
 *
 * Author: flog@same.com
 * CreateAt: 2018/8/21 00:29
 * Description: CMQClientException.php
 */

namespace brown\cmq;

class CMQClientException extends CMQExceptionBase
{
    public function __construct($message, $code = -1, $data = array())
    {
        parent::__construct($message, $code, $data);
    }

    public function __toString()
    {
        return "CMQClientException  " . $this->get_info();
    }
}
