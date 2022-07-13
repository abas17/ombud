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
        case 'users-view':
            file_exists('pages/users-view.php') ? include 'pages/users-view.php' : include "pages/404.php";
            break;
        case 'users-edit':
            file_exists('pages/users-edit.php') ? include 'pages/users-edit.php' : include "pages/404.php";
            break;
        case 'user-profile':
            file_exists('pages/user-profile.php') ? include 'pages/user-profile.php' : include "pages/404.php";
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
        case 'registrasi-laporan-edit':
            file_exists('pages/registrasi-laporan-edit.php') ? include 'pages/registrasi-laporan-edit.php' : include "pages/404.php";
            break;
        // case 'registrasi-laporan-creates':
        //     file_exists('pages/registrasi-laporan-creates.php') ? include 'pages/registrasi-laporan-creates.php' : include "pages/404.php";
        //     break;

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

            /* Monitoring */
        case 'monitoring':
            file_exists('pages/monitoring.php') ? include 'pages/monitoring.php' : include "pages/404.php";
            break;

            /* Level User */
        case 'laporan':
            file_exists('pages/user/laporan.php') ? include 'pages/user/laporan.php' : include "pages/404.php";
            break;

        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}
