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

    static function allow_both_gender()
    {
        $settings =  GeneralSetting::find(1);

        return $settings->gender == "both" ? true : false;
    }

    static function manual_adm_no()
    {
        $settings =  GeneralSetting::find(1);
        return $settings->manual_adm_no == 1 ? true : false;
    }

    static function school_has_branches()
    {
        $settings =  GeneralSetting::find(1);
        return $settings->school_has_branches == 1 ? true : false;
    }

    static function get_logo_path(){
        $settings =  GeneralSetting::find(1);
        return $settings->logo_path;
    }
}
