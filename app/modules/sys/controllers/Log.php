<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log extends SYS_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('sys/Logview');
    }

    public function index__() {
        $after_id = isset($_GET['after_id']) ? intval($_GET['after_id']) : 0;
        $before_id = isset($_GET['before_id']) ? intval($_GET['before_id']) : 0;
        $limit = 25;
        $this->load->model("model_log");
        $data['logs'] = $this->model_log->get_log($after_id, $before_id, $limit);
        $data['last_id'] = $this->model_log->get_last_id();
        $data['first_id'] = $this->model_log->get_first_id();

        $this->template->load_view("log/index", $data);
    }
    public function index(){
        redirect('sys/log/view_log');
    }
    public function view_log(){
        $data['log'] =  $this->logview->show();
        $data['host'] = gethostname();
        $data['ip'] = $this->get_ip();
        $this->template->load_view('view_log', $data);
    }
    private function get_ip() {
    //Just get the headers if we can or else use the SERVER global.
        if ( function_exists( 'apache_request_headers' ) ) {
            $headers = apache_request_headers();
        }else{
            $headers = $_SERVER;
        }

      //Get the forwarded IP if it exists.
      if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

        $the_ip = $headers['X-Forwarded-For'];

      } elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {

        $the_ip = $headers['HTTP_X_FORWARDED_FOR'];

      } else {
          
        $the_ip = filter_var( $_SERVER['SERVER_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );

      }

      return $the_ip;

    }

}
