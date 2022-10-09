<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home Page | CI App 4',
            'coba' => ["Kambing", "Sapi", "Ayam"]
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Page About Me'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Page Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl burung no.87',
                    'kota' => 'Depok'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl Kambing no.90',
                    'kota' => 'Jakrta'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}
