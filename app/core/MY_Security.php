<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Security extends CI_Security {
    // --------------------------------------------------------------------

    /**
     * Show CSRF Error
     *
     * @return	void
     */
    public function csrf_show_error() {
        header('HTTP/1.1 403 Forbidden');
        show_error('The action you have requested is not allowed.', 403, 'Forbidden');
    }

}
?>

