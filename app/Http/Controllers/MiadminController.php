<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Cclinic;
use App\KuliahBisnis;
use App\Mistalk;
use App\Program;
use App\Proposal;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MiadminController extends Controller
{
    public function index()
    {
        // CEK JIKA SESSION ADA LANGSUNG KE HOME
        if(Auth::guard('admin')->check()) {
            return redirect('/miadmin/homeadmin');
        }
        return view('adminpage.loginadmin');
    }

    public function homeadmin()
    {
        // Total USER
        $login = Proposal::select(DB::raw('count(user_akun.id) as ttl_user'))
                           ->rightJoin('user_akun', 'data_proposal.id_user', '=', 'user_akun.id')
                           ->get()->toArray();
        $submitProposal = Proposal::select(DB::raw('count(url_proposal) as submitProp'))
                                    ->whereRaw('url_proposal != "" AND url_proposal IS NOT NULL')
                                    ->get()->toArray();
        $submitVideo = Pengumuman::select(DB::raw('count(link_yt) as ttl_video'))
                                    ->whereRaw('link_yt != "" AND link_yt IS NOT NULL')
                                    ->get()->toArray();
        $jmlProgram = Program::select(DB::raw('count(id) as ttl_program'))
                                ->get()->toArray();
        $jmlMistalk = Mistalk::select(DB::raw('count(id) as ttl_mistalk'))
                                ->get()->toArray();
        $jmlCclinic = Cclinic::select(DB::raw('count(id) as ttl_clinic'))
        ->get()->toArray();
        $jmlKubis = KuliahBisnis::select(DB::raw('count(id) as ttl_kubis'))
        ->get()->toArray();
        $data = [
            'ttl_user' => $login[0]['ttl_user'],
            'ttl_proposal' => $submitProposal[0]['submitProp'],
            'ttl_video' => $submitVideo[0]['ttl_video'],
            'jmlProgram' => $jmlProgram[0]['ttl_program'],
            'jmlMistalk' => $jmlMistalk[0]['ttl_mistalk'],
            'jmlCclinic' => $jmlCclinic[0]['ttl_clinic'],
            'jmlKubis' => $jmlKubis[0]['ttl_kubis']
        ];
        return view('adminpage.adminhome', compact('data'));
    }

    public function datafinalis()
    {
        $dataFinalis = Pengumuman::select(DB::raw('tbl_finalis50.id_finalis, user_akun.nm_lengkap, tbl_finalis50.nama_bisnis, tbl_finalis50.link_yt'))
                                    ->join('user_akun', 'tbl_finalis50.id_akun', '=', 'user_akun.id')
                                    ->get()
                                    ->toArray();
        return view('adminpage.datafinalis', compact('dataFinalis'));
    }

    public function datamis()
    {
        $datamis = Proposal::select(DB::raw('user_akun.nm_lengkap, user_akun.email, data_proposal.no_hp, data_proposal.tempat_lahir, data_proposal.tgl_lahir, data_proposal.kota_domisili, data_proposal.pekerjaan, data_proposal.jenis_kelamin, data_proposal.role, data_proposal.url_proposal, data_proposal.bidang_bisnis, data_proposal.metode_bayar, data_proposal.url_bukti_bayar'))
                              ->rightJoin('user_akun', 'data_proposal.id_user', '=', 'user_akun.id')
                              ->orderBy('data_proposal.jenis_kelamin', 'desc')
                              ->get()->toArray();
        return view('adminpage.datamis', compact('datamis'));
    }

    public function datamistalk()
    {
        $datamistalk = Mistalk::select(DB::raw('user_akun.nm_lengkap, user_akun.email, user_akun.no_hp, data_program.nama_program, data_mistalk.ttl, data_mistalk.gender, data_mistalk.domisili, data_mistalk.instansi, data_mistalk.tanya, data_mistalk.metode_bayar, data_mistalk.bukti_bayar'))
                              ->leftJoin('user_akun', 'data_mistalk.id_akun', '=', 'user_akun.id')
                              ->leftJoin('data_program', 'data_mistalk.id_program', '=', 'data_program.id')
                              ->get()->toArray();
        return view('adminpage.datamistalk', compact('datamistalk'));
    }

    public function datacclinic() {
        $datacclinic = Cclinic::select(DB::raw('user_akun.nm_lengkap, user_akun.email, user_akun.no_hp, data_program.nama_program, data_cclinic.ttl, data_cclinic.domisili, data_cclinic.ide_bisnis, data_cclinic.bidang_bisnis, data_cclinic.masalah, data_cclinic.solusi, data_cclinic.target, data_cclinic.kebutuhan, data_cclinic.metode_bayar, data_cclinic.bukti_bayar'))
                                ->leftJoin('user_akun', 'data_cclinic.id_akun', '=', 'user_akun.id')
                                ->leftJoin('data_program', 'data_cclinic.id_program', '=', 'data_program.id')
                                ->get()->toArray();
        return view('adminpage.datacclinic', compact('datacclinic'));
    }

    public function datakubis() {
        $datakubis = KuliahBisnis::select(DB::raw('user_akun.nm_lengkap, user_akun.email, user_akun.no_hp, data_program.nama_program, data_kubis.ttl, data_kubis.domisili, data_kubis.ide_bisnis, data_kubis.bidang_bisnis, data_kubis.masalah, data_kubis.solusi, data_kubis.target, data_kubis.kebutuhan, data_kubis.metode_bayar, data_kubis.bukti_bayar'))
                                ->leftJoin('user_akun', 'data_kubis.id_akun', '=', 'user_akun.id')
                                ->leftJoin('data_program', 'data_kubis.id_program', '=', 'data_program.id')
                                ->get()->toArray();
        return view('adminpage.datakubis', compact('datakubis'));
    }

    public function dataprogram()
    {
        $dtProgram = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, perlengkapan, mentor, link_cv, metode_pelaksanaan, link_map, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, jam_tambahan, biaya, harga_normal, harga_promo, link_jadwal, link_dokumentasi, status"))->get()->toArray();
        return view('adminpage.dataprogram', compact('dtProgram'));
    }

    public function formprogram()
    {
        return view('adminpage.formprogram');
    }

    // ==== PROSES - PROSES
    public function cekadmin(Request $request)
    {
        $uname = $request->input('uname');
        $password = $request->input('password');

        // === CEK VALIDASI ADMIN
        $validatedData = FacadesValidator::make($request->all(),[
            'uname' => 'required|exists:App\Admin,username',
            'password' => 'required',
        ],
        [
            'uname.required' => 'Username harus diisi',
            'uname.exists' => 'Username tidak terdaftar',
            'password.required' => 'Password harus diisi'
        ]);

        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        $admin = Admin::where('username',$uname)->get();
        if (password_verify($password, $admin[0]['password'])) {
            // ---------------- JIKA LOGIN BERHASIL
            $data = [
                'success' => true,
                'message' => 'Sign In berhasil'
            ];
            // PAKAI AUTH
            if (Auth::guard('admin')->attempt(['username' =>$uname, 'password' => $password])) {
                return response()->json($data);
            }
        } else {
            $data = [
                'success' => false,
                'errors' => [
                    'password' => 'Password salah'
                ]
            ];
            return response()->json($data);
        }
    }

        // LOGOUT
    public function logoutadmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginadmin');
    }
        // INPUT PROGRAM
    public function inputprogram(Request $request)
    {
        // === CEK VALIDASI INPUT PROGRAM
        $validatedData = FacadesValidator::make($request->all(),[
            'nama_program' => 'required',
            'nama_kegiatan' => 'required',
            'link_pamflet' => 'required|file|max:2048|mimes:jpg,jpeg,png',
            'link_daftar' => 'required',
            'tgl_mulai' => 'required',
            'jam_mulai' => ['required','regex:/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/'],
            'jam_selesai' => ['required','regex:/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/'],
            'biaya' => 'required',
            'status' => 'required',
            'metode_pelaksanaan' => 'required'
        ],
        [
            'nama_program.required' => 'Nama program wajib diisi',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
            'link_pamflet.required' => 'Unggah gambar pamflet',
            'link_pamflet.file' => 'Unggah file pamflet',
            'link_pamflet.mimes' => 'Tipe gambar yang diizinkan png/jpg/jpeg',
            'link_pamflet.max' => 'Ukuran gambar maksimal 2 MB',
            'link_daftar.required' => 'Link pendaftaran wajib diisi',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'jam_mulai.required' => 'Jam mulai wajib diisi',
            'jam_mulai.regex' => 'Format jam tidak valid',
            'jam_selesai.required' => 'Jam selesai wajib diisi',
            'jam_selesai.regex' => 'Format jam tidak valid',
            'biaya.required' => 'Wajib pilih salah satu',
            'status.required' => 'Status wajib diisi',
            'metode_pelaksanaan.required' => 'Pilih salah satu'
        ]);

        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        // ==== AMBIL DATA
        $nama_program = $request->input('nama_program');
        $nama_kegiatan = $request->input('nama_kegiatan');
        $link_pamflet = $request->file('link_pamflet');
        $desc_program = $request->input('desc_program');
        $link_daftar = $request->input('link_daftar');
        $link_meet = $request->input('link_meet');
        $sasaran_program = $request->input('sasaran_program');
        $perlengkapan = $request->input('perlengkapan');
        $mentor = $request->input('mentor');
        $profesi = $request->input('profesi');
        $link_cv = $request->input('link_cv');
        $tgl_mulai = $request->input('tgl_mulai');
        $tgl_selesai = $request->input('tgl_selesai');
        $jam_mulai = $request->input('jam_mulai');
        $jam_selesai = $request->input('jam_selesai');
        $jam_tambahan = $request->input('jam_tambahan');
        $metode_pelaksanaan = $request->input('metode_pelaksanaan');
        $link_map = $request->input('link_map');
        $biaya = $request->input('biaya');
        $harga_normal = $request->input('harga_normal');
        $harga_promo = $request->input('harga_promo');
        $link_jadwal = $request->input('link_jadwal');
        $link_dokumentasi = $request->input('link_dokumentasi');
        $status = $request->input('status');

        $data = [];

        // ===== FILE HANDLING
        $simpanPamflet = $link_pamflet->store('/public/images/programs');
        if ($simpanPamflet) {
            // === AMBIL NAMA FILE
            $simpanPamflet = pathinfo($simpanPamflet)['basename'];
            // ===== SIMPAN KE DATABASE
            Program::insert(
                [
                    'nama_program' => $nama_program,
                    'nama_kegiatan' => $nama_kegiatan,
                    'link_pamflet' => $simpanPamflet,
                    'link_daftar' => $link_daftar,
                    'link_meet' => $link_meet,
                    'desc_program' => utf8_encode($desc_program),
                    'sasaran_program' => $sasaran_program,
                    'perlengkapan' => $perlengkapan,
                    'mentor' => $mentor,
                    'profesi' => $profesi,
                    'link_cv' => $link_cv,
                    'metode_pelaksanaan' => $metode_pelaksanaan,
                    'link_map' => $link_map,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_selesai' => $tgl_selesai,
                    'jam_mulai' => $jam_mulai,
                    'jam_selesai' => $jam_selesai,
                    'jam_Tambahan' => $jam_tambahan,
                    'biaya' => $biaya,
                    'harga_normal' => $harga_normal,
                    'harga_promo' => $harga_promo,
                    'link_jadwal' => $link_jadwal,
                    'link_dokumentasi' => $link_dokumentasi,
                    'status' => $status
                ]
            );
            $data = [
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Data gagal disimpan'
            ];
        }
        return response()->json($data);

    }
        // HAPUS PROGRAM
    public function hapusprogram($id)
    {
        $pamflet = Program::select('link_pamflet')->where('id', '=', $id)->get()->toArray();
        $pamflet = $pamflet[0]['link_pamflet'];
        $data = array();
        // === HAPUS GAMBAR PAMFLET
        $hapusPamflet = Storage::delete('public/images/programs/'.$pamflet);
        if($hapusPamflet) {
            // == HAPUS DATA DARI DATABASE
            Program::where('id', '=', $id)->delete();
            $data = [
                'success' => true,
                'message' => 'Program berhasil dihapus'
            ];
        } else {
            $data = [
                'success' => false,
                'message' => 'Program gagal dihapus'
            ];
        }
        return response()->json($data);
    }
        // UBAH PROGRAM
    public function ubahprogram($id)
    {
        $dtProgram = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, link_meet, desc_program, sasaran_program, perlengkapan, mentor, profesi, link_cv, metode_pelaksanaan, link_map, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, jam_tambahan, biaya, harga_normal, harga_promo, link_jadwal, link_dokumentasi, status"))
                    ->where('id', $id)
                    ->get()
                    ->toArray();
        return view('adminpage.formprogram', compact('dtProgram'));
    }

        // PROSES - PROSES UBAH PROGRAM
    public function prsubahprogram(Request $request) {
        // === CEK VALIDASI INPUT PROGRAM
        $validatedData = FacadesValidator::make($request->all(),[
            'id_program' => 'required',
            'nama_program' => 'required',
            'nama_kegiatan' => 'required',
            'link_pamflet' => 'file|max:2048|mimes:jpg,jpeg,png',
            'link_daftar' => 'required',
            'tgl_mulai' => 'required',
            'jam_mulai' => ['required','regex:/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/'],
            'jam_selesai' => ['required','regex:/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/'],
            'biaya' => 'required',
            'status' => 'required',
            'metode_pelaksanaan' => 'required'
        ],
        [
            'id_program.required' => 'Id program wajib diisi',
            'nama_program.required' => 'Nama program wajib diisi',
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
            'link_pamflet.file' => 'Unggah file pamflet',
            'link_pamflet.mimes' => 'Tipe gambar yang diizinkan png/jpg/jpeg',
            'link_pamflet.max' => 'Ukuran gambar maksimal 2 MB',
            'link_daftar.required' => 'Link pendaftaran wajib diisi',
            'tgl_mulai.required' => 'Tanggal mulai wajib diisi',
            'jam_mulai.required' => 'Jam mulai wajib diisi',
            'jam_mulai.regex' => 'Format jam tidak valid',
            'jam_selesai.required' => 'Jam selesai wajib diisi',
            'jam_selesai.regex' => 'Format jam tidak valid',
            'biaya.required' => 'Wajib pilih salah satu',
            'status.required' => 'Status wajib diisi',
            'metode_pelaksanaan.required' => 'Pilih salah satu'
        ]);

        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        // === AMBIL DATA - DATA
        $id_program = $request->input('id_program');
        $nama_program = $request->input('nama_program');
        $nama_kegiatan = $request->input('nama_kegiatan');
        $link_pamflet = $request->file('link_pamflet');
        $pamflet_old = $request->input('pamflet_old');
        $desc_program = $request->input('desc_program');
        $link_daftar = $request->input('link_daftar');
        $link_meet = $request->input('link_meet');
        $sasaran_program = $request->input('sasaran_program');
        $perlengkapan = $request->input('perlengkapan');
        $mentor = $request->input('mentor');
        $profesi = $request->input('profesi');
        $link_cv = $request->input('link_cv');
        $tgl_mulai = $request->input('tgl_mulai');
        $tgl_selesai = $request->input('tgl_selesai');
        $jam_mulai = $request->input('jam_mulai');
        $jam_selesai = $request->input('jam_selesai');
        $jam_tambahan = $request->input('jam_tambahan');
        $metode_pelaksanaan = $request->input('metode_pelaksanaan');
        $link_map = $request->input('link_map');
        $biaya = $request->input('biaya');
        $harga_normal = $request->input('harga_normal');
        $harga_promo = $request->input('harga_promo');
        $link_jadwal = $request->input('link_jadwal');
        $link_dokumentasi = $request->input('link_dokumentasi');
        $status = $request->input('status');

        $data = [];
        $nmPamflet = '';

        // ===== FILE HANDLING
        $cekHasil = false;
        if ($request->hasFile('link_pamflet')) {
            // Delete File Lama
            $hapusPamflet = Storage::delete('public/images/programs/'.$pamflet_old);
            if ($hapusPamflet) {
                // Simpan File baru
                $simpanPamflet = $link_pamflet->store('/public/images/programs');
                if ($simpanPamflet) {
                    // == AMBIL NAMA FILE
                    $nmPamflet = pathinfo($simpanPamflet)['basename'];
                    $cekHasil = true;
                }
            }
        } else {
            $nmPamflet = $pamflet_old;
            $cekHasil = true;
        }

        if ($cekHasil) {
            $data = [
                'success' => true,
                'message' => 'Data berhasil diubah'
            ];
            // ===== UPDATE KE DATABASE
            Program::where('id', $id_program)
                    ->update(
                        [
                            'nama_program' => $nama_program,
                            'nama_kegiatan' => $nama_kegiatan,
                            'link_pamflet' => $nmPamflet,
                            'link_daftar' => $link_daftar,
                            'link_meet' => $link_meet,
                            'desc_program' => utf8_encode($desc_program),
                            'sasaran_program' => $sasaran_program,
                            'perlengkapan' => $perlengkapan,
                            'mentor' => $mentor,
                            'profesi' => $profesi,
                            'link_cv' => $link_cv,
                            'metode_pelaksanaan' => $metode_pelaksanaan,
                            'link_map' => $link_map,
                            'tgl_mulai' => $tgl_mulai,
                            'tgl_selesai' => $tgl_selesai,
                            'jam_mulai' => $jam_mulai,
                            'jam_selesai' => $jam_selesai,
                            'jam_tambahan' => $jam_tambahan,
                            'biaya' => $biaya,
                            'harga_normal' => $harga_normal,
                            'harga_promo' => $harga_promo,
                            'link_jadwal' => $link_jadwal,
                            'link_dokumentasi' => $link_dokumentasi,
                            'status' => $status
                        ]
                    );
        } else {
            $data = [
                'success' => false,
                'message' => 'Data gagal diubah'
            ];
        }
        return response()->json($data);
    }

    // ===== EXPORT EXCEL ====
        // === MIS 2021
    public function xlsmis() {
        //= DATA MIS
        $dtProposal = Proposal::select(DB::raw('user_akun.nm_lengkap, user_akun.email, data_proposal.no_hp, data_proposal.tempat_lahir, data_proposal.tgl_lahir, data_proposal.kota_domisili, data_proposal.pekerjaan, data_proposal.jenis_kelamin, data_proposal.role, data_proposal.url_proposal, data_proposal.bidang_bisnis, data_proposal.metode_bayar, data_proposal.url_bukti_bayar'))
                              ->rightJoin('user_akun', 'data_proposal.id_user', '=', 'user_akun.id')
                              ->orderBy('data_proposal.jenis_kelamin', 'desc')
                              ->get()->toArray();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);

        //Mengatur Width Columns
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(43);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(24);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(22);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(17);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(17);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(22);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(32);

        $spreadsheet->getActiveSheet()->getStyle('A5:N' . (count($dtProposal) + 4))->getAlignment()->setWrapText(true);
        $arrayBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A4:N' . (count($dtProposal) + 4))->applyFromArray($arrayBorders);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A2:N2');
        $sheet->setCellValue('A2', 'PESERTA MERINTIS INDONESIA SUMMIT 2021');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:N4')->getFont()->setBold(true);
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama');
        $sheet->setCellValue('C4', 'Email');
        $sheet->setCellValue('D4', 'Nomor HP');
        $sheet->setCellValue('E4', 'Tempat Lahir');
        $sheet->setCellValue('F4', 'Tanggal Lahir');
        $sheet->setCellValue('G4', 'Kota Domisili');
        $sheet->setCellValue('H4', 'Pekerjaan');
        $sheet->setCellValue('I4', 'Jenis Kelamin');
        $sheet->setCellValue('J4', 'Role');
        $sheet->setCellValue('K4', 'Proposal');
        $sheet->setCellValue('L4', 'Bidang Bisnis');
        $sheet->setCellValue('M4', 'Metode Bayar');
        $sheet->setCellValue('N4', 'Bukti Bayar');
        $sheet->getStyle('B5:N' . (count($dtProposal) + 4))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //Looping Foreach dtProposal
        $baris = 5;
        for ($i = 0; $i < count($dtProposal); $i++) {
            $sheet->setCellValue('A' . $baris, $i + 1);
            $sheet->getStyle('A' . $baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $baris)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->setCellValue('B' . $baris, $dtProposal[$i]['nm_lengkap']);
            $sheet->setCellValue('C' . $baris, $dtProposal[$i]['email']);
            $sheet->getStyle('C' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('C' . $baris)->getFont()->setUnderline(true);
            $spreadsheet->getActiveSheet()->getCell('C' . $baris)->getHyperlink()->setUrl('mailto:' . $dtProposal[$i]['email']);
            $sheet->setCellValue('D' . $baris, $dtProposal[$i]['no_hp']);
            $spreadsheet->getActiveSheet()->getStyle('D' . $baris)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
            $sheet->setCellValue('E' . $baris, $dtProposal[$i]['tempat_lahir']);
            $sheet->setCellValue('F' . $baris, $dtProposal[$i]['tgl_lahir']);
            $spreadsheet->getActiveSheet()->getStyle('F' . $baris)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
            $sheet->setCellValue('G' . $baris, $dtProposal[$i]['kota_domisili']);
            $sheet->setCellValue('H' . $baris, $dtProposal[$i]['pekerjaan']);
            $sheet->setCellValue('I' . $baris, $dtProposal[$i]['jenis_kelamin']);
            $sheet->setCellValue('J' . $baris, $dtProposal[$i]['role']);
            if ($dtProposal[$i]['url_proposal']) {
                $sheet->setCellValue('K' . $baris, asset('storage/proposal' .'/'. $dtProposal[$i]['url_proposal']));
                $spreadsheet->getActiveSheet()->getCell('K' . $baris)->getHyperlink()->setUrl(asset('storage/proposal' .'/'. $dtProposal[$i]['url_proposal']));
            }
            $sheet->getStyle('K' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('K' . $baris)->getFont()->setUnderline(true);
            $sheet->setCellValue('L' . $baris, $dtProposal[$i]['bidang_bisnis']);
            $sheet->setCellValue('M' . $baris, $dtProposal[$i]['metode_bayar']);
            if ($dtProposal[$i]['url_bukti_bayar']) {
                $sheet->setCellValue('N' . $baris, asset('storage/bukti_bayar/mis' .'/'. $dtProposal[$i]['url_bukti_bayar']));
                $spreadsheet->getActiveSheet()->getCell('N' . $baris)->getHyperlink()->setUrl(asset('storage/bukti_bayar/mis' .'/'. $dtProposal[$i]['url_bukti_bayar']));
            }
            $sheet->getStyle('N' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('N' . $baris)->getFont()->setUnderline(true);
            $baris++;
        }

        // Jumlah Submit dan Login + Last Updated
        $sheet->setCellValue('B' . (count($dtProposal) + 7), 'Last Updated: ' . date("d/m/Y"));
        $sheet->setCellValue('C' . (count($dtProposal) + 7), 'Peserta Login: ' . count($dtProposal));
        $jmlSubmit = 0;
        for ($i = 0; $i < count($dtProposal); $i++) {
            if ($dtProposal[$i]['url_proposal']) {
                $jmlSubmit++;
            }
        }
        $sheet->setCellValue('D' . (count($dtProposal) + 7), 'Submit Proposal: ' . $jmlSubmit);

        $filename = 'Rekap-Peserta-Merintis_Indonesia';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        // $writer = new Xlsx($spreadsheet);
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        // $writer->save($filename);
        exit;
    }

        // === FINALIS MIS 2021
    public function xlsfinalis() {
        // === DATA FINALIS
        $dtFinalis = Pengumuman::select(DB::raw('tbl_finalis50.id_finalis, user_akun.nm_lengkap, tbl_finalis50.nama_bisnis, tbl_finalis50.link_yt'))
                                    ->join('user_akun', 'tbl_finalis50.id_akun', '=', 'user_akun.id')
                                    ->get()
                                    ->toArray();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);

        //Mengatur Width Columns
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(24);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(32);
        $spreadsheet->getActiveSheet()->getStyle('A5:E' . (count($dtFinalis) + 5))->getAlignment()->setWrapText(true);
        $arrayBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A5:E' . (count($dtFinalis) + 5))->applyFromArray($arrayBorders);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A2', 'FINALIS TOP 50');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->mergeCells('A3:E3');
        $sheet->setCellValue('A3', 'MERINTIS INDONESIA SUMMIT 2021');
        $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3')->getFont()->setBold(true);
        $sheet->getStyle('A5:E5')->getFont()->setBold(true);
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'ID Finalis');
        $sheet->setCellValue('C5', 'Nama Tim');
        $sheet->setCellValue('D5', 'Nama Bisnis');
        $sheet->setCellValue('E5', 'Link Video');
        $sheet->getStyle('B5:E' . (count($dtFinalis) + 4))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //Looping Foreach dtProposal
        $baris = 6;
        for ($i = 0; $i < count($dtFinalis); $i++) {
            $sheet->setCellValue('A' . $baris, $i + 1);
            $sheet->getStyle('A' . $baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $baris)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->setCellValue('B' . $baris, $dtFinalis[$i]['id_finalis']);
            $sheet->getStyle('B6:B' . (count($dtFinalis) + 5))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('C' . $baris, $dtFinalis[$i]['nm_lengkap']);
            $sheet->setCellValue('D' . $baris, $dtFinalis[$i]['nama_bisnis']);
            $sheet->setCellValue('E' . $baris, $dtFinalis[$i]['link_yt']);
            if ($dtFinalis[$i]['link_yt']) {
                $spreadsheet->getActiveSheet()->getCell('E' . $baris)->getHyperlink()->setUrl($dtFinalis[$i]['link_yt']);
            }
            $sheet->getStyle('E' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('E' . $baris)->getFont()->setUnderline(true);
            $baris++;
        }
        // Jumlah Submit dan Login + Last Updated
        $sheet->setCellValue('C' . (count($dtFinalis) + 7), 'Last Updated: ' . date("d/m/Y"));
        $jmlSubmit = 0;
        for ($i = 0; $i < count($dtFinalis); $i++) {
            if ($dtFinalis[$i]['link_yt']) {
                $jmlSubmit++;
            }
        }
        $sheet->setCellValue('E' . (count($dtFinalis) + 7), 'Submit Video: ' . $jmlSubmit);

        $filename = 'Rekap-Finalis-Top50-Merintis_Indonesia';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

        // == PESERTA MISTALK
    public function xlsmistalk()
    {
         // === DATA MISTALK
        $datamistalk = Mistalk::select(DB::raw('user_akun.nm_lengkap, user_akun.email, user_akun.no_hp, data_program.nama_program, data_mistalk.ttl, data_mistalk.gender, data_mistalk.domisili, data_mistalk.instansi, data_mistalk.tanya, data_mistalk.metode_bayar, data_mistalk.bukti_bayar'))
                                ->leftJoin('user_akun', 'data_mistalk.id_akun', '=', 'user_akun.id')
                                ->leftJoin('data_program', 'data_mistalk.id_program', '=', 'data_program.id')
                                ->get()->toArray();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);

        //Mengatur Width Columns
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(42);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(18);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(50);

        $spreadsheet->getActiveSheet()->getStyle('A5:L' . (count($datamistalk) + 4))->getAlignment()->setWrapText(true);
        $arrayBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A4:L' . (count($datamistalk) + 4))->applyFromArray($arrayBorders);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A2:N2');
        $sheet->setCellValue('A2', 'DATA PESERTA MISTALK');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:L4')->getFont()->setBold(true);
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Lengkap');
        $sheet->setCellValue('C4', 'E-mail');
        $sheet->setCellValue('D4', 'No. HP');
        $sheet->setCellValue('E4', 'TTL');
        $sheet->setCellValue('F4', 'Gender');
        $sheet->setCellValue('G4', 'Domisili');
        $sheet->setCellValue('H4', 'Instansi');
        $sheet->setCellValue('I4', 'Pertanyaan');
        $sheet->setCellValue('J4', 'Nama Program');
        $sheet->setCellValue('K4', 'Metode Bayar');
        $sheet->setCellValue('L4', 'Bukti Bayar');
        $sheet->getStyle('B5:L' . (count($datamistalk) + 4))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //Looping Foreach datamistalk
        $baris = 5;
        for ($i = 0; $i < count($datamistalk); $i++) {
            $sheet->setCellValue('A' . $baris, $i + 1);
            $sheet->getStyle('A' . $baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $baris)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->setCellValue('B' . $baris, $datamistalk[$i]['nm_lengkap']);
            $sheet->setCellValue('C' . $baris, $datamistalk[$i]['email']);
            $sheet->getStyle('C' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('C' . $baris)->getFont()->setUnderline(true);
            $spreadsheet->getActiveSheet()->getCell('C' . $baris)->getHyperlink()->setUrl('mailto:' . $datamistalk[$i]['email']);
            $sheet->setCellValue('D' . $baris, $datamistalk[$i]['no_hp']);
            $sheet->setCellValue('E' . $baris, $datamistalk[$i]['ttl']);
            $sheet->setCellValue('F' . $baris, $datamistalk[$i]['gender']);
            $sheet->setCellValue('G' . $baris, $datamistalk[$i]['domisili']);
            $sheet->setCellValue('H' . $baris, $datamistalk[$i]['instansi']);
            $sheet->setCellValue('I' . $baris, $datamistalk[$i]['tanya']);
            $sheet->setCellValue('J' . $baris, $datamistalk[$i]['nama_program']);
            $sheet->setCellValue('K' . $baris, $datamistalk[$i]['metode_bayar']);
            $sheet->setCellValue('L' . $baris, $datamistalk[$i]['bukti_bayar']);
            $spreadsheet->getActiveSheet()->getCell('L' . $baris)->getHyperlink()->setUrl(asset('storage/bukti_bayar/mistalk'.'/'.$datamistalk[$i]['bukti_bayar']));
            $sheet->getStyle('L' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('L' . $baris)->getFont()->setUnderline(true);
            $baris++;
        }
        // Total + Last Updated
        $sheet->setCellValue('B' . (count($datamistalk) + 6), 'Total: ' . count($datamistalk));
        $sheet->setCellValue('B' . (count($datamistalk) + 7), 'Last Updated: ' . date("d/m/Y"));

        $filename = 'Data Mistalk';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

        // === PESERTA COACHING CLINIC
    public function xlscclinic() {
        $datacclinic = Cclinic::select(DB::raw('user_akun.nm_lengkap, user_akun.email, user_akun.no_hp, data_program.nama_program, data_cclinic.ttl, data_cclinic.domisili, data_cclinic.ide_bisnis, data_cclinic.bidang_bisnis, data_cclinic.masalah, data_cclinic.solusi, data_cclinic.target, data_cclinic.kebutuhan, data_cclinic.metode_bayar, data_cclinic.bukti_bayar'))
                                ->leftJoin('user_akun', 'data_cclinic.id_akun', '=', 'user_akun.id')
                                ->leftJoin('data_program', 'data_cclinic.id_program', '=', 'data_program.id')
                                ->get()->toArray();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);

        //Mengatur Width Columns
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(42);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(35);


        $spreadsheet->getActiveSheet()->getStyle('A5:O' . (count($datacclinic) + 4))->getAlignment()->setWrapText(true);
        $arrayBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A4:O' . (count($datacclinic) + 4))->applyFromArray($arrayBorders);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A2:O2');
        $sheet->setCellValue('A2', 'DATA PESERTA COACHING CLINIC');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:O4')->getFont()->setBold(true);
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Lengkap');
        $sheet->setCellValue('C4', 'E-mail');
        $sheet->setCellValue('D4', 'No. HP');
        $sheet->setCellValue('E4', 'TTL');
        $sheet->setCellValue('F4', 'Domisili');
        $sheet->setCellValue('G4', 'Metode Bayar');
        $sheet->setCellValue('H4', 'Bukti Bayar');
        $sheet->setCellValue('I4', 'Program');
        $sheet->setCellValue('J4', 'Ide Bisnis');
        $sheet->setCellValue('K4', 'Bidang Bisnis');
        $sheet->setCellValue('L4', 'Masalah');
        $sheet->setCellValue('M4', 'Solusi');
        $sheet->setCellValue('N4', 'Target Konsumen');
        $sheet->setCellValue('O4', 'Kebutuhan');
        $sheet->getStyle('B5:O' . (count($datacclinic) + 4))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //Looping Foreach datacclinic
        $baris = 5;
        for ($i = 0; $i < count($datacclinic); $i++) {
            $sheet->setCellValue('A' . $baris, $i + 1);
            $sheet->getStyle('A' . $baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $baris)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->setCellValue('B' . $baris, $datacclinic[$i]['nm_lengkap']);
            $sheet->setCellValue('C' . $baris, $datacclinic[$i]['email']);
            $sheet->getStyle('C' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('C' . $baris)->getFont()->setUnderline(true);
            $spreadsheet->getActiveSheet()->getCell('C' . $baris)->getHyperlink()->setUrl('mailto:' . $datacclinic[$i]['email']);
            $sheet->setCellValue('D' . $baris, $datacclinic[$i]['no_hp']);
            $sheet->setCellValue('E' . $baris, $datacclinic[$i]['ttl']);
            $sheet->setCellValue('F' . $baris, $datacclinic[$i]['domisili']);
            $sheet->setCellValue('G' . $baris, $datacclinic[$i]['metode_bayar']);
            $sheet->setCellValue('H' . $baris, $datacclinic[$i]['bukti_bayar']);
            if($datacclinic[$i]['bukti_bayar']) {
                $spreadsheet->getActiveSheet()->getCell('H' . $baris)->getHyperlink()->setUrl(asset('storage/bukti_bayar/coachclinic'.'/'.$datacclinic[$i]['bukti_bayar']));
                $sheet->getStyle('H' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
                $sheet->getStyle('H' . $baris)->getFont()->setUnderline(true);
            }
            $sheet->setCellValue('I' . $baris, $datacclinic[$i]['nama_program']);
            $sheet->setCellValue('J' . $baris, $datacclinic[$i]['ide_bisnis']);
            $sheet->setCellValue('K' . $baris, $datacclinic[$i]['bidang_bisnis']);
            $sheet->setCellValue('L' . $baris, $datacclinic[$i]['masalah']);
            $sheet->setCellValue('M' . $baris, $datacclinic[$i]['solusi']);
            $sheet->setCellValue('N' . $baris, $datacclinic[$i]['target']);
            $sheet->setCellValue('O' . $baris, $datacclinic[$i]['kebutuhan']);
            $baris++;
        }
        // Total + Last Updated
        $sheet->setCellValue('B' . (count($datacclinic) + 6), 'Total: ' . count($datacclinic));
        $sheet->setCellValue('B' . (count($datacclinic) + 7), 'Last Updated: ' . date("d/m/Y"));

        $filename = 'Data Coaching Clinic';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

        // === PESERTA KULIAH BISNIS
    public function xlskuliahbisnis() {
        //Proses Excel
        $datakubis = KuliahBisnis::select(DB::raw('user_akun.nm_lengkap, user_akun.email, user_akun.no_hp, data_program.nama_program, data_kubis.ttl, data_kubis.domisili, data_kubis.ide_bisnis, data_kubis.bidang_bisnis, data_kubis.masalah, data_kubis.solusi, data_kubis.target, data_kubis.kebutuhan, data_kubis.metode_bayar, data_kubis.bukti_bayar'))
                                ->leftJoin('user_akun', 'data_kubis.id_akun', '=', 'user_akun.id')
                                ->leftJoin('data_program', 'data_kubis.id_program', '=', 'data_program.id')
                                ->get()->toArray();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Calibri');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(12);

        //Mengatur Width Columns
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(42);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(32);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(35);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(35);

        $spreadsheet->getActiveSheet()->getStyle('A5:O' . (count($datakubis) + 4))->getAlignment()->setWrapText(true);
        $arrayBorders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $spreadsheet->getActiveSheet()->getStyle('A4:O' . (count($datakubis) + 4))->applyFromArray($arrayBorders);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->mergeCells('A2:O2');
        $sheet->setCellValue('A2', 'DATA PESERTA KULIAH BISNIS');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:O4')->getFont()->setBold(true);
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Lengkap');
        $sheet->setCellValue('C4', 'E-mail');
        $sheet->setCellValue('D4', 'No. HP');
        $sheet->setCellValue('E4', 'TTL');
        $sheet->setCellValue('F4', 'Domisili');
        $sheet->setCellValue('G4', 'Metode Bayar');
        $sheet->setCellValue('H4', 'Bukti Bayar');
        $sheet->setCellValue('I4', 'Program');
        $sheet->setCellValue('J4', 'Ide Bisnis');
        $sheet->setCellValue('K4', 'Bidang Bisnis');
        $sheet->setCellValue('L4', 'Masalah');
        $sheet->setCellValue('M4', 'Solusi');
        $sheet->setCellValue('N4', 'Target Konsumen');
        $sheet->setCellValue('O4', 'Kebutuhan');
        $sheet->getStyle('B5:O' . (count($datakubis) + 4))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //Looping Foreach datacclinic
        $baris = 5;
        for ($i = 0; $i < count($datakubis); $i++) {
            $sheet->setCellValue('A' . $baris, $i + 1);
            $sheet->getStyle('A' . $baris)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $baris)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->setCellValue('B' . $baris, $datakubis[$i]['nm_lengkap']);
            $sheet->setCellValue('C' . $baris, $datakubis[$i]['email']);
            $sheet->getStyle('C' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
            $sheet->getStyle('C' . $baris)->getFont()->setUnderline(true);
            $spreadsheet->getActiveSheet()->getCell('C' . $baris)->getHyperlink()->setUrl('mailto:' . $datakubis[$i]['email']);
            $sheet->setCellValue('D' . $baris, $datakubis[$i]['no_hp']);
            $sheet->setCellValue('E' . $baris, $datakubis[$i]['ttl']);
            $sheet->setCellValue('F' . $baris, $datakubis[$i]['domisili']);
            $sheet->setCellValue('G' . $baris, $datakubis[$i]['metode_bayar']);
            $sheet->setCellValue('H' . $baris, $datakubis[$i]['bukti_bayar']);
            if($datakubis[$i]['bukti_bayar']) {
                $spreadsheet->getActiveSheet()->getCell('H' . $baris)->getHyperlink()->setUrl(asset('storage/bukti_bayar/kuliahbisnis'.'/'.$datakubis[$i]['bukti_bayar']));
                $sheet->getStyle('H' . $baris)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
                $sheet->getStyle('H' . $baris)->getFont()->setUnderline(true);
            }
            $sheet->setCellValue('I' . $baris, $datakubis[$i]['nama_program']);
            $sheet->setCellValue('J' . $baris, $datakubis[$i]['ide_bisnis']);
            $sheet->setCellValue('K' . $baris, $datakubis[$i]['bidang_bisnis']);
            $sheet->setCellValue('L' . $baris, $datakubis[$i]['masalah']);
            $sheet->setCellValue('M' . $baris, $datakubis[$i]['solusi']);
            $sheet->setCellValue('N' . $baris, $datakubis[$i]['target']);
            $sheet->setCellValue('O' . $baris, $datakubis[$i]['kebutuhan']);
            $baris++;
        }
        // Total + Last Updated
        $sheet->setCellValue('B' . (count($datakubis) + 6), 'Total: ' . count($datakubis));
        $sheet->setCellValue('B' . (count($datakubis) + 7), 'Last Updated: ' . date("d/m/Y"));

        $filename = 'Data Kuliah Bisnis';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}
