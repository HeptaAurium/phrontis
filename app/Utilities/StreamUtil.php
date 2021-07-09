<?php

namespace App\Utilities;

use App\Models\Stream;

class StreamUtil
{
    static function listStreamByName($id)
    {
        return Stream::where('id', $id)->pluck('name')->first();
    }
}
