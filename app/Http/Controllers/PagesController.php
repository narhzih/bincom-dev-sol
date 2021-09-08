<?php

namespace App\Http\Controllers;

use App\Models\PollingUnit;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()  {
        return view('welcome');
    }

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
}
