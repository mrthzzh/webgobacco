<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kecamatan;
use App\Models\Edukasi;
use App\Models\Pemerintah;
use App\Models\PetaniTembakau;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function melihatDataAkun(Request $request)
    {
        $id_admin = $request->session()->get('id', null);
        if (isset($id_admin)) {
            $admin = Admin::find($id_admin);
            return view('admin.akun.akun', [
                'title' => 'Admin | Profil',
                'admin' => $admin
            ]);
        } else {
            return redirect('/login')->with('failed', 'Silahkan login terlebih dahulu!');
        }
    }
    public function mengubahDataAkun(Request $request)
    {
        $id_admin = $request->session()->get('id', null);
        if (isset($id_admin)) {
            $admin = Admin::find($id_admin);
            return view('admin.akun.ubahAkun', [
                'title' => 'Admin | Ubah Profil',
                'admin' => $admin //put id in hidden input on view
            ]);
        } else {
            return redirect('/login')->with('failed', 'Silahkan login terlebih dahulu!');
        }
    }
    public function postMengubahDataAkun(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $id_admin = $request->session()->get('id', null);
        if (isset($id_admin)) {
            $row_affected = Admin::query()->where('id_admin', $id_admin)->update([
                'username' => $validated['username'],
                'password' => $validated['password']
            ]);
            if ($row_affected) {
                return redirect('/admin/akun')->with('success', 'Data akun berhasil diperbarui!');
            } else {
                return redirect('/admin/ubah')->withErrors(['db' => 'Data akun tidak berubah!']);
            }
        }
        return redirect('/admin/ubah')->with('failed', 'Data akun gagal diperbarui!');
    }
    public function melihatEdukasi()
    {
        return view('admin.edukasi.edukasi', [
            'title' => 'Edukasi Admin'
        ]);
    }
    public function melihatDataUser()
    {
        return view('admin.user.user', [
            'title' => 'Data User'
        ]);
    }
    public function melihatDataPemerintah()
    {
        $pemerintahs = Pemerintah::with('Kecamatan')->get();
        return view('admin.user.pemerintah', [
            'pemerintahs' => $pemerintahs,
            'title' => 'Data Pemerintah'
        ]);
    }
    public function melihatDataPetani()
    {
        $petanis = PetaniTembakau::with('jenisKelamin')->get();
        $petanis = PetaniTembakau::with('Kecamatan')->get();
        return view('admin.user.petani', [
            'petanis' => $petanis,
            'title' => 'Data Petani'
        ]);
    }
    public function melihatTanamTembakau()
    {
        $edukasi = Edukasi::where('id_topik', 1)->orderBy('id_edukasi', 'desc')->get();
        return view('admin.edukasi.tanamtembakau', [
            'edukasis' => $edukasi,
            'title' => 'Data Edukasi'
        ]);
    }
    public function melihatPageTanam($id_edukasi)
    {
        $edukasi = Edukasi::find($id_edukasi);
        return view('admin.edukasi.pagetanam', ['edukasi' => $edukasi]);
    }
    public function melihatEksporTembakau()
    {
        // Mengambil data dari tabel Edukasi yang memiliki id_topik = 2
        $edukasi = Edukasi::where('id_topik', 2)->orderBy('id_edukasi', 'desc')->get();

        return view('admin.edukasi.eksportembakau', [
            'edukasis' => $edukasi,
            'title' => 'Data Edukasi'
        ]);
    }

    public function membuatEdukasi(Request $request)
    {
        $id_admin = $request->session()->get('id', null);
        $id_topik = $request->session()->get('id', null);
        $admin = Admin::find($id_admin);
        $edukasi = Edukasi::find($id_topik);
        $edukasi = Edukasi::where('id_topik', 1)->get();

        return view('admin.edukasi.buatedukasi', [
            'edukasis' => $edukasi,
            'admin' => $admin,
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

            return redirect('/admin/tanamtembakau')->with('success', 'Edukasi berhasil ditambahkan!');
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
        return view('admin.edukasi.ubahedukasi', ['edukasi' => $edukasi]);
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

            return redirect('/admin/tanamtembakau')->with('success', 'Edukasi berhasil diperbarui!');
        } catch (\Exception $e) {
            // Tangani kesalahan
            Log::error('Error updating edukasi: ' . $e->getMessage());
            $error = 'Error updating edukasi: ' . $e->getMessage();
            return redirect()->back()->withInput()->withErrors(['error' => $error]);
        }
    }
}
