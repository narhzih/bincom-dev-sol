<?php

namespace App\Http\Controllers;

use App\Models\AnnouncedPuResult;
use App\Models\Lga;
use App\Models\Party;
use App\Models\PollingUnit;
use App\Models\State;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()  {
        return view('welcome');
    }

}
