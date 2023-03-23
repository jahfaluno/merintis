<?php

namespace App\Http\Controllers;

use App\Lupapass;
use App\UserAkun;
use App\SessionAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AkunController extends Controller
{
    // ========= BUAT AKUN
    public function buatakun(Request $request)
    {
        // return UserAkun::cekemail('coba@coba.com')->get();
        $nm_lengkap = $request->input('nm_lengkap');
        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $password = $request->input('password');
        
        $validatedData = FacadesValidator::make($request->all(),[
            'nm_lengkap' => 'required|max:255',
            'email' => 'required|email|unique:App\UserAkun,email',
            'no_hp' => 'required|numeric',
            'password' => 'required|min:8',
            'pass_confirm' => 'required|same:password'
        ],
        [
            'nm_lengkap.required' => 'Nama harus diisi',
            'nm_lengkap.max' => 'Karakter melebihi batas',
            'email.unique' => 'Email sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.numeric' => 'Hanya boleh angka',
            'no_hp.max' => 'Karakter melebihi batas',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Minimal 8 karakter',
            'pass_confirm.required' => 'Konfirmasi password harus diisi',
            'pass_confirm.same' => 'Password tidak sama'
        ]);
        
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

		$options = array('cost' => 11);
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);
		$data = [
			'nm_lengkap' => $nm_lengkap,
			'email' => $email,
			'no_hp' => $no_hp,
			'password' => $hash,
            'remember_token' => ''
		];
		$akunBaru = UserAkun::insert($data);
		//------ JIKA GAGAL DISIMPAN -------
		if (!$akunBaru) {
			$gagal = [
				'success' => false,
				'error' => 'Gagal disimpan'
			];
            return response()->json($gagal);
		}

		//------ JIKA BERHASIL DISIMPAN -------
		$berhasil = [
			'success' => true,
			'message' => 'Data berhasil disimpan'
		];
		return response()->json($berhasil);
    }

    // ========= LOGIN AKUN
    public function loginakun(Request $request)
    {
        // validasi input
        $email = $request->input('email');
		$passwd = $request->input('passwd');
		$remember = $request->input('remember');

        $validatedData = FacadesValidator::make($request->all(),[
            'email' => 'required|email',
            'passwd' => 'required'
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'passwd.required' => 'Password harus diisi'
        ]);
        
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        $user = UserAkun::cekemail($email)->get();
        if (count($user) < 1) {
            $data = [
                'success' => false,
                'message' => 'Email belum terdaftar'
            ];
            return response()->json($data);
        } else {
            if (password_verify($passwd, $user[0]['password'])) {
                // ---------------- JIKA LOGIN BERHASIL
					// --- BUAT TOKEN LOGIN
				$length = 12;
				$token = bin2hex(random_bytes($length));
				$sessionData = [
					'id_akun' => $user[0]["id"],
					'token' => $token
				];
				SessionAkun::insert($sessionData);
                // --- END BUAT TOKEN LOGIN
                $data = [
                    'success' => true,
                    'message' => 'Sign In berhasil'
                ];
                // PAKAI AUTH
                if (Auth::attempt(['email' =>$email, 'password' => $passwd], $remember)) {
                    return response()->json($data);  
                }
            } else {
                $data = [
                    'success' => false,
                    'message' => 'Password salah'
                ];
                return response()->json($data);  
            }
        }
    } 

    // ========= KELUAR AKUN
    public function hapussession()
    {
        $idAkun = Auth::id();
        SessionAkun::where('id_akun', $idAkun)->delete();
        Auth::logout();
    }

    // =========== LUPA PASSWORD
    public function lupapass(Request $request)
    {
        $email = $request->input('email');
        // === VALIDASI INPUT EMAIL FORM LUPA PASSWORD
        $validatedData = FacadesValidator::make($request->all(),[
            'email' => 'required|email|exists:App\UserAkun,email',
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email belum terdaftar'
        ]);
        
        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }
                    
        // -----SIMPAN EMAIL DAN TOKEN
        //----- buat token random
        $token = mt_rand(100000, 999999);
        // ----- SIMPAN KE DB
        $smpToken = Lupapass::insert([
            "email"	=> $email,
            "temp_token" =>	$token
        ]);
            //--- KIRIM EMAIL
            $this->sendEmailLupa($email, $token);
            if (Mail::failures()) {
                $gagal = [
                    "success" => false,
                    "message" => "Kode reset gagal dikirim"
                    // "message" => Mail::failures()
                ];
                return response()->json($gagal);
            } else {
                $berhasil = [
                    "success" => true,
                    "message" => "Kode reset berhasil dikirim <br/><b>Cek Email Anda</b>"
                ];
                return response()->json($berhasil);
            }
            //--- END KIRIM EMAIL
        // ---- END SIMPAN EMAIL DAN TOKEN
    }

    public function ubahpass(Request $request) {
        $email = $request->input('email');
        $token = $request->input('kodereset');
        $passwd = $request->input('passwd');

        // ==== CEK VALIDASI UBAH PASSWORD
        $validatedData = FacadesValidator::make($request->all(),[
            'email' => 'required|email|exists:App\UserAkun,email',
            'kodereset' => 'required|exists:App\Lupapass,temp_token',
            'passwd' => 'required|min:8',
            'konfpasswd' => 'required|same:passwd'
        ],
        [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email belum terdaftar',
            'kodereset.required' => 'Kode reset harus diisi',
            'kodereset.exists' => 'Kode reset salah',
            'passwd.required' => 'Password harus diisi',
            'passwd.min' => 'Minimal 8 karakter',
            'konfpasswd.required' => 'Konfirmasi password harus diisi',
            'konfpasswd.same' => 'Password tidak sama'
        ]);

        if ($validatedData->fails()) {
            $data = [
                'success' => false,
                'errors' => $validatedData->errors()->toArray()
            ];
            return response()->json($data);
        }

        $options = array("cost" => 11);
		$hash = password_hash($passwd, PASSWORD_BCRYPT, $options);
        // -- UBAH PASSWORD
        $ubahPass = UserAkun::where('email', $email)->update(['password' => $hash]);
        $delToken = Lupapass::where('temp_token', $token)->delete();
        if (!$ubahPass) {
            $gagal = [
                "success" => false,
                "message"	=> "Password gagal diubah"
            ];
            return response()->json($gagal);
        } else {
            $berhasil = [
                "success" => true,
                "message"	=> "Password berhasil diubah"
            ];
            return response()->json($berhasil);
        }
    }


    // ========================== FUNCTION SEND EMAIL TOKEN
    private function sendEmailLupa($to, $token) {
        Mail::send('mail_template.maillupa', ['to' => $to, 'token' => $token], function ($message)use($to) {
            $message->from('engineering@merintisindonesia.com', 'MERINTIS INDONESIA');
            $message->subject('RESET PASSWORD MERINTIS INDONESIA');
            $message->to($to);
        });
    }
    // ========================== END FUNCTION SEND EMAIL TOKEN
}
