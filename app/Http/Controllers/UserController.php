<?php

namespace App\Http\Controllers;

use Hash;
use App\User;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('guest');
    }*/
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
        $user->password = Hash::make($request->password);
        $user->nomor_ktp = $request->nomor_ktp;
        $user->telepon = $request->telepon;
        $user->profile_picture = $request->profile_picture;
       // $user->pendidikan_terakhir = $request->pendidikan_terakhir;
       // $user->nama_institusi_pendidikan_terakhir = $request->nama_institusi_pendidikan_terakhir;
        //$user->domisili = $request->domisili;
        $user->status = $request->status;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->pekerjaan = $request->pekerjaan;
        $user->latitude_alamat = $request->latitude_alamat;
        $user->longitude_alamat = $request->longitude_alamat;
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
        $user = User::findOrFail($id);
        return response()->json($user, 200);
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

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        //dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {
            return response()->json(Auth::user(), 201);
        } else{
            return response(['msg' => 'Login gagal, silakan masukkan username dan password lagi'], 401);
        }
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
        $user = User::findOrFail($id);
        foreach ($request->all() as $key => $value) {
            if(!$value || !$key){
                continue;
            } 
            $user->$key = $value;
        }
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
