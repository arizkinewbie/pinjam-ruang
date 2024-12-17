<?php

namespace App\Admin\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;

class AdministratorApiController extends Controller
{
    public $prodi = [
        // S1
        ['code' => 'manajemen-bisnis', 'name' => 'Manajemen Bisnis', 'degree' => 'S1', 'faculty' => 'Fakultas Ekonomi dan Bisnis'],
        ['code' => 'akuntansi-sektor-bisnis', 'name' => 'Akuntansi Sektor Bisnis', 'degree' => 'S1', 'faculty' => 'Fakultas Ekonomi dan Bisnis'],

        ['code' => 'teknik-industri', 'name' => 'Teknik Industri', 'degree' => 'S1', 'faculty' => 'Fakultas Teknik'],
        ['code' => 'perencanaan-wilayah-dan-kota', 'name' => 'Perencanaan Wilayah & Kota', 'degree' => 'S1', 'faculty' => 'Fakultas Teknik'],
        ['code' => 'teknik-sipil', 'name' => 'Teknik Sipil', 'degree' => 'S1', 'faculty' => 'Fakultas Teknik'],
        ['code' => 'teknik-mesin', 'name' => 'Teknik Mesin', 'degree' => 'S1', 'faculty' => 'Fakultas Teknik'],

        ['code' => 'desain-komunikasi-visual', 'name' => 'Desain Komunikasi Visual', 'degree' => 'S1', 'faculty' => 'Fakultas Desain & Industri Kreatif'],
        ['code' => 'desain-produk', 'name' => 'Desain Produk', 'degree' => 'S1', 'faculty' => 'Fakultas Desain & Industri Kreatif'],
        ['code' => 'desain-interior', 'name' => 'Desain Interior', 'degree' => 'S1', 'faculty' => 'Fakultas Desain & Industri Kreatif'],

        ['code' => 'kesehatan-masyarakat', 'name' => 'Kesehatan Masyarakat', 'degree' => 'S1', 'faculty' => 'Fakultas Ilmu-Ilmu Kesehatan'],
        ['code' => 'ilmu-gizi', 'name' => 'Ilmu Gizi', 'degree' => 'S1', 'faculty' => 'Fakultas Ilmu-Ilmu Kesehatan'],
        ['code' => 'ilmu-keperawatan', 'name' => 'Ilmu Keperawatan', 'degree' => 'S1', 'faculty' => 'Fakultas Ilmu-Ilmu Kesehatan'],
        ['code' => 'farmasi', 'name' => 'Farmasi', 'degree' => 'S1', 'faculty' => 'Fakultas Ilmu-Ilmu Kesehatan'],

        ['code' => 'teknik-informatika', 'name' => 'Teknik Informatika', 'degree' => 'S1', 'faculty' => 'Fakultas Ilmu Komputer'],
        ['code' => 'sistem-informasi', 'name' => 'Sistem Informasi', 'degree' => 'S1', 'faculty' => 'Fakultas Ilmu Komputer'],

        ['code' => 'ilmu-hukum', 'name' => 'Ilmu Hukum', 'degree' => 'S1', 'faculty' => 'Fakultas Hukum'],

        ['code' => 'psikologi', 'name' => 'Psikologi', 'degree' => 'S1', 'faculty' => 'Fakultas Psikologi'],

        // Profesi
        ['code' => 'profesi-ners', 'name' => 'Profesi Ners', 'degree' => 'Profesi', 'faculty' => 'Fakultas Ilmu-Ilmu Kesehatan'],

        // D3
        ['code' => 'survei-dan-pemetaan', 'name' => 'Survei dan Pemetaan', 'degree' => 'D3', 'faculty' => 'Fakultas Teknik'],
        ['code' => 'rekam-medis', 'name' => 'Rekam Medis', 'degree' => 'D3', 'faculty' => 'Fakultas Ilmu-Ilmu Kesehatan'],

        // S2
        ['code' => 'magister-manajemen', 'name' => 'Magister Manajemen', 'degree' => 'S2', 'faculty' => 'Fakultas Ekonomi dan Bisnis'],
        ['code' => 'magister-ilmu-komputer', 'name' => 'Magister Ilmu Komputer', 'degree' => 'S2', 'faculty' => 'Fakultas Ilmu Komputer'],

        // S3
        ['code' => 'doktor-ilmu-manajemen', 'name' => 'Doktor Ilmu Manajemen', 'degree' => 'S3', 'faculty' => 'Fakultas Ekonomi dan Bisnis'],
    ];


    public function getAllProdi()
    {
        return $this->prodi;
    }

    public function getProdiByCode(Request $request)
    {
        $code = $request->get('code');
        return response()->json(collect($this->prodi)->where('code', $code)->first());
    }

    /**
     * Get all administrator where has role `mahasiswa`
     *
     * @param  mixed $request
     * @return void
     */
    public function getCollegeStudents(Request $request)
    {
        $q = $request->get('q');

        return Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'mahasiswa');
        })->where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    /**
     * Get all administrator where has role `staff`
     *
     * @param  mixed $request
     * @return void
     */
    public function getAdministrators(Request $request)
    {
        $q = $request->get('q');

        return Administrator::whereHas('roles', function ($query) {
            $query->where('slug', 'staff');
        })->where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
