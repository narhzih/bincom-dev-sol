<?php

namespace App\Http\Controllers;

use App\Models\Party;
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
    public function addNewResult(PollingUnit $pollingUnit) {
        // If there's already results for this polling unit, redirect to the
        // page that displays the existing result. There's currently no functionality to
        // add more results to an existing Polling Unit (as it is not required for this assessment);
        if ($pollingUnit->announcedPuResult->count() > 0) {
            return redirect("/polling-units/{$pollingUnit->id}/result");
        }
        $parties = (Party::all())->pluck('partyname');
        $data = [
            'pu' => $pollingUnit,
            'parties' => $parties
        ];
        // There are several parties and the results cannot be determined
        return view('add_pu_result', $data);
    }
    public function doAddNewResult(Request $request, PollingUnit $pollingUnit)
    {
        $requestArr = $request->all();
        $responseArr = [];
        // remove _token from the array list
        array_shift($requestArr);
        foreach ($requestArr as $key => $value) {
            // skip the field that stores the username as it
            // is of no use in the foreach loop
            if ($key === "entered_by_user") {
                continue;
            }
//            $responseArr[] =  [
//                'polling_unit_id' => $pollingUnit->id,
//                'party_abbreviation' => $key,
//                'party_score' => $value,
//                'entered_by_user' => $request->entered_by_user,
//                'date_entered' => now(),
//                'user_ip_address' => "127.0.0.1"
//            ];
            $pollingUnit->announcedPuResult()->create([
                'polling_unit_id' => $pollingUnit->id,
                'party_abbreviation' => $key,
                'party_score' => $value,
                'entered_by_user' => $request->entered_by_user,
                'date_entered' => now(),
                'user_ip_address' => "127.0.0.1"
            ]);
        }
        return redirect("/polling-units/{$pollingUnit->id}/result");
    }
}
