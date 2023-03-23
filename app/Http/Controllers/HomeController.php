<?php

namespace App\Http\Controllers;

use App\Mistalk;
use App\Cclinic;
use App\KuliahBisnis;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('mainpage.home');
    }

    public function signin()
    {
        if (Auth::check()) {
            return redirect('/');
          }
        return view('mainpage.signin');
    }

    public function signup()
    {
        if (Auth::check()) {
            return redirect('/');
          }
        return view('mainpage.signup');
    }

    public function lupapass()
    {
        return view('mainpage.lupapass');
    }

    // BAGIAN PROGRAM
        // DETAIL UPCOMING
        public function detailupcoming($id)
        {
            $upcoProg = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, perlengkapan, mentor, profesi, link_cv, metode_pelaksanaan, link_map, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, jam_tambahan, biaya, harga_normal, harga_promo"))->where('id', $id)->get()->toArray();
            return view('programpage.detailupcoming', compact('upcoProg'));
        }

        // DAFTAR MISTALK
        public function daftarmistalk($id)
        {
            $upcoProg = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, perlengkapan, mentor, profesi, link_cv, metode_pelaksanaan, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, biaya, harga_normal, harga_promo"))->where('id', $id)->where('link_daftar', 'mistalk')->get()->toArray();
            return view('programpage.daftarmistalk', compact('upcoProg'));
        }

        // DAFTAR CCLINIC
        public function daftarcclinic($id)
        {
            $upcoProg = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, perlengkapan, mentor, profesi, link_cv, metode_pelaksanaan, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, biaya, harga_normal, harga_promo"))->where('id', $id)->where('link_daftar', 'coachclinic')->get()->toArray();
            return view('programpage.daftarcclinic', compact('upcoProg'));
        }

        // DAFTAR KULIAH BISNIS
        public function daftarkubis($id)
        {
            $upcoProg = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, perlengkapan, mentor, profesi, link_cv, metode_pelaksanaan, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, biaya, harga_normal, harga_promo"))->where('id', $id)->where('link_daftar', 'kubis')->get()->toArray();
            return view('programpage.daftarkubis', compact('upcoProg'));
        }

        public function suksesdaftar()
        {
            return view('programpage.sukses');
        }

    // Proses Program
        // PAST
    public function pastprogram($next)
    {
        $pastProg = Program::select('nama_program', 'link_pamflet', 'link_dokumentasi')->where('status', 'past')->offset($next)->limit(12)->get();
        $ttlPastProg = Program::select('nama_program', 'link_pamflet', 'link_dokumentasi')->where('status', 'past')->get();
        $ttlPastProg = sizeof($ttlPastProg);
        $data = [
            'pastProg'      => $pastProg,
            'ttlPastProg'   => $ttlPastProg,
            'next'          => $next
        ];
		return response()->json($data);
    }

        // ONGOING
	public function ongoingprogram() {
		$ongoProg = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, jam_tambahan"))->where('status', 'on-going')->get();
        return response()->json($ongoProg);
	}

        // DETAIL ONGOIG
    public function detailongoing($id)
    {
        $detailOngo = Program::select(DB::raw("nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, jam_tambahan, link_jadwal, link_dokumentasi, status"))->where('id', $id)->get();
        return view('programpage.detailongoing', compact('detailOngo'));
    }

        // UPCOMING
	public function upcomingprogram() {
		$upcoProg = Program::select(DB::raw("id, nama_program, nama_kegiatan, link_pamflet, link_daftar, desc_program, sasaran_program, tgl_mulai, tgl_selesai, DATE_FORMAT(jam_mulai, '%H:%i') as jam_mulai, DATE_FORMAT(jam_selesai, '%H:%i') as jam_selesai, jam_tambahan, metode_pelaksanaan"))->where('status', 'upcoming')->get();
        return response()->json($upcoProg);
	}

    // DAFTAR MISTALK
    public function prosesmistalk(Request $request)
    {
        $validatedData = FacadesValidator::make($request->all(),[
            'nm_lengkap' => 'required',
            'ttl' => 'required',
            'gender' => 'required',
            'kota_domisili' => 'required',
            'instansi' => 'required',
            'tanya' => 'required',
            'bukti_bayar' => 'required|file|max:2048|mimes:jpg,jpeg,png',
            'id_akun' => 'required',
            'id_program' => 'required',
            'metode_bayar' => 'required'
        ],
        [
            'nm_lengkap.required' => 'Nama lengkap wajib diisi',
            'ttl.required' => 'Tempat, tanggal lahir wajib diisi',
            'gender.required' => 'Gender wajib diisi',
            'kota_domisili.required' => 'Kota domisili wajib diisi',
            'instansi.required' => 'Instansi wajib diisi',
            'tanya.required' => 'Pertanyaan wajib diisi',
            'bukti_bayar.required' => 'Unggah bukti bayar',
            'bukti_bayar.file' => 'Unggah bukti bayar',
            'bukti_bayar.max' => 'Ukuran maksimal 2MB',
            'bukti_bayar.mimes' => 'Tipe gambar yang diizinkan jpg/jpeg/png',
            'id_akun.required' => 'Id akun kosong',
            'id_program.required' => 'Id program kosong',
            'metode_bayar.required' => 'Pilih salah satu'
        ]);
        // dd($request);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        // == AMBIL DATA
        $id_akun = $request->input('id_akun');
        $id_program = $request->input('id_program');
        $ttl = $request->input('ttl');
        $gender = $request->input('gender');
        $kota_domisili = $request->input('kota_domisili');
        $instansi = $request->input('instansi');
        $tanya = $request->input('tanya');
        $metode_bayar = $request->input('metode_bayar');
        $bukti_bayar = $request->file('bukti_bayar');

        $data = [];
        // == FILE HANDLING
        $simpanBukti = $bukti_bayar->store('/public/bukti_bayar/mistalk');
        if ($simpanBukti) {
            // === AMBIL NAMA FILE
            $simpanBukti = pathinfo($simpanBukti)['basename'];
            // ===== SIMPAN KE DATABASE
            Mistalk::insert(
                [
                  'id_akun'  => $id_akun,
                  'id_program' => $id_program,
                  'ttl' => $ttl,
                  'gender' => $gender,
                  'domisili' => $kota_domisili,
                  'instansi' => $instansi,
                  'tanya' => $tanya,
                  'metode_bayar' => $metode_bayar,
                  'bukti_bayar' => $simpanBukti
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

    // DAFTAR COACHING CLINIC
    public function prosescclinic(Request $request)
    {
        $validatedData = FacadesValidator::make($request->all(),[
            'id_akun' => 'required',
            'id_program' => 'required',
            'nm_lengkap' => 'required',
            'ttl' => 'required',
            'kota_domisili' => 'required',
            'ide_bisnis' => 'required',
            'bidang_bisnis' => 'required',
            'masalah' => 'required',
            'solusi' => 'required',
            'target' => 'required',
            'kebutuhan' => 'required',
            'bukti_bayar' => 'required|file|max:2048|mimes:jpg,jpeg,png',
            'metode_bayar' => 'required'
        ],
        [
            'nm_lengkap.required' => 'Nama lengkap wajib diisi',
            'ttl.required' => 'Tempat, tanggal lahir wajib diisi',
            'kota_domisili.required' => 'Kota domisili wajib diisi',
            'ide_bisnis.required' => 'Ide bisnis wajib diisi',
            'bidang_bisnis.required' => 'Bidang bisnis wajib diisi',
            'masalah.required' => 'Detail masalah wajib diisi',
            'solusi.required' => 'Ceritakan solusimu',
            'target.required' => 'Target konsumen wajib diisi',
            'kebutuhan.required' => 'Kebutuhan wajib diisi',
            'bukti_bayar.required' => 'Unggah bukti bayar',
            'bukti_bayar.file' => 'Unggah bukti bayar',
            'bukti_bayar.max' => 'Ukuran maksimal 2MB',
            'bukti_bayar.mimes' => 'Tipe gambar yang diizinkan jpg/jpeg/png',
            'metode_bayar.required' => 'Pilih salah satu',
            'id_akun.required' => 'Id akun kosong',
            'id_program.required' => 'Id program kosong'
        ]);
        // dd($request);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        // == AMBIL DATA
        $id_akun = $request->input('id_akun');
        $id_program = $request->input('id_program');
        $ttl = $request->input('ttl');
        $kota_domisili = $request->input('kota_domisili');
        $ide_bisnis = $request->input('ide_bisnis');
        $bidang_bisnis = $request->input('bidang_bisnis');
        $masalah = $request->input('masalah');
        $solusi = $request->input('solusi');
        $target = $request->input('target');
        $kebutuhan = $request->input('kebutuhan');
        $metode_bayar = $request->input('metode_bayar');
        $bukti_bayar = $request->file('bukti_bayar');

        $data = [];
        // ===== SIMPAN KE DATABASE
        // == FILE HANDLING
        $simpanBukti = $bukti_bayar->store('/public/bukti_bayar/coachclinic');
        if ($simpanBukti) {
            // === AMBIL NAMA FILE
            $simpanBukti = pathinfo($simpanBukti)['basename'];
            // ===== SIMPAN KE DATABASE
            Cclinic::insert(
                    [
                    'id_akun'  => $id_akun,
                    'id_program' => $id_program,
                    'ttl' => $ttl,
                    'domisili' => $kota_domisili,
                    'ide_bisnis' => $ide_bisnis,
                    'bidang_bisnis' => $bidang_bisnis,
                    'masalah' => $masalah,
                    'solusi' => $solusi,
                    'target' => $target,
                    'kebutuhan' => $kebutuhan,
                    'metode_bayar' => $metode_bayar,
                    'bukti_bayar' => $simpanBukti
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

    // DAFTAR KUBIS
    public function proseskubis(Request $request) {
        $validatedData = FacadesValidator::make($request->all(),[
            'id_akun' => 'required',
            'id_program' => 'required',
            'nm_lengkap' => 'required',
            'ttl' => 'required',
            'kota_domisili' => 'required',
            'ide_bisnis' => 'required',
            'bidang_bisnis' => 'required',
            'masalah' => 'required',
            'solusi' => 'required',
            'target' => 'required',
            'kebutuhan' => 'required',
            'bukti_bayar' => 'required|file|max:2048|mimes:jpg,jpeg,png',
            'metode_bayar' => 'required'
        ],
        [
            'nm_lengkap.required' => 'Nama lengkap wajib diisi',
            'ttl.required' => 'Tempat, tanggal lahir wajib diisi',
            'kota_domisili.required' => 'Kota domisili wajib diisi',
            'ide_bisnis.required' => 'Ide bisnis wajib diisi',
            'bidang_bisnis.required' => 'Bidang bisnis wajib diisi',
            'masalah.required' => 'Detail masalah wajib diisi',
            'solusi.required' => 'Ceritakan solusimu',
            'target.required' => 'Target konsumen wajib diisi',
            'kebutuhan.required' => 'Kebutuhan wajib diisi',
            'bukti_bayar.required' => 'Unggah bukti bayar',
            'bukti_bayar.file' => 'Unggah bukti bayar',
            'bukti_bayar.max' => 'Ukuran maksimal 2MB',
            'bukti_bayar.mimes' => 'Tipe gambar yang diizinkan jpg/jpeg/png',
            'metode_bayar.required' => 'Pilih salah satu',
            'id_akun.required' => 'Id akun kosong',
            'id_program.required' => 'Id program kosong'
        ]);
        // dd($request);
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        // == AMBIL DATA
        $id_akun = $request->input('id_akun');
        $id_program = $request->input('id_program');
        $ttl = $request->input('ttl');
        $kota_domisili = $request->input('kota_domisili');
        $ide_bisnis = $request->input('ide_bisnis');
        $bidang_bisnis = $request->input('bidang_bisnis');
        $masalah = $request->input('masalah');
        $solusi = $request->input('solusi');
        $target = $request->input('target');
        $kebutuhan = $request->input('kebutuhan');
        $metode_bayar = $request->input('metode_bayar');
        $bukti_bayar = $request->file('bukti_bayar');

        $data = [];
        // ===== SIMPAN KE DATABASE
        // == FILE HANDLING
        $simpanBukti = $bukti_bayar->store('/public/bukti_bayar/kuliahbisnis');
        if ($simpanBukti) {
            // === AMBIL NAMA FILE
            $simpanBukti = pathinfo($simpanBukti)['basename'];
            // ===== SIMPAN KE DATABASE
            KuliahBisnis::insert(
                    [
                    'id_akun'  => $id_akun,
                    'id_program' => $id_program,
                    'ttl' => $ttl,
                    'domisili' => $kota_domisili,
                    'ide_bisnis' => $ide_bisnis,
                    'bidang_bisnis' => $bidang_bisnis,
                    'masalah' => $masalah,
                    'solusi' => $solusi,
                    'target' => $target,
                    'kebutuhan' => $kebutuhan,
                    'metode_bayar' => $metode_bayar,
                    'bukti_bayar' => $simpanBukti
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


    // ========================== FUNCTION SEND EMAIL NOTIF SUKSES
    private function sendEmailNotif($to, $program, $linkmeet, $jadwal) {
        Mail::send('mail_template.mailsukses', ['to' => $to, 'program' => $program, 'linkmeet' => $linkmeet, 'jadwal' => $jadwal], function ($message)use($to) {
            $message->from('engineering@merintisindonesia.com', 'MERINTIS INDONESIA');
            $message->subject('[INFO] MERINTIS INDONESIA');
            $message->to($to);
        });
    }
    // ========================== END FUNCTION SEND EMAIL NOTIF SUKSES

}
