<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('indonesian_date')) {

    function indonesian_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '')
    {
        if (trim($timestamp) == '') {
            $timestamp = time();
        } elseif (!ctype_digit($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace("/S/", "", $date_format);
        $pattern = array(
            '/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
            '/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
            '/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
            '/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
            '/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
            '/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
            '/April/', '/May/', '/June/', '/July/', '/August/', '/September/', '/October/',
            '/November/', '/December/',
        );
        $replace = array(
            'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
            'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember',
        );
        $date = date($date_format, $timestamp);
        $date = preg_replace($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return $date;
    }
}
if (!function_exists('time_ago')) {
    function time_ago($time = '', $date_format = 'l, j F Y | H:i', $periode = 'week')
    {
        if (trim($time) == '') {
            $time = time();
        } elseif (!ctype_digit($time)) {
            $time = strtotime($time);
        }
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();

        $difference     = $now - $time;
        $tense         = "ago";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($periods[$j] == $periode) {
            return indonesian_date($time, $date_format);
        } else {
            if ($difference != 1) {
                $periods[$j] .= "s";
            }
            return "$difference $periods[$j] ago ";
        }
    }
}

if (!function_exists('getbln')) {
    function getbln()
    {
        $dbln = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        return $dbln;
    }
}

if (!function_exists('rupiah')) {

    function rupiah($nil = 0)
    {
        $nil = explode('.', strval($nil));
        if (isset($nil[1])) {
            $tambah = ',' . $nil[1];
        } else {
            $tambah = ',00';
        }
        $nil = $nil[0] . $tambah;
        $str1 = $nil;
        $str2 = "";
        $dot = "";
        $str = strrev($str1);
        $arr = str_split($str, 3);
        $i = 0;
        foreach ($arr as $str) {
            $str2 = $str2 . $dot . $str;
            if (strlen($str) == 3 and $i > 0)
                $dot = '.';
            $i++;
        }
        $rp = strrev($str2);
        if ($rp != "" and $rp > 0) {
            return "Rp $rp";
        } else {
            return "Rp 0,00";
        }
    }
}

if (!function_exists('selected')) {

    function selected($a, $b, $opt = 0)
    {
        if ($a == $b) {
            if ($opt)
                echo "checked='checked'";
            else
                echo "selected='selected'";
        }
    }
}

if (!function_exists('decode_date')) {

    function decode_date($date = "", $xsep = "-", $isep = "/")
    {
        if (strlen($date) < 8)
            $date = date("Y-m-d");
        list($year, $month, $day) = explode($xsep, $date);
        return "{$day}{$isep}{$month}{$isep}{$year}";
    }
}

if (!function_exists('encode_date')) {

    function encode_date($date = "", $separator = "/")
    {
        if (strlen($date) < 8)
            return;
        list($day, $month, $year) = explode($separator, $date);
        return "{$year}-{$month}-{$day}";
    }
}

if (!function_exists('object_to_array')) {

    function object_to_array($object)
    {
        if (!is_object($object) && !is_array($object))
            return $object;

        return array_map('object_to_array', (array) $object);
    }
}

if (!function_exists('modal')) {
    function modal($title, $modul, $function, $prm1 = null, $prm2 = null, $prm3 = null, $prm4 = null, $prm5 = null, $prm6 = null)
    {
        return site_url('sys/modal/set_modal/' . $title . '/' . $modul . '/' . $function . '/' . $prm1 . '/' . $prm2 . '/' . $prm3 . '/' . $prm4 . '/' . $prm5 . '/' . $prm6);
    }
}


/* End of file sys_helper.php */
/* Location: ./sys-app/helpers/sys_helper.php */