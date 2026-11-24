<?php
function sapaan_waktu() {
    $jam = date("H");
    if ($jam <10){
        return "Selamat pagi";
    } elseif ($jam <15){
        return "Selamat siang";
    }elseif ($jam <18){
        return "Selamat sore";
    }else {
        return "Selamat malam";
    }
}

function is_logged_in() {
    return isset($_SESSION["admin_login"]);
}
?>