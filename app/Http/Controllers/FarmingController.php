<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmingController extends Controller
{
    public function index()
    {
        // Hardcoded data voor Samuel en Zendaya
        $locations = [
            [
                'name' => 'Samuel\'s Maize Field',
                'region' => 'Rift Valley, Kenya',
                'status' => 'Optimal',
                'humidity' => '32%',
                'temp' => '28°C',
                'color' => 'green'
            ],
            [
                'name' => 'Zendaya\'s Spinach Patch',
                'region' => 'Arusha, Tanzania',
                'status' => 'Needs Water',
                'humidity' => '18%',
                'temp' => '31°C',
                'color' => 'red'
            ]
        ];

        return view('welcome', compact('locations'));
    }
}
