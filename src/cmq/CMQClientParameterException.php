<?php
/**
 * Created by Same.Inc
 *
 * Author: flog@same.com
 * CreateAt: 2018/8/21 00:27
 * Description: CMQClientParameterException.php
 */

namespace brown\cmq;

class CMQClientParameterException extends CMQClientException
{
    /* 参数格式错误

    @note: 请根据提示修改对应参数;
     */
    public function __construct($message, $code = -1, $data = array())
    {
        parent::__construct($message, $code, $data);
    }

    public function __toString()
    {
        return "CMQClientParameterException  " . $this->get_info();
    }
}
