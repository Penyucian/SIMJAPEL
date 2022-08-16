<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller
{

    private $_ci;
    public $user_id;
    public $user_id_encrypt;
    public $date_today;
    public $user_email;

    public function __construct()
    {
        parent::__construct();
        $this->_ci = &get_instance();
        if ($this->config->item('layout_folder')) {
            $this->template->set_layout_folder($this->config->item('layout_folder'));
        }
        if ($this->config->item('layout')) {
            $this->template->set_layout($this->config->item('layout'));
        }

        $this->initialize();
    }

    public function debugToFile($params)
    {
        fwrite(fopen("debug.txt", "w"), print_r($params, TRUE));
    }

    public function info($m)
    {
        $link = base_url();

        echo $this->template->load_view('layouts/default/blank', array(
            'title' => 'Error Occured',
            'description' => NULL,
            'metadata' => NULL,
            'js' => NULL,
            'css' => NULL,
            'content' => ''
        ), TRUE);

        die("<script language=\"javascript\">$('#subcontent-element').html('<div class=\"page-header\">"
            . "<div class=\"row\"><h1 class=\"col-xs-12 col-sm-12 text-left-sm\">"
            . "<i class=\"fa fa-unlink page-header-icon\"></i>"
            . "&nbsp;Error Occured</h1></div></div>"
            . "<div class=\"note note-danger\">$m</div>"
            . "<div class=\"col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right\">"
            . "<a href=\"$link\" class=\"btn btn-primary btn-block\">"
            . "<span class=\"btn-label-icon left fa fa-arrow-left\"></span>Kembali ke homepage</a></div>');</script>");
    }

    private function initialize()
    {
        date_default_timezone_set($this->config->item('timezone'));
        $this->user_id = $this->session->userdata('__user_id');
        $this->user_email = $this->session->userdata('__email');
        $this->user_id_encrypt = $this->encryption_lib->urlencode($this->user_id);
        $this->date_today = date("Y-m-d H:i:s");
    }
}

if (file_exists(APPPATH . 'controllers/SYS_Controller.php')) {
    require APPPATH . 'controllers/SYS_Controller.php';
} else {
    class SYS_Controller extends MY_Controller
    {
        public function __construct()
        {
            parent::__construct();

            if ($this->config->item('debug')) {
                $this->output->enable_profiler(TRUE);
            }

            $this->access_right();
        }

        public function info($m)
        {
            if (!$this->user_id) {
                show_404('', FALSE);
                exit();
            }

            $link = base_url();

            echo $this->template->load_view('layouts/default/blank', array(
                'title' => 'Error Occured',
                'description' => NULL,
                'metadata' => NULL,
                'js' => NULL,
                'css' => NULL,
                'content' => ''
            ), TRUE);

            die("<script language=\"javascript\">$('#subcontent-element').html('<div class=\"page-header\">"
                . "<div class=\"row\"><h1 class=\"col-xs-12 col-sm-12 text-left-sm\">"
                . "<i class=\"fa fa-unlink page-header-icon\"></i>"
                . "&nbsp;Error Occured</h1></div></div>"
                . "<div class=\"note note-danger\">$m</div>"
                . "<div class=\"col-xs-12 width-md-auto width-lg-auto width-xl-auto pull-md-right\">"
                . "<a href=\"$link\" class=\"btn btn-primary btn-block\">"
                . "<span class=\"btn-label-icon left fa fa-arrow-left\"></span>Kembali ke homepage</a></div>');</script>");
        }

        private function access_right()
        {
            $module = $this->router->module;
            $controller = $this->router->class;
            $function = $this->router->method;

            $arrayControllerByPass = array('modal');
            if (in_array($controller, $arrayControllerByPass)) {
                return TRUE;
            }

            if ($function === 'index') {
                return TRUE;
            }

            $arrayModuleAndControllerByPass = array(
                array('module' => 'sys', 'controller' => 'change_group')
            );

            foreach ($arrayModuleAndControllerByPass as $obj) {
                if ($obj['module'] === $module && $obj['controller'] === $controller) {
                    return TRUE;
                }
            }

            $arrUserAccess = $this->user_auth_lib->access_right();

            $permission = TRUE;
            $modulePermission = FALSE;
            $controllerPermission = FALSE;
            $functionRegistered = FALSE;

            foreach ($arrUserAccess as $userAccess) {
                if ($userAccess->module === $module) {
                    $modulePermission = TRUE;
                    if ($userAccess->controller === $controller) {
                        if (!empty($userAccess->controller_permissions)) {
                            $controllerPermission = TRUE;
                            if ($function === "index") {
                                $functionRegistered = TRUE;
                                break;
                            } else {
                                if ($userAccess->function === $function) {
                                    if (!empty($userAccess->function)) {
                                        $functionRegistered = TRUE;
                                        $arrFunctionPermissions = str_split(strtolower($userAccess->function_permissions));
                                        foreach ($arrFunctionPermissions as $functionPermission) {
                                            if ($functionPermission !== 'x') {
                                                if (!(strpos($userAccess->controller_permissions, $functionPermission) !== FALSE)) {
                                                    $permission = FALSE;
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        $functionRegistered = FALSE;
                                    }
                                    break;
                                }
                            }
                        } else {
                            $controllerPermission = FALSE;
                            break;
                        }
                    }
                }
            }

            if (!$modulePermission) {
                if (!$this->input->is_ajax_request()) {
                    show_404('', FALSE);
                } else {
                    $this->response_ajax_not_permission();
                }
            }

            if (!$controllerPermission) {
                if (!$this->input->is_ajax_request()) {
                    show_404('', FALSE);
                } else {
                    $this->response_ajax_not_permission();
                }
            }

            if (!$functionRegistered) {
                $permission = FALSE;
            }

            if (!$permission) {
                if (!$this->input->is_ajax_request()) {
                    show_404('', FALSE);
                } else {
                    $this->response_ajax_not_permission();
                }
            }
        }

        private function response_ajax_not_permission()
        {
            $this->load->library('sys/response');
            $this->response->reload_page();
            $this->response->send();
        }

        public function redirect_page($result)
        {
            return $this->response->script("
			$('.busy-indicator').show();
			$('#subcontent-element').fadeOut().load('$result[2]', function(){
                $(this).fadeIn(200);        
                $('.busy-indicator').fadeOut();
				$.growl.$result[0]({ message: '$result[1]', size: 'large'});
            })
			");
        }

        public function redirect_page_modal($result)
        {
            return $this->response->script("
			$('.busy-indicator').show();
			$('.modal').modal('hide');
			$('#subcontent-element').fadeOut().load('$result[2]', function(){
                $(this).fadeIn(200);        
                $('.busy-indicator').hide();
				$.growl.$result[0]({ message: '$result[1]', size: 'large'});
            })
			");
        }

        public function redirect_page_basic_modal($result)
        {
            return $this->response->script("
			$('#modal-data-basic').fadeOut().load('$result[2]', function(){
                $(this).fadeIn(200);        
				$.growl.$result[0]({ message: '$result[1]', size: 'large'});
            })
			");
        }

        public function insert_data_user_information($array)
        {
            $insertInformation = array(
                'created_by' => $this->user_id,
                'created_time' => $this->date_today,
                'updated_by' => $this->user_id,
                'updated_time' => $this->date_today
            );

            return array_merge($array, $insertInformation);
        }

        public function update_data_user_information($array)
        {
            $updateInformation = array(
                'updated_by' => $this->user_id,
                'updated_time' => $this->date_today
            );

            return array_merge($array, $updateInformation);
        }
    }
}

class REST_Controller extends MX_Controller
{

    public function rest_login()
    {
        $checkLogin = $this->user_auth_lib->do_login(array(
            'username' => $_SERVER['PHP_AUTH_USER'],
            'password' => $_SERVER['PHP_AUTH_PW'],
            'date_today' => date("Y-m-d"),
            'device_id' => 1
        ), 'basic');

        if ($checkLogin['resId'] == 1) {
            return TRUE;
        } elseif ($checkLogin['resId'] == 2) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            $this->rest_response(['error' => 'Account tidak aktif. Silahkan hubungi administrator yang bersangkutan'], 403);
        } else {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            $this->rest_response(['error' => 'Username atau Password salah'], 403);
        }
    }

    public function rest_response($response, $http_code = 200)
    {
        header('X-PHP-Response-Code: ' . $http_code, true, $http_code);

        $format = isset($_GET['format']) ? $_GET['format'] : "json";
        switch ($format) {
            case "json":
                header("Content-Type:application/json; charset=utf-8");
                echo json_encode($response);
                break;
            default:
                header("Content-Type:application/json; charset=utf-8");
                echo json_encode($response);
                break;
        }
        die;
    }

    public function rest_request($url, $params = [], $method = "GET")
    {
        $query_string = http_build_query($params);

        $process = curl_init();
        curl_setopt($process, CURLOPT_TIMEOUT, 5);
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_USERPWD, "sinta" . ":" . "sintal");
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);

        if ($method == "POST") {
            curl_setopt($process, CURLOPT_POST, TRUE);
            if (!empty($query_string)) {
                curl_setopt($process, CURLOPT_POSTFIELDS, $query_string);
            }
        } elseif ($method == "GET") {
            if (!empty($query_string)) {
                $url .= "?" . $query_string;
            }
        }

        curl_setopt($process, CURLOPT_URL, $url);

        $data = json_decode(curl_exec($process));
        curl_close($process);

        return $data;
    }
}
