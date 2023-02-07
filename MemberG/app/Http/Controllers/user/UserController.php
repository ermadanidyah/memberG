<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserStore;
use App\Http\Requests\User\UserUpdate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const FETCHED_ATTRIBUTE = [
        'id_role',
        'name',
        'email',
        'password',
        'isActive',
        'photo_images',
        'username',
        'phone'
    ];
    public function index(Request $request)
    {
        $account = User::orderBy('created_at', 'desc')
            ->get();
        return view('dashboard.content.user.user', compact('account'));
    }
    public function show($id)
    {

        $user = User::findOrFail($id)->load('role');
        return view(
            'dashboard.content.user.user-show',
            compact('user')
        );
    }
    public function create()
    {
        $action = 'add';
        return view('dashboard.content.user.user-action', compact('action'));
    }

    public function store(UserStore $request)
    {
        $data = $request->only(self::FETCHED_ATTRIBUTE);
        $data['id_role'] = 1;
        $data['isActive'] = 1;
        $data['password']=Hash::make($data['password']);
        $file = $request->file('photo_images');

        if ($file != '') {
            $timestamp = Carbon::now()->unix();
            $nama_file = $timestamp . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'dump/account/';
            $file->move($tujuan_upload, $nama_file);

            $filename = $file->getClientOriginalName();
            $filetype = $file->getClientOriginalExtension();
            $filesize = $file->getMaxFileSize();
            $relpath = $tujuan_upload . $nama_file;
            $abspath = $request->getSchemeAndHttpHost() . '/' . $relpath;


            $data['photo_images'] = $relpath;
        }
        $account = User::create($data);

        return redirect('account')->with('success', 'Account berhasil ditambah !');
    }

    public function edit($id)
    {
        $action = 'edit';
        $account = User::findOrFail($id);
        return view('dashboard.content.user.user-action', compact('action', 'account'));
    }

    public function update(UserUpdate $request,User $account)
    {
        $data = $request->only(self::FETCHED_ATTRIBUTE);
        $data['password']=Hash::make($data['password']);
        $file = $request->file('photo_images');

        if ($file != '') {

            $timestamp = Carbon::now()->unix();
            $nama_file = $timestamp . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'dump/account/';
            $file->move($tujuan_upload, $nama_file);

            $filename = $file->getClientOriginalName();
            $filetype = $file->getClientOriginalExtension();
            $filesize = $file->getMaxFileSize();
            $relpath = $tujuan_upload . $nama_file;
            $abspath = $request->getSchemeAndHttpHost() . '/' . $relpath;

            $data['photo_images'] = $relpath;
        }
        $account->update($data);

        return redirect('account')->with('success', 'Account berhasil diedit !');
    }

    public function destroy(User $user)
    {

        $user->delete();
        return redirect('account')->with('success', 'Account berhasil dihapus !');
    }


    public function activate($id, Request $request)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $user->update([
            'isActive' => 1
        ]);


        return redirect('/account')->with('success', 'Account berhasil diaktifkan !');
    }

    public function ban($id, Request $request)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $user->update([
            'isActive' => 0
        ]);

        return redirect('/account')->with('success', 'Account berhasil diban !');
    }
    public function Profile(Request $request)
    {
        $user = Auth::user();
        return view('dashboard.content.profile.profile', compact('user'));
    }
}
