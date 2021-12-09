<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    private $Teknisi;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->Teknisi = new Teknisi();

    }
    public function index(Request $request)
    {

        $data['teknisi'] = $this->Teknisi->getTeknisi();
        return view('teknisi/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teknisi = Teknisi::where('teknisi_id', $id)->delete();
        if ($teknisi){
            return redirect()->route('teknisi.index')
                ->with('success', 'Berhasil dihapus');
        }
    }

    public function lihatSertifikat($id)
    {
        //
    }
}
