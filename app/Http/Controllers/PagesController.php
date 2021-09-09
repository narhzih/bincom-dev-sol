<?php

namespace App\Http\Controllers;

use App\Models\AnnouncedPuResult;
use App\Models\Lga;
use App\Models\Party;
use App\Models\PollingUnit;
use App\Models\State;
use http\Env\Response;
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

    public function lgas() {

        // Select all polling units and calculate the result foreach party
        $states = State::all();
        $lgas = Lga::all();
        $data = [
            'states' => $states,
            'lgas' => $lgas
        ];
        return view('lga_results', $data);
    }

    public function getLgasUnderState($stateId): \Illuminate\Http\JsonResponse
    {
        $state = State::where('id', $stateId)->first();
        if(!$state) {
            return response()->json([
                'status' => 'error',
                'statusCode' => 404,
                'message' => 'Invalid state information requested'
            ]);
        }

        $lgas = $state->lgas;
        $data = [];
        $data['lgas'] = $lgas;

        return response()->json([
            'status' => 'success',
            'statusCode' => 200,
            'message' => 'Data fetched successfully',
            'data' => $data
        ]);

    }

    /**
     * @param $lgaId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLgaCalculatedResult($lgaId): \Illuminate\Http\JsonResponse
    {
        $lga = Lga::where('lga_id', $lgaId)->first();
        if(!$lga) {
            return response()->json([
                'status' => 'error',
                'statusCode' => 400,
                'message' => 'Invalid local government ID specified',
            ]);
        }
        $result = [];
        $partiesArr = ((Party::all())->pluck('partyname')->toArray());
        $parties = array_fill_keys($partiesArr, 0);
        $result["parties"] = $parties;
        $result["total"] = 0;
        // Create an array of parties from
        $pollingUnits = $lga->pollingUnit;
        if($pollingUnits) {
            foreach ($pollingUnits as $pollingUnit) {
               if ($pollingUnit && $pollingUnit->announcedPuResult) {
                  foreach ($pollingUnit->announcedPuResult as $apu) {
                      $result["parties"][trim($apu->party_abbreviation)] += $apu->party_score;
                      $result["total"] += $apu->party_score;
                  }
               }
            }
            return response()->json([
                'status' => 'success',
                'statusCode' => 200,
                'message' => 'Data fetched successfully',
                'data' => $result
            ]);
        }
        return response()->json([
            'status' => 'success',
            'statusCode' => 301,
            'message' => 'No polling units found',
            'data' => $result
        ]);
    }
}
