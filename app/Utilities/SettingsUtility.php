<?php

namespace App\Utilities;

use App\Models\GeneralSetting;

class SettingsUtility
{

    static function get_all_settings()
    {
        return GeneralSetting::find(1);
    }

    static function classes_have_streams()
    {
        $settings =  GeneralSetting::find(1);

        return $settings->classes_have_streams == 1 ? true : false;
    }
}
