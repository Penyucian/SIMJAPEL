<?php

class Dashboard extends SYS_Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['controller'] = 'home/dashboard/';
    }

    public function index()
    {
        redirect($this->data['controller'] . 'view');
    }

    public function view()
    {
        $this->template->load_view($this->data['controller'] . 'view', $this->data);
    }
}
