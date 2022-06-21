<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case '':
        case 'home':
            file_exists('pages/home.php') ? include 'pages/home.php' : include "pages/404.php";
            break;
        case 'lokasiread':
            file_exists('pages/admin/lokasiread.php') ? include 'pages/admin/lokasiread.php' : include "pages/404.php";
            break;
        case 'lokasicreate':
            file_exists('pages/admin/lokasicreate.php') ? include 'pages/admin/lokasicreate.php' : include "pages/404.php";
            break;
        case 'lokasiupdate':
            file_exists('pages/admin/lokasiupdate.php') ? include 'pages/admin/lokasiupdate.php' : include "pages/404.php";
            break;
        case 'lokasidelete':
            file_exists('pages/admin/lokasidelete.php') ? include 'pages/admin/lokasidelete.php' : include "pages/404.php";
            break;
        case 'bagianread':
            file_exists('pages/admin/bagianread.php') ? include 'pages/admin/bagianread.php' : include "pages/404.php";
            break;
        case 'bagiancreate':
            file_exists('pages/admin/bagiancreate.php') ? include 'pages/admin/bagiancreate.php' : include "pages/404.php";
            break;
        case 'karyawanread':
            file_exists('pages/admin/karyawanread.php') ? include 'pages/admin/karyawanread.php' : include "pages/404.php";
            break;
        case 'karyawancreate':
            file_exists('pages/admin/karyawancreate.php') ? include 'pages/admin/karyawancreate.php' : include "pages/404.php";
            break;
        case 'karyawanupdate':
            file_exists('pages/admin/karyawanupdate.php') ? include 'pages/admin/karyawanupdate.php' : include "pages/404.php";
            break;
        case 'karyawandelete':
            file_exists('pages/admin/karyawandelete.php') ? include 'pages/admin/karyawandelete.php' : include "pages/404.php";
            break;
        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}
