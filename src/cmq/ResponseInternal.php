<?php
/**
 * Created by Same.Inc
 *
 * Author: flog@same.com
 * CreateAt: 2018/8/21 00:20
 * Description: ResponseInternal.php
 */

namespace brown\cmq;

class ResponseInternal
{
    public $header;
    public $status;
    public $data;

    public function __construct($status = 0, $header = null, $data = "")
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
        return json_encode($info);
    }
}
