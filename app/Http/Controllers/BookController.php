<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function awal()
    {
        return view('Login');
    }

    public function home()
    {
        return view('Home');
    }

    public function index()
    {
        $books = DB::table('books')->get();
        return view('index', ['books' => $books]);
    }
    public function cari($id)
    {
        $books = DB::table('books')->where('idbuku', $id)->get();
        return view('index', ['books' => $books]);
    }


    public function tambah(Request $request)
    {
        $request->file('file')->storeAs('public', $request->idbuku);
        $file = $request->file('file');
        $file->getClientOriginalName();

        //insert data
        DB::table('books')->insert([
            'idbuku' => $request->idbuku,
            'NamaBuku' => $request->NamaBuku,
            'NamaPengarang' => $request->NamaPengarang,
            'Kategori' => $request->Kategori,
            'qty' => $request->qty,
            'Image' => $request->idbuku
        ]);

        return redirect('/home');
    }

    public function signin()
    {
        return view('Signin');
    }

    public function registrasi(Request $request)
    {
        // encript password dan split password jadi 2
        $cryptpassword = Hash::make($request->password);
        $split = str_split($cryptpassword, 30);

        // insert data ke table books
        DB::table('user')->insert([
            'username' => $request->username,
            'password' => $split[0],
            'extend' => $split[1],
            'status' => 'user'
        ]);

        return redirect('/')->with(['success' => 'Username dan Password telah terdaftar']);
    }

    public function login(Request $request)
    {
        $user = $request->input('username');
        $password = $request->input('password');

        $datauser = DB::table('user')->where(['username' => $user])->first();

        if (!empty($datauser)) {
            $combine = $datauser->password . $datauser->extend;
            if ($datauser->username == $user and Hash::check($password, $combine)) {
                $request->session()->put('username', $datauser->username);
                $request->session()->put('status', $datauser->status);
                return redirect('/home');
            }
        }
        return redirect('/')->with(['error' => 'User Name dan Password tidak ditemukan']);
    }


    public function logout()
    {
        session()->forget('username');
        session()->forget('status');
        return view('Login');
    }

    // public function tambah(Request $request)
    // {
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $file_name = $file->getClientOriginalName();
    //         $file->storeAs('public', $file_name);

    //         //insert data
    //         DB::table('books')->insert([
    //             'idbuku' => $request->idbuku,
    //             'NamaBuku' => $request->NamaBuku,
    //             'NamaPengarang' => $request->NamaPengarang,
    //             'Kategori' => $request->Kategori,
    //             'qty' => $request->qty,
    //             'Image' => $request->idbuku
    //         ]);
    //     }

    //     return redirect('/');
    // }


    // public function hapus($id)
    // {
    //     $books = DB::table('books')->where('idbuku', $id)->delete();

    //     return redirect('/');
    // }
    public function hapus($id)
    {

        // hapus file dari storage
        Storage::delete("public/{$id}");

        // hapus data dari tabel books
        DB::table('books')->where('idbuku', $id)->delete();

        return redirect('/home');
    }

    public function show($id)
    {
        $buku = DB::table('books')->where('idbuku', $id)->get();

        return view('update', ['books' => $buku]);
    }
    public function edit(Request $request)
    {
        $buku = DB::table('books')->where('idbuku', $request->idbuku)->update([
            'NamaBuku' => $request->NamaBuku,
            'NamaPengarang' => $request->NamaPengarang,
            'Kategori' => $request->Kategori,
            'qty' => $request->qty,
        ]);

        return redirect('/home');
    }
}
