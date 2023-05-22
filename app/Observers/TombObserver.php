<?php

namespace App\Observers;

use App\Models\Tomb;

class TombObserver
{
    public function saved(Tomb $tomb)
    {
        $latestBurialDate = $tomb->rooms()->max('burial_date');

        if ($latestBurialDate) {
            $tomb->burial_date = $latestBurialDate;
            $tomb->save();
        }
    }
}
