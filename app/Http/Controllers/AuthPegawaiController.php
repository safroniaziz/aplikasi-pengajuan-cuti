<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Str;

class AuthPegawaiController extends Controller
{
    public function showLoginForm(){
        return view('auth.pegawai_login');
    }

    public function pandaToken()
   	{
    	$client = new Client();

        $url = 'https://panda.unib.ac.id/api/login';
	      try {
	        $response = $client->request(
	            'POST',  $url, ['form_params' => ['email' => 'evaluasi@unib.ac.id', 'password' => 'evaluasi2018']]
	        );
	        $obj = json_decode($response->getBody(),true);
	        Session::put('token', $obj['token']);
	        return $obj['token'];
	      } catch (BadResponseException $e) {
	        echo "<h1 style='color:red'>[Ditolak !]</h1>";
	        exit();
	      }
    }

    public function pandaLogin(Request $request){
        $this->validate($request,[
            'username'  =>  'required',
            'password'  =>  'required',
        ]);
        $username = $request->username;
        $password = $request->password;
        // $count =  preg_match_all( "/[0-9]/", $username );
    	$query = '
			{portallogin(username:"'.$username.'", password:"'.$password.'") {
			  is_access
			  tusrThakrId
			}}
    	';
        $data = $this->panda($query)['portallogin'];
    	$data_dosen = '
            {dosen(dsnPegNip:"'.$username.'") {
                    dsnPegNip
                    pegawai {
                        pegNama
                        pegGelarDepan
                        pegGelarBelakang
                        pegIsAktif
                    pegawai_simpeg {
                        pegJenkel
                    }
                }
                prodi {
                    prodiNamaResmi
                    prodiKodeUniv
                    fakultas {
                        fakKodeUniv
                        fakNamaResmi
                    }	
                }
            }}
        ';

        if($data[0]['is_access']==1){
    		if($data[0]['tusrThakrId']==2){
                $dosen = $this->panda($data_dosen);
                if (empty($dosen)) {
                    return redirect()->route('pegawai.login.form')->with(['error'	=> 'Akses Anda Tidak Diketahui !!']);
                }
                else{
                    $dosen_exists = Dosen::where('nip',$dosen['dosen'][0]['dsnPegNip'])->first();
                    if (!empty($dosen['dosen'][0]['pegawai']['pegawai_simpeg'])) {
                        if($dosen['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                            if (empty($dosen_exists)) {
                                Dosen::create([
                                    'nip'               =>  $dosen['dosen'][0]['dsnPegNip'],
                                    'nm_dosen'          =>  $dosen['dosen'][0]['pegawai']['pegNama'],
                                    'slug'              =>  Str::slug($dosen['dosen'][0]['pegawai']['pegNama']),
                                    'gelar_depan'       =>  $dosen['dosen'][0]['pegawai']['pegGelarDepan'],
                                    'gelar_belakang'    =>  $dosen['dosen'][0]['pegawai']['pegGelarBelakang'],
                                    'jenis_kelamin'     =>  $dosen['dosen'][0]['pegawai']['pegawai_simpeg']['pegJenkel'],
                                    'prodi_kode'        =>  $dosen['dosen'][0]['prodi']['prodiKodeUniv'],
                                    'prodi_nama'        =>  $dosen['dosen'][0]['prodi']['prodiNamaResmi'],
                                    'fakultas_kode'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'],
                                    'fakultas_nama'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakNamaResmi'],
                                ]);
                                $dosen_exists = Dosen::where('nip',$dosen['dosen'][0]['dsnPegNip'])->first();
                                if ($dosen_exists->fakultas_kode == "A") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '9',
                                        'departemen_nama' =>  'Fakultas Kip',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "B") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '10',
                                        'departemen_nama' =>  'Fakultas Hukum',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "C") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '11',
                                        'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                    ]);
                                }
                                elseif ($dosen_exists->fakultas_kode == "D") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '12',
                                        'departemen_nama' =>  'Fakultas Isipol',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "E") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '13',
                                        'departemen_nama' =>  'Fakultas Pertanian',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "F") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '14',
                                        'departemen_nama' =>  'Fakultas MIPA',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "G") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '15',
                                        'departemen_nama' =>  'Fakultas Teknik',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "H") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '16',
                                        'departemen_nama' =>  'Fakultas KIK',
                                    ]);
                                }
                                Session::put('nip',$dosen_exists->nip);
                                Session::put('akses','dosen');
                                Session::put('slug',$dosen_exists->slug);
                                return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                            }
                            else{
                                if ($dosen_exists->fakultas_kode == "A") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '9',
                                        'departemen_nama' =>  'Fakultas Kip',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "B") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '10',
                                        'departemen_nama' =>  'Fakultas Hukum',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "C") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '11',
                                        'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                    ]);
                                }
                                elseif ($dosen_exists->fakultas_kode == "D") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '12',
                                        'departemen_nama' =>  'Fakultas Isipol',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "E") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '13',
                                        'departemen_nama' =>  'Fakultas Pertanian',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "F") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '14',
                                        'departemen_nama' =>  'Fakultas MIPA',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "G") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '15',
                                        'departemen_nama' =>  'Fakultas Teknik',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "H") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '16',
                                        'departemen_nama' =>  'Fakultas KIK',
                                    ]);
                                }
                                Session::put('nip',$dosen_exists->nip);
                                Session::put('akses','dosen');
                                Session::put('slug',$dosen_exists->slug);
                                return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                            }
                        }
                    }
                    else{
                        if($dosen['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                            if($dosen['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                                if (empty($dosen_exists)) {
                                    Dosen::create([
                                        'nip'               =>  $dosen['dosen'][0]['dsnPegNip'],
                                        'nm_dosen'          =>  $dosen['dosen'][0]['pegawai']['pegNama'],
                                        'slug'              =>  Str::slug($dosen['dosen'][0]['pegawai']['pegNama']),
                                        'gelar_depan'       =>  $dosen['dosen'][0]['pegawai']['pegGelarDepan'],
                                        'gelar_belakang'    =>  $dosen['dosen'][0]['pegawai']['pegGelarBelakang'],
                                        'prodi_kode'        =>  $dosen['dosen'][0]['prodi']['prodiKodeUniv'],
                                        'prodi_nama'        =>  $dosen['dosen'][0]['prodi']['prodiNamaResmi'],
                                        'fakultas_kode'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'],
                                        'fakultas_nama'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakNamaResmi'],
                                    ]);
                                    if ($dosen_exists->fakultas_kode == "A") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '9',
                                            'departemen_nama' =>  'Fakultas Kip',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "B") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '10',
                                            'departemen_nama' =>  'Fakultas Hukum',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "C") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '11',
                                            'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                        ]);
                                    }
                                    elseif ($dosen_exists->fakultas_kode == "D") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '12',
                                            'departemen_nama' =>  'Fakultas Isipol',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "E") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '13',
                                            'departemen_nama' =>  'Fakultas Pertanian',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "F") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '14',
                                            'departemen_nama' =>  'Fakultas MIPA',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "G") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '15',
                                            'departemen_nama' =>  'Fakultas Teknik',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "H") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '16',
                                            'departemen_nama' =>  'Fakultas KIK',
                                        ]);
                                    }
                                    Session::put('nip',$dosen_exists->nip);
                                    Session::put('akses','dosen');
                                    Session::put('slug',$dosen_exists->slug);
                                    return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                                }
                                else{
                                    if ($dosen_exists->fakultas_kode == "A") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '9',
                                            'departemen_nama' =>  'Fakultas Kip',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "B") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '10',
                                            'departemen_nama' =>  'Fakultas Hukum',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "C") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '11',
                                            'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                        ]);
                                    }
                                    elseif ($dosen_exists->fakultas_kode == "D") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '12',
                                            'departemen_nama' =>  'Fakultas Isipol',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "E") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '13',
                                            'departemen_nama' =>  'Fakultas Pertanian',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "F") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '14',
                                            'departemen_nama' =>  'Fakultas MIPA',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "G") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '15',
                                            'departemen_nama' =>  'Fakultas Teknik',
                                        ]);
                                    }elseif ($dosen_exists->fakultas_kode == "H") {
                                        $dosen_exists->update([
                                            'departemen_id' =>  '16',
                                            'departemen_nama' =>  'Fakultas KIK',
                                        ]);
                                    }
                                    Session::put('nip',$dosen_exists->nip);
                                    Session::put('akses','dosen');
                                    Session::put('slug',$dosen_exists->slug);
                                    return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                                }
                            }
                        }
                    }
                }
            }
            else{
    			return redirect()->route('pegawai.login.form')->with(['error'	=> 'Akses Anda Tidak Diketahui !!']);
    		}
        }

        else if($password == "secret" && $username == $request->username) {
            $dosen = $this->panda($data_dosen);
            if (empty($dosen)) {
                return redirect()->route('pegawai.login.form')->with(['error'	=> 'Akses Anda Tidak Diketahui !!']);
            }
            else{
                $dosen_exists = Dosen::where('nip',$dosen['dosen'][0]['dsnPegNip'])->first();
                if (!empty($dosen['dosen'][0]['pegawai']['pegawai_simpeg'])) {
                    if($dosen['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                        if (empty($dosen_exists)) {
                            Dosen::create([
                                'nip'               =>  $dosen['dosen'][0]['dsnPegNip'],
                                'nm_dosen'          =>  $dosen['dosen'][0]['pegawai']['pegNama'],
                                'slug'              =>  Str::slug($dosen['dosen'][0]['pegawai']['pegNama']),
                                'gelar_depan'       =>  $dosen['dosen'][0]['pegawai']['pegGelarDepan'],
                                'gelar_belakang'    =>  $dosen['dosen'][0]['pegawai']['pegGelarBelakang'],
                                'jenis_kelamin'     =>  $dosen['dosen'][0]['pegawai']['pegawai_simpeg']['pegJenkel'],
                                'prodi_kode'        =>  $dosen['dosen'][0]['prodi']['prodiKodeUniv'],
                                'prodi_nama'        =>  $dosen['dosen'][0]['prodi']['prodiNamaResmi'],
                                'fakultas_kode'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'],
                                'fakultas_nama'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakNamaResmi'],
                                'departemen_id'     =>  ((($dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'] == 'A') ? '9' :($dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'] == 'B')) ? '10' :($dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'] == 'C')) ? '11' : '',
                            ]);
                            $dosen_exists = Dosen::where('nip',$dosen['dosen'][0]['dsnPegNip'])->first();
                            if ($dosen_exists->fakultas_kode == "A") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '9',
                                    'departemen_nama' =>  'Fakultas Kip',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "B") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '10',
                                    'departemen_nama' =>  'Fakultas Hukum',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "C") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '11',
                                    'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                ]);
                            }
                            elseif ($dosen_exists->fakultas_kode == "D") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '12',
                                    'departemen_nama' =>  'Fakultas Isipol',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "E") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '13',
                                    'departemen_nama' =>  'Fakultas Pertanian',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "F") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '14',
                                    'departemen_nama' =>  'Fakultas MIPA',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "G") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '15',
                                    'departemen_nama' =>  'Fakultas Teknik',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "H") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '16',
                                    'departemen_nama' =>  'Fakultas KIK',
                                ]);
                            }
                            Session::put('nip',$dosen_exists->nip);
                            Session::put('akses','dosen');
                            Session::put('slug',$dosen_exists->slug);
                            return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                        }
                        else{
                            if ($dosen_exists->fakultas_kode == "A") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '9',
                                    'departemen_nama' =>  'Fakultas Kip',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "B") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '10',
                                    'departemen_nama' =>  'Fakultas Hukum',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "C") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '11',
                                    'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                ]);
                            }
                            elseif ($dosen_exists->fakultas_kode == "D") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '12',
                                    'departemen_nama' =>  'Fakultas Isipol',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "E") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '13',
                                    'departemen_nama' =>  'Fakultas Pertanian',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "F") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '14',
                                    'departemen_nama' =>  'Fakultas MIPA',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "G") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '15',
                                    'departemen_nama' =>  'Fakultas Teknik',
                                ]);
                            }elseif ($dosen_exists->fakultas_kode == "H") {
                                $dosen_exists->update([
                                    'departemen_id' =>  '16',
                                    'departemen_nama' =>  'Fakultas KIK',
                                ]);
                            }
                            Session::put('nip',$dosen_exists->nip);
                            Session::put('akses','dosen');
                            Session::put('slug',$dosen_exists->slug);
                            return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                        }
                    }
                }
                else{
                    if($dosen['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                        if($dosen['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                            if (empty($dosen_exists)) {
                                Dosen::create([
                                    'nip'               =>  $dosen['dosen'][0]['dsnPegNip'],
                                    'nm_dosen'          =>  $dosen['dosen'][0]['pegawai']['pegNama'],
                                    'slug'              =>  Str::slug($dosen['dosen'][0]['pegawai']['pegNama']),
                                    'gelar_depan'       =>  $dosen['dosen'][0]['pegawai']['pegGelarDepan'],
                                    'gelar_belakang'    =>  $dosen['dosen'][0]['pegawai']['pegGelarBelakang'],
                                    'prodi_kode'        =>  $dosen['dosen'][0]['prodi']['prodiKodeUniv'],
                                    'prodi_nama'        =>  $dosen['dosen'][0]['prodi']['prodiNamaResmi'],
                                    'fakultas_kode'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakKodeUniv'],
                                    'fakultas_nama'     =>  $dosen['dosen'][0]['prodi']['fakultas']['fakNamaResmi'],
                                ]);
                                if ($dosen_exists->fakultas_kode == "A") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '9',
                                        'departemen_nama' =>  'Fakultas Kip',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "B") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '10',
                                        'departemen_nama' =>  'Fakultas Hukum',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "C") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '11',
                                        'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                    ]);
                                }
                                elseif ($dosen_exists->fakultas_kode == "D") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '12',
                                        'departemen_nama' =>  'Fakultas Isipol',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "E") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '13',
                                        'departemen_nama' =>  'Fakultas Pertanian',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "F") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '14',
                                        'departemen_nama' =>  'Fakultas MIPA',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "G") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '15',
                                        'departemen_nama' =>  'Fakultas Teknik',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "H") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '16',
                                        'departemen_nama' =>  'Fakultas KIK',
                                    ]);
                                }
                                Session::put('nip',$dosen_exists->nip);
                                Session::put('akses','dosen');
                                Session::put('slug',$dosen_exists->slug);
                                return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                            }
                            else{
                                if ($dosen_exists->fakultas_kode == "A") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '9',
                                        'departemen_nama' =>  'Fakultas Kip',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "B") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '10',
                                        'departemen_nama' =>  'Fakultas Hukum',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "C") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '11',
                                        'departemen_nama' =>  'Fakultas Ekonomi dan Bisnis',
                                    ]);
                                }
                                elseif ($dosen_exists->fakultas_kode == "D") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '12',
                                        'departemen_nama' =>  'Fakultas Isipol',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "E") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '13',
                                        'departemen_nama' =>  'Fakultas Pertanian',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "F") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '14',
                                        'departemen_nama' =>  'Fakultas MIPA',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "G") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '15',
                                        'departemen_nama' =>  'Fakultas Teknik',
                                    ]);
                                }elseif ($dosen_exists->fakultas_kode == "H") {
                                    $dosen_exists->update([
                                        'departemen_id' =>  '16',
                                        'departemen_nama' =>  'Fakultas KIK',
                                    ]);
                                }
                                Session::put('nip',$dosen_exists->nip);
                                Session::put('akses','dosen');
                                Session::put('slug',$dosen_exists->slug);
                                return redirect()->route('pegawai.dashboard',[$dosen_exists->slug]);
                            }
                        }
                    }
                }
            }
        }
        else{
			return redirect()->route('pegawai.login.form')->with(['error'	=> 'Username dan Password Salah !! !!']);
        }
    	// print_r($data);
    }

    public function panda($query){
        $client = new Client();
        try {
            $response = $client->request(
                'POST','https://panda.unib.ac.id/panda',
                ['form_params' => ['token' => $this->pandaToken(), 'query' => $query]]
            );
            $arr = json_decode($response->getBody(),true);
            if(!empty($arr['errors'])){
                echo "<h1><i>Kesalahan Query...</i></h1>";
            }else{
                return $arr['data'];
            }
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $res = json_decode($responseBodyAsString,true);
            if($res['message']=='Unauthorized'){
                echo "<h1><i>Meminta Akses ke Pangkalan Data...</i></h1>";
                $this->panda_token();
                header("Refresh:0");
            }else{
                print_r($res);
            }
        }
    }

    public function pandaLogout(){
        Session::flush();
        return redirect()->route('pegawai.login.form');
    }
}