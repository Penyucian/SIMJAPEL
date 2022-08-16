<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Encryption_lib {

    public $CI;
    private $params;

    function __construct() {
        $this->CI = & get_instance();
        $this->setup();
    }

    public function setup($params = NULL) {
        $this->params = array(
            'cipher' => isset($params['cipher']) ? $params['cipher'] : $this->CI->encryption->cipher,
            'mode' => isset($params['mode']) ? $params['mode'] : $this->CI->encryption->mode,
            'key' => isset($params['key']) ? $params['key'] : config_item('encryption_key'),
            'raw_data' => isset($params['raw_data']) ? $params['raw_data'] : FALSE,
            'hmac' => isset($params['hmac']) ? $params['hmac'] : FALSE,
            'hmac_digest' => isset($params['hmac_digest']) ? $params['hmac_digest'] : 'sha224',
            'hmac_key' => isset($params['hmac_key']) ? $params['hmac_key'] : config_item('encryption_key')
        );
    }

    public function urlencode($str, $params = NULL) {
        $this->setup($params);
        
        $encrypt = strtr($this->CI->encryption->encrypt($str, $this->params), '+/=', '-_');
        return $encrypt;
    }

    public function urldecode($str, $params = NULL) {
        $this->setup($params);
        
        $decrypt = $this->CI->encryption->decrypt(strtr($str, '-_,', '+/='), $this->params);
        return $decrypt;
    }

}
