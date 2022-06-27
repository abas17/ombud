<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case '':
        case 'home':
            file_exists('pages/home.php') ? include 'pages/home.php' : include "pages/404.php";
            break;

            /* Page User */
        case 'users-list':
            file_exists('pages/users-list.php') ? include 'pages/users-list.php' : include "pages/404.php";
            break;

            /* Page Registrasi Laporan */
        case 'registrasi-laporan-masuk':
            file_exists('pages/registrasi-laporan-masuk.php') ? include 'pages/registrasi-laporan-masuk.php' : include "pages/404.php";
            break;
        case 'registrasi-laporan':
            file_exists('pages/registrasi-laporan.php') ? include 'pages/registrasi-laporan.php' : include "pages/404.php";
            break;
        case 'pelapor':
            file_exists('pages/pelapor.php') ? include 'pages/pelapor.php' : include "pages/404.php";
            break;
        case 'terlapor':
            file_exists('pages/terlapor.php') ? include 'pages/terlapor.php' : include "pages/404.php";
            break;
        case 'registrasi-laporan-create':
            file_exists('pages/registrasi-laporan-create.php') ? include 'pages/registrasi-laporan-create.php' : include "pages/404.php";
            break;

            /* Verifikasi */
        case 'verifikasi':
            file_exists('pages/verifikasi.php') ? include 'pages/verifikasi.php' : include "pages/404.php";
            break;

            /* Pleno */
        case 'pleno':
            file_exists('pages/pleno.php') ? include 'pages/pleno.php' : include "pages/404.php";
            break;

            /* Pemeriksaan */
        case 'pemeriksaan':
            file_exists('pages/pemeriksaan.php') ? include 'pages/pemeriksaan.php' : include "pages/404.php";
            break;


            // case 'lokasicreate':
            //     file_exists('pages/admin/lokasicreate.php') ? include 'pages/admin/lokasicreate.php' : include "pages/404.php";
            //     break;
            // case 'lokasiupdate':
            //     file_exists('pages/admin/lokasiupdate.php') ? include 'pages/admin/lokasiupdate.php' : include "pages/404.php";
            //     break;
            // case 'lokasidelete':
            //     file_exists('pages/admin/lokasidelete.php') ? include 'pages/admin/lokasidelete.php' : include "pages/404.php";
            //     break;
            // case 'bagianread':
            //     file_exists('pages/admin/bagianread.php') ? include 'pages/admin/bagianread.php' : include "pages/404.php";
            //     break;
            // case 'bagiancreate':
            //     file_exists('pages/admin/bagiancreate.php') ? include 'pages/admin/bagiancreate.php' : include "pages/404.php";
            //     break;
            // case 'karyawanread':
            //     file_exists('pages/admin/karyawanread.php') ? include 'pages/admin/karyawanread.php' : include "pages/404.php";
            //     break;
            // case 'karyawancreate':
            //     file_exists('pages/admin/karyawancreate.php') ? include 'pages/admin/karyawancreate.php' : include "pages/404.php";
            //     break;
            // case 'karyawanupdate':
            //     file_exists('pages/admin/karyawanupdate.php') ? include 'pages/admin/karyawanupdate.php' : include "pages/404.php";
            //     break;
            // case 'karyawandelete':
            //     file_exists('pages/admin/karyawandelete.php') ? include 'pages/admin/karyawandelete.php' : include "pages/404.php";
            //     break;
        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}
