<?php
/**
 * Created by Same.Inc
 *
 * Author: flog@same.com
 * CreateAt: 2018/8/21 00:20
 * Description: RequestInternal.php
 */

namespace brown\cmq;

class RequestInternal
{
    public $header;
    public $method;
    public $uri;
    public $data;

    public function __construct($method = "", $uri = "", $header = null, $data = "")
    {
        if ($header == null) {
            $header = array();
        }
        $this->method = $method;
        $this->uri = $uri;
        $this->header = $header;
        $this->data = $data;
    }

    public function __toString()
    {
        $info = array("method" => $this->method,
            "uri" => $this->uri,
            "header" => json_encode($this->header),
            "data" => $this->data);
        return json_encode($info);
    }
}
