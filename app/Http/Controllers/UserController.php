<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->nomor_ktp = $request->nomor_ktp;
        $user->telepon = $request->telepon;
        $user->profile_picture = $request->profile_picture;
        $user->pendidikan_terakhir = $request->pendidikan_terakhir;
        $user->nama_institusi_pendidikan_terakhir = $request->nama_institusi_pendidikan_terakhir;
        $user->domisili = $request->domisili;
        $user->keahlian = $request->keahlian;
        $user->status = $request->status;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->pekerjaan = $request->pekerjaan;
        $user->alasan_bergabung = $request->alasan_bergabung;
        $user->save();
        return response()->json($user, 201);
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
     * @param  \Illuminate\Http\UserStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, $id)
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
        //
    }
}
