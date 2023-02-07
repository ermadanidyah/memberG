<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Member\MemberStore;
use App\Http\Requests\Member\MemberUpdate;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MemberController extends Controller
{
    Const FETCHED_ATTRIBUTE = [
        'nama',
        'tanggal_lahir',
        'no_ktp',
        'alamat',
        'kabupaten',
        'kecamatan',
        'provinsi',
        'jenis_kelamin',
        'photo_images',
        'phone',
        'password',
        'email',
        'type'
    ];
    public function index()
    {
        $provinsi = Http::get('https://region-api.profileimage.studio/provinces');
        $data_provinsi = $provinsi->json('data');

        $kabupaten = Http::get('https://region-api.profileimage.studio/regencies');
        $data_kabupaten = $kabupaten->json('data');

        $kecamatan = Http::get('https://region-api.profileimage.studio/districts');
        $data_kecamatan = $kecamatan->json('data');
        $member = Member::with(['user'])->orderBy('created_at', 'desc')
        ->get();

        return view('dashboard.content.Member.Member', compact('member','data_provinsi','data_kecamatan','data_kabupaten'));
    }
    public function create()
    {
        $kecamatan = Http::get('http://region-api.profileimage.studio/districts');
        $data_kecamatan = $kecamatan->json('data');
        $kabupaten = Http::get('https://region-api.profileimage.studio/regencies');
        $data_kabupaten = $kabupaten->json('data');
        $provinsi = Http::get('https://region-api.profileimage.studio/provinces');
        $data_provinsi = $provinsi->json('data');
        $action = 'add';
        return view('dashboard.content.member.member-action', compact('action','data_provinsi','data_kecamatan','data_kabupaten'));
    }

    public function register()
    {
        $kecamatan = Http::get('http://region-api.profileimage.studio/districts');
        $data_kecamatan = $kecamatan->json('data');
        $kabupaten = Http::get('https://region-api.profileimage.studio/regencies');
        $data_kabupaten = $kabupaten->json('data');
        $provinsi = Http::get('https://region-api.profileimage.studio/provinces');
        $data_provinsi = $provinsi->json('data');
        return view('dashboard.content.member.member-register', compact('data_provinsi','data_kecamatan','data_kabupaten'));
    }

    public function store(MemberStore $request)
    {
        // dd('ss');
        $data = $request->only(self::FETCHED_ATTRIBUTE);
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
        $member = Member::create($data);
        User::create([
            'id_role' => 2,
            'id_member'=>$member->id,
            'password'=>Hash::make($data['password']),
            'name' => $data['nama'],
            'email' => $data['email'],
            'isActive' => 1,
            'phone'=>$data['phone'],
            'photo_images'=>$data['photo_images']

        ]);
        if($data['type']=="register"){
            return redirect('/')->with(['success' => 'Silahkan Login!']);

        }else{
            return redirect('/members')->with(['success' => 'Data Berhasil Ditambah!']);

        }
    }

    public function show($id)
    {
        $kecamatan = Http::get('http://region-api.profileimage.studio/districts');
        $data_kecamatan = $kecamatan->json('data');
        $kabupaten = Http::get('https://region-api.profileimage.studio/regencies');
        $data_kabupaten = $kabupaten->json('data');
        $provinsi = Http::get('https://region-api.profileimage.studio/provinces');
        $data_provinsi = $provinsi->json('data');
        $member = Member::findOrFail($id)->load('user');
        return view(
            'dashboard.content.member.member-show',
            compact('member','data_provinsi','data_kecamatan','data_kabupaten',)
        );
    }
    public function edit($id)
    {
        $kecamatan = Http::get('http://region-api.profileimage.studio/districts');
        $data_kecamatan = $kecamatan->json('data');
        $kabupaten = Http::get('https://region-api.profileimage.studio/regencies');
        $data_kabupaten = $kabupaten->json('data');
        $provinsi = Http::get('https://region-api.profileimage.studio/provinces');
        $data_provinsi = $provinsi->json('data');
        $action = 'edit';
        $member = Member::findOrFail($id)->load('user');
        return view('dashboard.content.Member.Member-action', compact('action','data_provinsi','data_kecamatan','data_kabupaten','member'));
    }

    public function update(MemberUpdate $request, Member $member)
    {
        $data = $request->only(self::FETCHED_ATTRIBUTE);
        $file = $request->file('photo_images');
        $find=$member->load('user');
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
        if($file==null){
            $data['photo_images'] =$find->user->photo_images;
        }
        $member->update($data);
        $user=User::where('id_member', $member->id)->update(array(
            'id_role' => 2,
            'id_member'=>$member->id,
            'password'=>Hash::make($data['password']),
            'name' => $data['nama'],
            'email' => $data['email'],
            'isActive' => $find->user->isActive,
            'phone'=>$data['phone'],
            'photo_images'=>$data['photo_images']

        ));
        return redirect('/members')->with(['success' => 'Member Berhasil Diubah!']);
    }

    public function destroy(Member $member)
    {
        $user=User::where('id_member', $member->id)->delete();
        $member->delete();
        return redirect('/members')->with(['success' => 'Data Berhasil DiHapus!']);
    }
    public function kabupaten(Request $request)
    {
        $kabupaten = Http::get('https://region-api.profileimage.studio/regencies');
        $data_kabupaten = $kabupaten->json('data');
        $kab = [];
        foreach ($data_kabupaten as $item) {
            if ($item['province_id'] == $request->id) {
                array_push($kab, (object)[
                    'id' => $item['id'],
                    'name' => $item['name']
                ]);
            }
        }
        return response()->json($kab);
    }
    public function kecamatan(Request $request)
    {
        $kecamatan = Http::get('https://region-api.profileimage.studio/districts');
        $data_kecamatan = $kecamatan->json('data');
        $kec = [];
        foreach ($data_kecamatan as $item) {
            if ($item['regency_id'] == $request->id) {
                array_push($kec, (object)[
                    'id' => $item['id'],
                    'name' => $item['name']
                ]);
            }
        }
        return response()->json($kec);
    }
    public function all()
    {
        $member = Member::with(['user'])->orderBy('created_at', 'desc')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Member',
            'data'    => $member
        ], 200);
    }
}
