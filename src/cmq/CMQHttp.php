<?php

namespace brown\cmq;

class CMQHttp
{
    private $connection_timeout;
    private $keep_alive;
    private $host;

    public function __construct($host, $connection_timeout = 10, $keep_alive = true)
    {
        $this->connection_timeout = $connection_timeout;
        $this->keep_alive = $keep_alive;
        $this->host = $host . "" . "/v2/index.php";
        $this->curl = null;
    }

    public function set_method($method = 'POST')
    {
        $this->method = $method;
    }

    public function set_connection_timeout($connection_timeout)
    {
        $this->connection_timeout = $connection_timeout;
    }

    public function set_keep_alive($keep_alive)
    {
        $this->keep_alive = $keep_alive;
    }

    public function is_keep_alive()
    {
        return $this->keep_alive;
    }

    public function send_request($req_inter, $userTimeout)
    {
        if (!$this->keep_alive) {
            $this->curl = curl_init();
        } else {
            if ($this->curl == null) {
                $this->curl = curl_init();
            }

        }

        if ($this->curl == null) {
            throw new CMQClientException("Curl init failed");
            return;
        }

        $url = $this->host;
        if ($req_inter->method == 'POST') {
            curl_setopt($this->curl, CURLOPT_POST, 1);
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $req_inter->data);
        } else {
            $url .= $req_inter->uri . '?' . $req_inter->data;
        }

        if (isset($req_inter->header)) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, $req_inter->header);
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->connection_timeout + $userTimeout);

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        if (false !== strpos($url, "https")) {
            // 证书
            // curl_setopt($ch,CURLOPT_CAINFO,"ca.crt");
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $resultStr = curl_exec($this->curl);
        if (curl_errno($this->curl)) {
            throw new CMQClientNetworkException(curl_error($this->curl));
        }
        $info = curl_getinfo($this->curl);
        $resp_inter = new ResponseInternal($info['http_code'], null, $resultStr);
        return $resp_inter;
    }
}
