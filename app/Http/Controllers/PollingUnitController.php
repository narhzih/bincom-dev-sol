<?php

namespace App\Http\Controllers;

use App\Models\PollingUnit;
use Illuminate\Http\Request;

class PollingUnitController extends Controller
{
    public function pollingUnits() {
        $pus = PollingUnit::paginate(20);
        $data = [
            'pus' => $pus
        ];
        return view('pu', $data);
    }

    public function pollingUnitResults(PollingUnit $pollingUnit) {
        if (!$pollingUnit) {
            abort(404);
        }

        $pu = $pollingUnit;
        $data = ['pu' => $pollingUnit];
        return view('pu_result', $data);
    }
    public function addNewResult() {
        return view('add_pu_result');
    }
}
