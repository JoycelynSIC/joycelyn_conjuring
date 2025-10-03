<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['name'] = "Joycelyn Dhealiva";
        $data['my_age'] = 18;
        $data['hobbies'] = ["Membaca", "Bermain", "Mendengar Musik", "Memasak", "Menggambar"];
        $data['tgl_harus_wisuda'] = "2025-12-10";
        $data['time_to_study_left'] = 123;
        $data['current_semester'] = 3;
        $data['future_goal'] = "UI/UX Designer";

        if ($data['current_semester'] < 3) {
            $data['info'] = "Masih Awal, Kejar TAK";
        } else {
            $data['info'] = "Jangan main-main, kurang-kurangi main game!";
        }

        return view('pegawai', $data);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
