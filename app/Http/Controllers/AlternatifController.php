<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\AlternatifSkor;
use App\Models\KriteriaBobotModel;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = AlternatifSkor::select(
            'alternatifskor.id as id',
            'alternatif.id as ida',
            'kriteriabobot.id as idk',
            'alternatifskor.score as score',
            'kriteriabobot.nama as nama',
            'kriteriabobot.tipe as tipe',
            'kriteriabobot.bobot as bobot',
            'kriteriabobot.description as description'
        )
            ->leftJoin('alternatif', 'alternatif.id', '=', 'alternatifskor.alternatif_id')
            ->leftJoin('kriteriabobot', 'kriteriabobot.id', '=', 'alternatifskor.kriteriabobot_id')
            ->get();

        $alternatif = AlternatifModel::get();

        $kriteriabobot = KriteriaBobotModel::get();
        return view('alternatif.index', compact('scores', 'alternatif', 'kriteriabobot'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteriabobot = KriteriaBobotModel::get();
        return view('alternatif.create', compact('kriteriabobot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'score' => 'required|array',
            'score.*' => 'required|numeric',
        ]);

        // Menyimpan alternatif
        $alt = new AlternatifModel;
        $alt->nama = $request->nama;
        $alt->save();

        // Menyimpan skor
        $kriteriabobot = KriteriaBobotModel::get();
        foreach ($kriteriabobot as $k) {
            $score = AlternatifSkor::updateOrCreate(
                ['alternatif_id' => $alt->id, 'kriteriabobot_id' => $k->id],
                ['score' => $request->score[$k->id] ?? 0] // Set a default value, change as needed
            );
        }

        return redirect()->route('alternatif.index')
            ->with('success', 'Alternatif created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show($alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(AlternatifModel $alternatif)
    {
        $kriteriabobot = KriteriaBobotModel::get();
        $alternatifskor = AlternatifSkor::where('alternatif_id', $alternatif->id)->get();
        return view('alternatif.edit', compact('alternatif', 'alternatifskor', 'kriteriabobot'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    // Metode update
    public function update(Request $request, AlternatifModel $alternatif)
    {
        // Validasi
        $request->validate([
            'nama.*' => 'required',
            'score' => 'required|array',
            'score.*' => 'required|numeric',
        ]);

        // Menyimpan Skor
        $kriteriabobot = KriteriaBobotModel::get();

        foreach ($kriteriabobot as $k) {
            $score = AlternatifSkor::updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'kriteriabobot_id' => $k->id,
                ],
                [
                    'score' => $request->score[$k->id] ?? 0,
                ]
            );
        }

        // Update alternatif->nama
        $alternatif->update(
            [
                'nama' => $request->nama
            ]
        );

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui');
    }








    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlternatifModel  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlternatifModel $alternatif)
    {
        $scores = AlternatifSkor::where('alternatif_id', $alternatif->id)->delete();
        $alternatif->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'alternatif deleted successfully');
    }
}
