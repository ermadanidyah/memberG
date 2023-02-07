<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Member extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='members';
    protected $fillable=['nama','tanggal_lahir','no_ktp','alamat','kabupaten','kecamatan','provinsi','jenis_kelamin'];
    public function user()
    {
        return $this->hasOne(User::class,"id_member", "id");
    }
}
