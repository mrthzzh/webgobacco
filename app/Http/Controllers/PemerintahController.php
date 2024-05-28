<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Pemerintah;
use App\Models\PetaniTembakau;
use App\Models\SertifikasiProduk;
use App\Models\Edukasi;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class PemerintahController extends Controller
{
    public function melihatDataAkun(Request $request)
    {
        $id_pemerintah = $request->session()->get('id',null);
        if(isset($id_pemerintah)) {
            $pemerintah = Pemerintah::find($id_pemerintah);
            $kecamatan = $pemerintah->kecamatan;
            return view('pemerintah.akun.akun', [
                'title' => 'Pemerintah | Profil',
                'pemerintah' => $pemerintah,
                'kecamatan' => $kecamatan
            ]);
        } else {
            return redirect('/login')->with('failed','Silahkan login terlebih dahulu!');
        }
    }
    public function mengubahDataAkun(Request $request)
    {
        $id_pemerintah = $request->session()->get('id',null);
        if(isset($id_pemerintah)) {
            $pemerintah = Pemerintah::find($id_pemerintah);
            $kecamatan = $pemerintah->kecamatan;
            return view('pemerintah.akun.ubahAkun', [
                'title' => 'Pemerintah | Ubah Profil',
                'pemerintah' => $pemerintah,
                'kecamatan' => $kecamatan
            ]);
        } else {
            return redirect('/')->with('failed','Silahkan login terlebih dahulu!');
        }
    }
    public function postMengubahDataAkun(Request $request)
    {
        $validated = $request->validate([
            'username_pemerintah' => 'required',
            'pw_pemerintah' => 'required',
            'email_pemerintah' => 'required',
            'telp_pemerintah' => 'required',
            'kecamatan' => 'required',
        ]);
        $id_pemerintah = $request->session()->get('id', null);
        if(isset($id_pemerintah)) {
            $row_affected = Pemerintah::query()->where('id_pemerintah',$id_pemerintah)->update([
                'username_pemerintah' => $validated['username_pemerintah'],
                'pw_pemerintah' => $validated['pw_pemerintah'],
                'email_pemerintah' => $validated['email_pemerintah'],
                'telp_pemerintah' => $validated['telp_pemerintah'],
            ]);
            if($row_affected) {
                return redirect('/pemerintah/akun')->with('success','Data akun berhasil diperbarui!');
            } else {
                return redirect('/pemerintah/ubah')->withErrors(['db' => 'Data akun tidak berubah!']);
            }
        }
        return redirect('/')->with('failed','Data akun gagal diperbarui!');
    }
    public function melihatPengajuanSertifikasi(Request $request)
    {
        $id_pemerintah = $request->session()->get('id', null);
    
        if ($id_pemerintah) {
            $sertifikasis = SertifikasiProduk::with('StatusUji')
                ->select('sertifikasi_produks.*', 'jenis_pengujians.jenis_pengujian', 'jenis_tembakaus.*', 'petani_tembakaus.nama_petani')
                ->join('jenis_tembakaus', 'jenis_tembakaus.id_jenis_tembakau', '=', 'sertifikasi_produks.id_jenis_tembakau')
                ->join('jenis_pengujians', 'jenis_pengujians.id_pengujian', '=', 'sertifikasi_produks.id_pengujian')
                ->join('petani_tembakaus', 'petani_tembakaus.id_petani', '=', 'sertifikasi_produks.id_petani')
                ->get();
    
            return view('pemerintah.sertifikasi.table', [
                'title' => 'Pemerintah | Sertifikasi',
                'sertifikasis' => $sertifikasis
            ]);
        } else {
            return redirect('/')->with('failed', 'Silahkan login terlebih dahulu!');
        }
    }
    
    public function membuatPengajuanSertifikasi($id_sertifikasi)
    {
        $sertifikasi = SertifikasiProduk::query()->select('sertifikasi_produks.*','jenis_pengujians.*','jenis_tembakaus.*','petani_tembakaus.*', 'kecamatans.*')
        ->where('sertifikasi_produks.id_sertifikasi',$id_sertifikasi)
        ->join('jenis_tembakaus','jenis_tembakaus.id_jenis_tembakau','=','sertifikasi_produks.id_jenis_tembakau')
        ->join('jenis_pengujians','jenis_pengujians.id_pengujian','=','sertifikasi_produks.id_pengujian')
        ->join('petani_tembakaus','petani_tembakaus.id_petani','=','sertifikasi_produks.id_petani')
        ->join('kecamatans','kecamatans.id_kecamatan','petani_tembakaus.id_kecamatan')
        ->first();
        if(isset($sertifikasi)) {
            return view('pemerintah.sertifikasi.form', [
                'title' => 'Pemerintah | Pengajuan Sertifikasi',
                'sertifikasi' => $sertifikasi
            ]);
        } else {
            return redirect('/')->with('failed','Silahkan login terlebih dahulu!');
        }
    }
    public function postMembuatPengajuanSertifikasi(Request $request)
    {
        $status_fix = $request->input('id_status');
        $id_sertifikasi = $request->input('id_sertifikasi');
        try {
            SertifikasiProduk::query()->where('id_sertifikasi',$id_sertifikasi)->update(['id_status' => intval($status_fix)]);
            if($status_fix == '1') {
                return redirect('/pemerintah/sertifikasi/')->with('accepted', 'Data akun berhasil diperbarui!');
            } else if($status_fix == '2') {
                return redirect('/pemerintah/sertifikasi/')->with('declined', 'Data akun berhasil diperbarui!');
            }
        } catch (QueryException $e) {
            return back()->with('failed','Data akun gagal diperbarui!');
        }
    }
    public function mengunggahPengajuanSertifikasi($id_sertifikasi)
    {
        if(isset($id_sertifikasi)) {
            return view('pemerintah.sertifikasi.unggah', [
                'title' => 'Pemerintah | Mengunggah Hasil',
                'id_sertifikasi' => $id_sertifikasi
            ]);
        } else {
            return redirect('/')->with('failed','Silahkan login terlebih dahulu!');
        }
    }
    public function postMengunggahPengajuanSertifikasi(Request $request)
{
    // Validasi request
    $validated = $request->validate([
        'id_sertifikasi' => 'required',
        'hasil_pengujian' => 'required|file|mimes:pdf,doc,docx', // Tambahkan validasi tipe file
    ]);

    // Mendapatkan file hasil_pengujian
    $hasil_pengujian = $request->file('hasil_pengujian');
    if (!$hasil_pengujian) {
        return back()->with('failed', 'File hasil pengujian tidak ditemukan!');
    }

    // Mendapatkan nama file asli
    $name = $hasil_pengujian->getClientOriginalName();

    // Menyimpan file dengan public visibility
    try {
        $hasil_pengujian->storePubliclyAs('hasil_pengujians', $name, 'public');
    } catch (\Exception $e) {
        return back()->with('failed', 'Gagal mengunggah file hasil pengujian!')->withErrors(['file' => $e->getMessage()]);
    }

    // Melakukan update pada database
    try {
        SertifikasiProduk::query()->where('id_sertifikasi', $validated['id_sertifikasi'])
            ->update([
                'hasil_pengujian' => $name,
                'id_status' => 4,
            ]);
        return redirect('/pemerintah/sertifikasi')->with('success', 'Anda Telah Menyutujui Konfirmasi Sertifikasi!');
    } catch (QueryException $e) {
        return back()->with('failed', 'Data akun gagal diperbarui!')->withErrors(['db' => $e->getMessage()]);
    }
}

    public function downloadFile(string $folder_name, string $file_name)
    {
        return Storage::disk('public')->download('/' . $folder_name .'/' . $file_name);
    }
    public function melihatDashboard(Request $request)
    {
        $id_pemerintah = $request->session()->get('id', null);
        $pemerintah = Pemerintah::find($id_pemerintah);

        return view('pemerintah.dashboard', [
            'title' => 'Dashboard',
            'pemerintah' => $pemerintah
        ]);
    }

    public function melihatEdukasi(Request $request)
    {
        $id_pemerintah = $request->session()->get('id', null);
        $pemerintah = Pemerintah::find($id_pemerintah);
        return view('pemerintah.edukasi.edukasi', [
            'title' => 'Edukasi Pemerintah',
            'pemerintah' => $pemerintah
        ]);
    }
    public function melihatTanamTembakau(Request $request)
    {
        $id_pemerintah = $request->session()->get('id', null);
        $pemerintah = Pemerintah::find($id_pemerintah);
        $edukasi = Edukasi::where('id_topik', 1)->orderBy('id_edukasi', 'desc')->get();
        return view('pemerintah.edukasi.tanamtembakau', [
            'edukasis' => $edukasi,
            'pemerintah' => $pemerintah,
            'title' => 'Data Edukasi'
        ]);
    }
    public function melihatPageTanam($id_edukasi)
    {
        $edukasi = Edukasi::find($id_edukasi);
        return view('pemerintah.edukasi.pagetanam', ['edukasi' => $edukasi]);
    }
    public function melihatEksporTembakau()
    {
        // Mengambil data dari tabel Edukasi yang memiliki id_topik = 2
        $edukasi = Edukasi::where('id_topik', 2)->orderBy('id_edukasi', 'desc')->get();

        return view('pemerintah.edukasi.eksportembakau', [
            'edukasis' => $edukasi,
            'title' => 'Data Edukasi'
        ]);
    }
    public function membuatEdukasi(Request $request)
    {
        $id_pemerintah = $request->session()->get('id', null);
        $id_topik = $request->input('id_topik', 2); // mengambil id_topik dari query parameter atau menetapkan default menjadi 2
        $admin = Pemerintah::find($id_pemerintah);
        $edukasi = Edukasi::where('id_topik', $id_topik)->get();

        return view('pemerintah.edukasi.buatedukasi', [
            'edukasis' => $edukasi,
            'pemerintah' => $id_pemerintah,
            'id_topik' => $id_topik,
            'title' => 'Data Edukasi'
        ]);
    }

    public function postMembuatEdukasi(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'id_topik' => 'required',
            'judul_edukasi' => 'required',
            'gambar_edukasi' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'teks_edu' => 'required',
            'tanggal' => 'required|date' // Tambahkan validasi untuk tanggal
        ]);

        try {
            Log::info('Validasi berhasil');

            // Simpan data ke database
            $edukasi = new Edukasi();
            $edukasi->id_topik = $request->id_topik;
            $edukasi->judul_edukasi = $request->judul_edukasi;

            // Simpan gambar ke storage
            $gambar = $request->file('gambar_edukasi');
            $gambar_nama = time() . '.' . $gambar->getClientOriginalExtension();

            // Tentukan path penyimpanan gambar
            $tujuanPath = storage_path('../public/storage/gambar_edu');

            // Pastikan path tersebut ada dan dapat diakses
            if (!file_exists($tujuanPath)) {
                mkdir($tujuanPath, 0777, true);
            }

            // Pindahkan file ke path yang ditentukan
            $gambar->move($tujuanPath, $gambar_nama);

            Log::info('Gambar disimpan dengan nama: ' . $gambar_nama);

            $edukasi->gambar_edukasi = $gambar_nama;
            $edukasi->teks_edu = $request->teks_edu;
            $edukasi->tanggal = $request->tanggal; // Simpan tanggal dari request

            // Debugging data sebelum menyimpan
            Log::info('Data edukasi:', [
                'id_topik' => $edukasi->id_topik,
                'judul_edukasi' => $edukasi->judul_edukasi,
                'gambar_edukasi' => $edukasi->gambar_edukasi,
                'teks_edu' => $edukasi->teks_edu,
                'tanggal' => $edukasi->tanggal // Tambahkan logging untuk tanggal
            ]);

            $edukasi->save();
            Log::info('Edukasi berhasil disimpan');

            return redirect('/pemerintah/eksportembakau')->with('success', 'Edukasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Tangani kesalahan
            Log::error('Error saving edukasi: ' . $e->getMessage());
            $error = 'Error saving edukasi: ' . $e->getMessage();
            return redirect()->back()->withInput()->withErrors(['error' => $error]);
        }
    }
    public function mengubahEdukasi($id_edukasi)
    {
        $edukasi = Edukasi::find($id_edukasi);
        return view('pemerintah.edukasi.ubahedukasi', ['edukasi' => $edukasi]);
    }


    public function updateEdukasi(Request $request, $id_edukasi)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'id_topik' => 'required',
            'judul_edukasi' => 'required',
            'gambar_edukasi' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'teks_edu' => 'required'
        ]);

        try {
            Log::info('Validasi berhasil');

            // Cari edukasi yang akan diedit
            $edukasi = Edukasi::findOrFail($id_edukasi);
            $edukasi->id_topik = $request->id_topik;
            $edukasi->judul_edukasi = $request->judul_edukasi;

            // Cek apakah ada gambar baru yang diunggah
            if ($request->hasFile('gambar_edukasi')) {
                $gambar = $request->file('gambar_edukasi');
                $gambar_nama = time() . '.' . $gambar->getClientOriginalExtension();

                // Tentukan path penyimpanan gambar
                $tujuanPath = storage_path('../public/storage/gambar_edu');

                // Pastikan path tersebut ada dan dapat diakses
                if (!file_exists($tujuanPath)) {
                    mkdir($tujuanPath, 0777, true);
                }

                // Pindahkan file ke path yang ditentukan
                $gambar->move($tujuanPath, $gambar_nama);

                Log::info('Gambar disimpan dengan nama: ' . $gambar_nama);

                // Hapus gambar lama jika ada
                if ($edukasi->gambar_edukasi) {
                    $oldImagePath = $tujuanPath . '/' . $edukasi->gambar_edukasi;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Perbarui nama gambar di database
                $edukasi->gambar_edukasi = $gambar_nama;
            }

            $edukasi->teks_edu = $request->teks_edu;

            // Debugging data sebelum menyimpan
            Log::info('Data edukasi yang diperbarui:', [
                'id_topik' => $edukasi->id_topik,
                'judul_edukasi' => $edukasi->judul_edukasi,
                'gambar_edukasi' => $edukasi->gambar_edukasi,
                'teks_edu' => $edukasi->teks_edu
            ]);

            $edukasi->save();
            Log::info('Edukasi berhasil diperbarui');

            return redirect('/pemerintah/eksportembakau')->with('success', 'Edukasi berhasil diperbarui!');
        } catch (\Exception $e) {
            // Tangani kesalahan
            Log::error('Error updating edukasi: ' . $e->getMessage());
            $error = 'Error updating edukasi: ' . $e->getMessage();
            return redirect()->back()->withInput()->withErrors(['error' => $error]);
        }
    }
}
