<?php

if (!function_exists('admins')) {  // This Function To Access The Admin Model

    function admins()
    {
        return \App\Admin::all();
    }
}