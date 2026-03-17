<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmingController extends Controller
{
    /**
     * De vaste profielinformatie van de farmers.
     * Crops zijn geselecteerd op basis van beschikbare Lucide icons.
     */
    private function getFarmerProfiles()
    {
        return [
            1 => [
                'name' => 'Samuel Odhiambo',
                'region' => 'Kenya, Rift Valley',
                'img' => '02.jpg',
                'crops' => ['Wheat', 'Coffee'],
                'pico_id' => 'RF-992'
            ],
            2 => [
                'name' => 'Zendaya Hassan',
                'region' => 'Tanzania, Arusha',
                'img' => '01.jpg',
                'crops' => ['Coffee', 'Grapes'],
                'pico_id' => 'TZ-114'
            ],
            3 => [
                'name' => 'Kofi Mensah',
                'region' => 'Ghana, Kumasi',
                'img' => '03.jpg',
                'crops' => ['Cocoa', 'Wheat'],
                'pico_id' => 'GH-440'
            ],
            4 => [
                'name' => 'Amara Oke',
                'region' => 'Nigeria, Ibadan',
                'img' => '04.jpg',
                'crops' => ['Sunflower', 'Wheat'],
                'pico_id' => 'NG-228'
            ],
            5 => [
                'name' => 'Luka Modise',
                'region' => 'Botswana, Gaborone',
                'img' => '05.jpg',
                'crops' => ['Sunflower', 'Coffee'],
                'pico_id' => 'BW-701'
            ],
        ];
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $id = match($email) {
            'samuel@aggro.test' => 1,
            'zendaya@aggro.test' => 2,
            'kofi@aggro.test' => 3,
            'amara@aggro.test' => 4,
            'luka@aggro.test' => 5,
            default => rand(1, 5),
        };
        return redirect()->route('profile', ['id' => $id]);
    }

    public function profile($id)
    {
        $profiles = $this->getFarmerProfiles();
        if (!isset($profiles[$id])) {
            return redirect()->route('login');
        }

        $farmer = $profiles[$id];
        $farmer['id'] = $id;

        $liveData = [
            'moisture' => rand(14, 42) . '%',
            'temp' => rand(25, 34) . '°C',
            'battery' => rand(78, 98) . '%',
            'last_update' => now()->diffForHumans(),
        ];

        return view('profile', compact('farmer', 'liveData'));
    }
}
