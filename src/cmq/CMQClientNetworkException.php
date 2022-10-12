<?php
/**
 * Created by Same.Inc
 *
 * Author: flog@same.com
 * CreateAt: 2018/8/21 00:28
 * Description: CMQClientNetworkException.php
 */

namespace brown\cmq;

class CMQClientNetworkException extends CMQClientException
{
    /* 网络异常

    @note: 检查endpoint是否正确、本机网络是否正常等;
     */
    public function __construct($message, $code = -1, $data = array())
    {
        parent::__construct($message, $code, $data);
    }

    public function __toString()
    {
        return "CMQClientNetworkException  " . $this->get_info();
    }
}
