<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];
	//--------------------------------------------------------------------
	// Rules PEGAWAI
	//--------------------------------------------------------------------
	public $login = [
		'email'     => 'required|trim',
		'password' => 'required|trim',

	];
	public $login_errors  = [
		'email' => [
			'required' => 'Email Masih Kosong',
		],
		'password' => [
			'required' => 'Password Masih Kosong'
		]
	];

	//--------------------------------------------------------------------
	// Rules PEGAWAI
	//--------------------------------------------------------------------
	public $textpns = [
		'nip'     => 'required|numeric|exact_length[18]',
		'nama' => 'required',
		'tgl_lahir' => 'required|valid_date',
		'alamat' => 'required',
		'tempat_bekerja' => 'required',
		'id_pangkat' => 'required',
		'id_jabatan' => 'required',
		'pend_terakhir' => 'required',
		'tgl_pensiun' => 'required|valid_date'
	];
	public $textpns_errors  = [
		'nama' => [
			'required' => 'Nama Masih Kosong'
		],
		'nip' => [
			'required' => 'NIP Masih Kosong',
			'exact_length'    => 'NIP Harus 18 Karakter',
			'numeric' => 'NIP Harus Berupa Angka',
		],
		'tgl_lahir' => [
			'required' => 'Tanggal Lahir Masih Kosong', 'valid_date' => 'Masukan Tanggal Lahir Dengan Benar'
		],
		'alamat' => [
			'required' => 'Alamat Masih Kosong'
		],
		'tempat_bekerja' => [
			'required' => 'Tempat Bekerja Masih Kosong'
		],
		'id_pangkat' => [
			'required' => 'Pangkat Masih Kosong'
		],
		'id_jabatan' => [
			'required' => 'Jabatan Masih Kosong'
		],
		'pend_terakhir' => [
			'required' => 'Pendidikan Terkhir Masih Kosong'
		],
		'tgl_pensiun' => [
			'required' => 'Tanggal Pensiun Masih Kosong', 'valid_date' => 'Bukan Format Tanggal Pensiun'
		]
	];

	public $textkontrak = [
		'nama' => 'required',
		'tgl_lahir' => 'required|valid_date',
		'alamat' => 'required',
		'pend_terakhir' => 'required',
		'tempat_bekerja' => 'required'
	];
	public $textkontrak_errors = [
		'nama' => [
			'required' => 'Nama Masih Kosong'
		],
		'tgl_lahir' => [
			'required' => 'Tanggal Lahir Masih Kosong', 'valid_date' => 'Masukan Tanggal Lahir Dengan Benar'
		],
		'alamat' => [
			'required' => 'Alamat Masih Kosong'
		],
		'pend_terakhir' => [
			'required' => 'Pendidikan Terkhir Masih Kosong'
		],
		'tempat_bekerja' => [
			'required' => 'Tempat Berkerja Masih Kosong'
		]
	];

	//--------------------------------------------------------------------
	// Rules USER
	//--------------------------------------------------------------------
	public $userfoto = [
		'foto' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpg,image/jpeg]'
	];
	public $userfoto_errors = [
		'foto' => [
			'uploaded' => 'Foto Tidak Tersimpan',
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Didukung[jpg/jpeg]'
		]
	];
	public $usertext = [
		'email' => 'required|valid_email',
		'password' => 'required|min_length[8]',
		'repass' => 'required|matches[password]',
		'role' => 'required',
	];
	public $usertext_errors = [
		'email' => [
			'required' => 'Email Masih Kosong', 'valid_email' => 'Masukan Email Dengan Benar'
		],
		'password' => [
			'required' => 'Password Masih Kosong', 'min_length' => 'Password Minimal 8 Karakter'
		],
		'repass' => [
			'required' => 'Verifikasi Password Masih Kosong', 'matches' => 'Password Berbeda'
		],
		'role' => [
			'required' => 'Role Pegawai Masih Kosong'
		]
	];

	public $usertextEdit = [
		'email' => 'required|valid_email',
		'status' => 'required'
	];
	public $usertextEdit_errors = [
		'email' => [
			'required' => 'Email Masih Kosong', 'valid_email' => 'Masukan Email Dengan Benar'
		],
		'status' => [
			'required' => 'Status Pegawai Masih Kosong'
		]
	];

	//--------------------------------------------------------------------
	// Rules MUTASI
	//--------------------------------------------------------------------
	public $mutasitext = [
		'id_mutasi' => 'required',
		'id_pegawai' => 'required',
		'unit_tujuan' => 'required',
		'status_mutasi' => 'required'
	];
	public $mutasitext_errors = [
		'id_mutasi' => [
			'required' => 'Masukan NO SK Dengan Benar'
		],
		'id_pegawai' => [
			'required' => 'NIP atau Nama Pegawai Tidak Ditemukan'
		],
		'unit_tujuan' => [
			'required' => 'Unit Tujuan Masih Kosong'
		],
		'status_mutasi' => [
			'required' => 'Status Mutasi Masih Kosong'
		]
	];

	public $skmutasi = [
		'no_sk' => 'required|is_unique[tb_mutasi.no_sk]',
		'tgl_mutasi' => 'required',
	];
	public $skmutasi_errors = [
		'no_sk' => [
			'required' => 'NO SK Mutasi Masih Kosong',
			'is_unique' => 'NO SK Mutasi Terdapat pada Sistem'
		],
		'tgl_mutasi' => [
			'required' => 'Tanggal Mutasi Masih Kosong'
		]
	];

	public $skmutasiedit = [
		'no_sk' => 'required',
		'tgl_mutasi' => 'required',
	];
	public $skmutasiedit_errors = [
		'no_sk' => [
			'required' => 'NO SK Mutasi Masih Kosong'
		],
		'tgl_mutasi' => [
			'required' => 'Tanggal Mutasi Masih Kosong'
		]
	];

	//--------------------------------------------------------------------
	// Rules SKP
	//--------------------------------------------------------------------
	public $skptext = [
		'id_pegawai' => 'required',
		'nama_atasan_pejpen' => 'required',
		'nip_atasan_pejpen' => 'required|numeric|exact_length[18]',
		'status_atasan_pejpen' => 'required',
		'nama_pejpen' => 'required',
		'nip_pejpen' => 'required',
		'status_pejpen' => 'required',
		'tahun_skp' => 'required|exact_length[4]',
		'nilai_skp' => 'required',
		'nilai_pelayanan' => 'required',
		'nilai_integritas' => 'required',
		'nilai_komitmen' => 'required',
		'nilai_disiplin' => 'required',
		'nilai_kerjasama' => 'required',
		'nilai_kepemimpinan' => 'required',
	];
	public $skptext_errors = [
		'id_pegawai' => ['required' => 'NIP atau Nama Pegawai Tidak Ditemukan'],
		'nama_atasan_pejpen' => ['required' => 'Nama Atasan Pej.Pen Kosong'],
		'nip_atasan_pejpen' => [
			'required' => 'NIP Atasan Pej.Pen Kosong',
			'numeric' => 'NIP Atasan Pej.Pen Harus Berupa Angka',
			'exact_length' => 'NIP Atasan Pej.Pen Harus 18 Karakter'
		],
		'status_atasan_pejpen' => ['required' => 'Status Atasan Pej.Pen Kosong'],
		'nama_pejpen' => ['required' => 'Nama Pej.Pen Kosong'],
		'nip_pejpen' => [
			'required' => 'NIP Pej.Pen Kosong',
			'numeric' => 'NIP Pej.Pen Harus Berupa Angka',
			'exact_length' => 'NIP Pej.Pen Harus 18 Karakter'
		],
		'status_pejpen' => ['required' => 'Status Pej.Pen Kosong'],
		'tahun_skp' => [
			'required' => 'Tahun SKP Kosong',
			'exact_length' => 'Masukan Tagun SKP dengan Benar'
		],
		'nilai_skp' => ['required' => 'Nilai SKP Kosong'],
		'nilai_pelayanan' => ['required' => 'Nilai Pelayanan Kosong'],
		'nilai_integritas' => ['required' => 'Nilai Integritas Kosong'],
		'nilai_komitmen' => ['required' => 'Nilai Komitmen Kosong'],
		'nilai_disiplin' => ['required' => 'Nilai Disiplin Kosong'],
		'nilai_kerjasama' => ['required' => 'Nilai Kerjasama Kosong'],
		'nilai_kepemimpinan' => ['required' => 'Nilai Kepemimpinan Kosong']
	];

	//--------------------------------------------------------------------
	// Rules PESAN
	//--------------------------------------------------------------------
	public $pesan = [
		'id_pegawai' => 'is_unique[tb_pesan.id_pegawai]',
	];
}