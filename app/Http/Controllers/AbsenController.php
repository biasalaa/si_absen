<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Jurusan;
use App\Models\Ruangan;
use App\Models\Siswa;
use App\Models\Tahun_Ajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::paginate(10);
        $jurusan = Jurusan::all();
        $ruang = Ruangan::all();
        $data = [];
        return view('absen.absensi', compact('siswa', 'jurusan', 'ruang', 'data'));
    }

    public function siapkanRuangUi()
    {
        $ruangan = Ruangan::all();
        return view('absen.siapkanRuangan', compact('ruangan'));
    }


    public function siapkanRuang(Request $request)
    {
        $request->validate([
            'sesi' => 'required',
            'ruangan' => 'required',
        ]);
        $siswa =  Siswa::where('id_ruangan', $request->ruangan)
            ->where('sesi', $request->sesi)
            ->get();

        if (count($siswa) == 0) {
            return redirect()->back()->with('error', 'Data  Siswa Belum Lengkap');
        }

        $cek = Absen::where('id_siswa', $siswa[0]->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();


        if ($cek != 0) {

            return  redirect('/absen-siswa')->with('error', ' <b>Ruangan Sudah Terdaftar</b> , silahkan langsung filter untuk absensi');
        } elseif ($cek == 0) {
            $month = date('m');
            if ($month <= '06') {
                $tahun = date('Y', strtotime("-1 Year")) . "/" . date('Y');;
                $semester = "genap";
            } else {
                $tahun = date('Y') . "/" . date('Y', strtotime("+1 year"));
                $semester = "ganjil";
            }
            $id_ajaran = Tahun_Ajaran::where('tahun', $tahun)->where('semester', $semester)->first()->id;

            if (!$id_ajaran) return;

            foreach ($siswa as $r) {
                Absen::create([
                    'id_siswa' => $r->id,
                    'status' => "belum hadir",
                    'id_ajaran' => $id_ajaran
                ]);
            }
            return  redirect('/absen-siswa')->with('success', 'Ruangan berhasil di siapkan');
        } else {
            return  redirect('/absen-siswa')->with('error', 'Ruangan Sudah Terdaftar');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filterAbsen(Request $request)
    {
        // dd('s');
        $absen = Absen::all();

        // $data = Absen::whereHas('siswa.ruangan', function ($query) use ($request) {
        //     $query->where('id', $request->ruangan);
        // })
            $data = Siswa::whereHas('siswa',function($query)use($request)
            {
                $query->where('tingkatan',Request()->kelas);
                $query->orWhere('no_kelas',Request()->no_kelas);
            })
            ->whereDate('created_at', $request->waktu)
            ->get();

        $jurusan = Jurusan::all();
        $ruang = Ruangan::all();


        // hadirkan semua
        if (Request()->has('hadirsemua')) {
            try {
                foreach ($data as $d) {


                    $ds = Absen::where('id', $d->id)->update([
                        "status" => 'hadir',
                    ]);
                }
                return redirect()->back()->with('success', 'Berhasil menghadirkan siswa');
            } catch (\Throwable $th) {
                dd('error');
            }
        }

        if (count($data) == 0) {
            return redirect('/siapkan-ruangan')->with('error', 'Ruangan Belum di siapkan');
        } else {
            return view('absen.absensi', compact('jurusan', 'data', 'ruang'));
        }
    }

    public function upStatus(Request $request, $id)
    {
        $request->validate(
            [
                'status' => 'required'
            ],
            [
                'status.required' => 'status wajib di isi'
            ]
        );

        Absen::where('id', $id)->update([
            "status" => $request->status,
        ]);


        return redirect()->back()->with('success', 'status berhasil di edit');
    }
}
