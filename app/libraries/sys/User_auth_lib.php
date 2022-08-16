<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/sys/BO.php')) {
    require 'BO.php';
} else {
    class BO
    {

        public $CI = NULL;

        public function __construct()
        {
            $this->CI = &get_instance();
        }

        protected function _set_init_session($data)
        {
            $sessionData = array(
                '__user_id' => $data->user_id,
                '__username' => $data->user_username,
                '__img' => $data->user_image,
                '__unit_id' => $data->user_unit_id,
                '__group_menu_id' => $data->group_menu_id,
                '__group_menu_nama' => $data->group_menu_nama,
                '__user_tipe_nomor' => $data->user_tipe_nomor,
                '__nama_lengkap' => $data->user_nama_lengkap,
                '__email' => $data->user_email,
                '__platform' => $data->platform
            );

            $this->CI->session->set_userdata($sessionData);
        }

        public function log_login($data)
        {
            if ($this->CI->db->get_where('sys_log_login', array('user_id' => $data['user_id'], 'created_time' => $data['created_time']))->num_rows() === 0) {
                $this->CI->db->insert('sys_log_login', $data);
            }
        }

        protected function _basic_login($param)
        {
            $this->CI->db->select('a.user_id, a.user_username, a.user_unit_id,'
                . 'a.user_image, a.user_nama_lengkap, a.user_tipe_nomor,'
                . 'a.user_is_aktif, a.user_email,'
                . 'b.group_menu_id, c.group_menu_nama');
            $this->CI->db->from('sys_user a');
            $this->CI->db->join('sys_user_access b', 'a.user_id = b.user_id');
            $this->CI->db->join('sys_group_menu c', 'b.group_menu_id = c.group_menu_id');
            $this->CI->db->where('a.user_username', $param['username']);
            $this->CI->db->where('a.user_password="' . $this->pwd_encrypt($param['password']) . '"', '', false);
            $result = $this->CI->db->get();

            if ($result->num_rows() === 0) {
                return array('resId' => 0, 'sesId' => NULL);
            } else {
                $user = $result->row();

                $_ = $this->check_user_agent($param, $user);
                $user->platform = $_['platform'];

                if ($user->user_is_aktif === '1') {
                    $this->_set_init_session($user);
                    $this->log_login(array(
                        'user_id' => $user->user_id,
                        'user_username' => $user->user_username,
                        'user_agent' => $_['uagent'],
                        'created_time' => $param['date_today']
                    ));

                    return array('resId' => 1, 'sesId' => $_['sesId']);
                } else {
                    return array('resId' => 2, 'sesId' => $_['sesId']);
                }
            }
        }
        public function select_user_access_by_user_id($userId)
        {
            return $this->CI->db->query("
            SELECT 
              c.`group_menu_id`,
              c.`group_menu_nama`,
              a.`user_tipe_nomor` 
            FROM
              `sys_user` a 
              JOIN `sys_user_access` b 
                ON a.`user_id` = b.`user_id` 
              JOIN `sys_group_menu` c 
                ON b.`group_menu_id` = c.`group_menu_id` 
            WHERE a.`user_id` = '$userId'")->result_array();
        }

        public function change_session($userId, $groupMenuId, $groupMenuNama, $userTipeNomor)
        {
            $this->CI->db->select('a.user_id');
            $this->CI->db->from('sys_user a');
            $this->CI->db->join('sys_user_access d', 'a.user_id = d.user_id', 'left');
            $this->CI->db->join('sys_group_menu e2', 'd.group_menu_id = e2.group_menu_id', 'left');
            $this->CI->db->where('a.user_id', $userId);
            $this->CI->db->where("(e2.group_menu_id = $groupMenuId)");
            $this->CI->db->where('a.user_is_aktif', 1);

            $_ = $this->CI->db->get();
            if ($_->num_rows() > 0) {
                $sessionData = array(
                    '__group_menu_id' => $groupMenuId,
                    '__group_menu_nama' => $groupMenuNama,
                    '__user_tipe_nomor' => $userTipeNomor,
                );
                $this->CI->session->set_userdata($sessionData);
            }

            return TRUE;
        }

        public function is_login()
        {
            if ($this->CI->session->userdata('__user_id')) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        public function username()
        {
            return $this->CI->session->userdata('__username');
        }

        public function do_login($param = null, $metode = 'basic')
        {
            return $this->_basic_login($param);
        }

        public function pwd_encrypt($pwd)
        {
            $encrytKey = $this->CI->config->item('encryption_key');
            return MD5(SHA1($pwd . $encrytKey));
        }

        public function restrict($module = null, $controller = null, $function = null)
        {
            if ($function) {
                if ($function == 'view_' . $controller) {
                    redirect(base_url());
                } else {
                    redirect($module . '/' . $controller);
                }
            } elseif ($controller) {
                redirect(site_url($module . '/' . $controller));
            } elseif ($module) {
                redirect(base_url());
            } else {
                $arrMenu = $this->menu();

                if (!empty($arrMenu[0]->id)) {
                    foreach ($arrMenu as $menu) {
                        if (!empty($menu->controller)) {
                            $function = !empty($menu->function) ? $menu->function : 'index';
                            redirect($menu->module . '/' . $menu->controller
                                . '/' . $function);
                            break;
                        }
                    }
                } else {
                    show_404('', FALSE);
                }
            }
        }

        public function usermenu($groupId)
        {
            $this->CI->db->select(" m.`menu_id` AS id,
                                m.`menu_parent_id` AS parent_id,
                                m.`menu_nama` AS menu,
                                m.`menu_sequence` AS sequence,
                                m.`menu_css_clip` AS css_clip,
                                m.`menu_label` AS label,
                                m.`menu_css_label` AS css_label,                                
                                IF(ISNULL(m.`controller_id`),mo.`module_nama`,mo1.`module_nama`) AS `module`,
                                IF(ISNULL(m.`controller_id`),c.`controller_nama`,c1.`controller_nama`) AS `controller`,
                                md.`module_detail_function` AS `function`,
                                0 AS `open`,
                                0 AS `aktif`
                            ", FALSE);
            $this->CI->db->from('sys_group_menu as gm');
            $this->CI->db->join('sys_group_menu_detail as gmd', 'gm.group_menu_id = gmd.group_menu_id', 'left');
            $this->CI->db->join('sys_menu as m', 'gmd.menu_id = m.menu_id', 'left');
            $this->CI->db->join('sys_module_detail as md', 'm.module_detail_id = md.module_detail_id', 'left');
            $this->CI->db->join('sys_controller as c', 'md.controller_id = c.controller_id', 'left');
            $this->CI->db->join('sys_module as mo', 'c.module_id = mo.module_id', 'left');
            $this->CI->db->join('sys_controller as c1', 'm.controller_id = c1.controller_id', 'left');
            $this->CI->db->join('sys_module as mo1', 'c1.module_id = mo1.module_id', 'left');
            $this->CI->db->where('gm.group_menu_id', $groupId);
            $this->CI->db->where('m.menu_is_aktif', 1);
            $this->CI->db->group_by('m.menu_id');
            $this->CI->db->order_by('m.menu_parent_id,m.menu_sequence');

            return $this->CI->db->get()->result();
        }

        public function user_access_right($groupId)
        {
            $this->CI->db->select(" md.module_detail_id,
                                mo.`module_nama` AS module,
                                c.`controller_nama` AS controller,
                                md.`module_detail_function` AS `function`,
                                GROUP_CONCAT(gmd.`group_menu_detail_module_permissions` SEPARATOR '') AS controller_permissions,
                                md.`module_detail_is_ajax` AS is_ajax,
                                md.`module_detail_permissions` AS function_permissions ", FALSE);
            $this->CI->db->from('sys_group_menu as gm');
            $this->CI->db->join('sys_group_menu_detail as gmd', 'gm.group_menu_id = gmd.group_menu_id');
            $this->CI->db->join('sys_menu as m', 'gmd.menu_id = m.menu_id');
            $this->CI->db->join('sys_controller c', 'm.controller_id = c.controller_id');
            $this->CI->db->join('sys_module_detail as md', 'm.module_detail_id = md.module_detail_id');
            $this->CI->db->join('sys_module as mo', 'md.module_id = mo.module_id');

            $this->CI->db->where('gm.group_menu_id', $groupId);
            $this->CI->db->where('m.module_detail_id IS NOT NULL', null, false);
            $this->CI->db->group_by(array('md.module_detail_id'));
            $q1 = $this->CI->db->get()->result_array();
            $idMenu = array_column($q1, 'module_detail_id');

            $this->CI->db->select(" md.module_detail_id,
                                mo.`module_nama` AS module,
                                c.`controller_nama` AS controller,
                                md.`module_detail_function` AS `function`,
                                GROUP_CONCAT(gmd.`group_menu_detail_module_permissions` SEPARATOR '') AS controller_permissions,
                                md.`module_detail_is_ajax` AS is_ajax,
                                md.`module_detail_permissions` AS function_permissions ", FALSE);
            $this->CI->db->from('sys_group_menu as gm');
            $this->CI->db->join('sys_group_menu_detail as gmd', 'gm.group_menu_id = gmd.group_menu_id');
            $this->CI->db->join('sys_menu as m', 'gmd.menu_id = m.menu_id');
            $this->CI->db->join('sys_controller c', 'm.controller_id = c.controller_id');
            $this->CI->db->join('sys_module_detail as md', 'c.controller_id = md.controller_id');
            $this->CI->db->join('sys_module as mo', 'md.module_id = mo.module_id');

            $this->CI->db->where('gm.group_menu_id', $groupId);
            $this->CI->db->where('m.module_detail_id IS NULL', null, false);
            if ($idMenu) {
                $this->CI->db->where_not_in('md.module_detail_id', $idMenu);
            }
            $this->CI->db->group_by(array('md.module_detail_id'));

            $q2 = $this->CI->db->get()->result_array();

            return (object) json_decode(json_encode(array_merge_recursive($q1, $q2)));
        }

        public function menu()
        {
            return $this->usermenu($this->CI->session->userdata('__group_menu_id'));
        }

        public function access_right()
        {
            return $this->user_access_right(
                ($this->CI->session->userdata('__group_menu_id')) ?
                    $this->CI->session->userdata('__group_menu_id') : 3
            );
        }

        public function select_function($module, $controller, $function)
        {
            $this->CI->db->select("md.*");
            $this->CI->db->from('sys_module_detail as md');
            $this->CI->db->join('sys_controller as c', 'md.controller_id = c.controller_id');
            $this->CI->db->join('sys_module as mo', 'c.module_id = mo.module_id');
            $this->CI->db->where('mo.module_nama', $module);
            $this->CI->db->where('c.controller_nama', $controller);
            $this->CI->db->where('module_detail_function', $function);

            $query = $this->CI->db->get();
            $rs = array();
            if ($query->num_rows() > 0) {
                $rs = $query->row();
            }

            return $rs;
        }

        public function check_user_agent($param, $user)
        {
            $_ = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unidentified user agent';

            if (isset($param['device_id'])) {
                $__ = $this->CI->db->get_where('sysm_sessions', array(
                    'user_id' => $user->user_id,
                    'device_id' => $param['device_id']
                ));

                if ($__->num_rows() > 0 && $__->row_array()['is_blacklist'] !== '1') {
                    $this->CI->db->where('user_id', $user->user_id);
                    $this->CI->db->where('device_id', $param['device_id']);
                    $this->CI->db->update('sysm_sessions', array(
                        'updated_by' => $user->user_id,
                        'updated_time' => $param['date_today']
                    ));
                    return array('uagent' => $_, 'platform' => 'app', 'sesId' => $__->row_array()['id']);
                } else if ($__->num_rows() > 0 && $__->row_array()['is_blacklist'] === '1') {
                    return array('uagent' => $_, 'platform' => 'app', 'sesId' => 0);
                } else {
                    $this->CI->db->insert('sysm_sessions', array(
                        'user_id' => $user->user_id,
                        'device_id' => $param['device_id'],
                        'created_time' => $param['date_today']
                    ));
                    return array('uagent' => $_, 'platform' => 'app', 'sesId' => $this->CI->db->insert_id());
                }
            } else {
                return array('uagent' => $_, 'platform' => 'browser', 'sesId' => NULL);
            }
        }
    }
}

class User_auth_lib extends BO
{
}
