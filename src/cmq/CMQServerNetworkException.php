<?php
/**
 * Created by Same.Inc
 *
 * Author: flog@same.com
 * CreateAt: 2018/8/21 00:27
 * Description: CMQServerNetworkException.php
 */

namespace brown\cmq;

class CMQServerNetworkException extends CMQExceptionBase
{
    //服务器网络异常

    public $status;
    public $header;
    public $data;

    public function __construct($status = 200, $header = null, $data = "")
    {
        if ($header == null) {
            $header = array();
        }
        $this->status = $status;
        $this->header = $header;
        $this->data = $data;
    }

    public function __toString()
    {
        $info = array("status" => $this->status,
            "header" => json_encode($this->header),
            "data" => $this->data);

        return "CMQServerNetworkException  " . json_encode($info);
    }
}
