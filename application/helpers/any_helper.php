<?php

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Hari = ["Minggu", "Senin", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        $Bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // pemisahan tahun, bulan, hari dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        // $hari = date("w", strtotime($date));
        $result = $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }
}

if (!function_exists('nilai_huruf')) {
    function nilai_huruf($nilai)
    {
        $CI     = &get_instance();
        $kkm     = intval($CI->config->item('kkm'));

        $rentang = round(((100 - $kkm) / 3), 0);

        $d_min = 0;
        $d_max = round(($kkm - 1), 0);
        $c_min = $kkm;
        $c_max = round(($kkm + $rentang), 0);
        $b_min = round(($kkm + ($rentang * 1) + 1), 0);
        $b_max = round(($kkm + ($rentang * 2)));
        $a_min = round(($kkm + ($rentang * 2) + 1), 0);
        $a_max = 100;


        $ret = "";
        if ($nilai >= $d_min && $nilai <= $d_max) {
            $ret = "D";
        } else if ($nilai >= $c_min && $nilai <= $c_max) {
            $ret = "C";
        } else if ($nilai >= $b_min && $nilai <= $b_max) {
            $ret = "B";
        } else if ($nilai >= $a_min && $nilai <= $a_max) {
            $ret = "A";
        } else {
            $ret = "-";
        }
        return $ret;
    }
}

if (!function_exists('nilai_pre')) {
    function nilai_pre($nilai)
    {
        $CI     = &get_instance();
        $kkm     = intval($CI->config->item('kkm'));

        $rentang = round(((100 - $kkm) / 3), 0);

        $d_min = 0;
        $d_max = round(($kkm - 1), 0);
        $c_min = $kkm;
        $c_max = round(($kkm + $rentang), 0);
        $b_min = round(($kkm + ($rentang * 1) + 1), 0);
        $b_max = round(($kkm + ($rentang * 2)), 0);
        $a_min = round(($kkm + ($rentang * 2) + 1), 0);
        $a_max = 100;

        $ret = "";
        if ($nilai >= $d_min && $nilai <= $d_max) {
            $ret = "Kurang";
        } else if ($nilai >= $c_min && $nilai <= $c_max) {
            $ret = "Cukup";
        } else if ($nilai >= $b_min && $nilai <= $b_max) {
            $ret = "Baik";
        } else if ($nilai >= $a_min && $nilai <= $a_max) {
            $ret = "Sangat Baik";
        } else {
            $ret = "Undefined";
        }
        return $ret;
    }
}
