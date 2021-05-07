<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validation\AkunRules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		AkunRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $login = [
		'username' => 'required',
		'password' => 'required|validateAkun[username, password]',
	];

	// error message manual
	public $login_errors = [
		'username' => [
			'required' => 'Anda wajib mengisi bagian username',
		],

		'password' => [
			'required' => 'Anda wajib mengisi bagian password',
			'validateAkun' => 'Username dan password Anda tidak sesuai'
		]
	];

	public $insertAkun = [
		// is_unique[nama_tabel.nama_kolom]
		'username' => 'required|max_length[15]|is_unique[tb_akun.username]|alpha_numeric',
		'password' => 'required|max_length[50]',
	];

	public $insertAkun_errors = [
		'username' => [
			'required' => 'Anda wajib mengisi bagian username',
			'max_length' => 'Jumlah maksimal karakter pada username adalah 15 karakter',
			'is_unique' => 'Username telah terdaftar pada sistem',
			'alpha_numeric' => 'Username hanya dapat diisi menggunakan huruf dan angka'
		],

		'password' => [
			'required' => 'Anda wajib mengisi bagian password',
			'max_length' => 'Jumlah maksimal karakter pada password adalah 50 karakter',
		]
	];

	public $updateAkun = [
		'password' => 'required|max_length[50]'
	];

	public $updateAkun_errors = [
		'password' => [
			'required' => 'Anda wajib mengisi bagian password',
			'max_length' => 'Jumlah maksimal karakter pada password adalah 50 karakter',
		]
	];

	public $insertMahasiswa = [
		'nama_mhs' => 'required|max_length[250]',
		'tempat_lahir' => 'required|max_length[100]',
		'tgl_lahir' => 'required|valid_date',
		'alamat' => 'required|max_length[250]',
		'nim' => 'required|exact_length[7]|is_unique[tb_mahasiswa.nim]',
		'semester' => 'required|numeric',
		'nama_ibu' => 'required|max_length[250]',
		'penghasilan_ortu' => 'required|numeric',
		'gol_darah' => 'required|alpha',
		'jml_saudara' => 'required|numeric',
		'ipk' => 'required|decimal',
	];

	public $insertMahasiswa_errors = [
		'nama_mhs' => [
			'required' => 'Anda wajib mengisi nama lengkap',
			'max_length' => 'Jumlah maksimal karakter pada nama lengkap adalah 250 karakter',
		],

		'tempat_lahir' => [
			'required' => 'Anda wajib mengisi tempat lahir',
			'max_length' => 'Jumlah maksimal karakter pada tempat lahir adalah 100 karakter',
		],

		'tgl_lahir' => [
			'required' => 'Anda wajib mengisi tanggal lahir',
			'valid_date' => 'Masukkan format tanggal yang benar pada tanggal lahir',
		],

		'alamat' => [
			'required' => 'Anda wajib mengisi alamat',
			'max_length' => 'Jumlah maksimal karakter pada alamat adalah 250 karakter',
		],

		'nim' => [
			'required' => 'Anda wajib mengisi NIM',
			'max_length' => 'Jumlah karakter pada nama NIM adalah tepat 7 karakter',
			'is_unique' => 'NIM telah terdaftar pada sistem'
		],

		'semester' => [
			'required' => 'Anda wajib mengisi semester',
			'numeric' => 'Semester wajib diisi dengan angka saja'
		],

		'nama_ibu' => [
			'required' => 'Anda wajib mengisi nama ibu',
			'max_length' => 'Jumlah maksimal karakter pada nama ibu adalah 250 karakter',
		],

		'penghasilan_ortu' => [
			'required' => 'Anda wajib mengisi penghasilan orangtua',
			'numeric' => 'Penghasilan orangtua wajib diisi dengan angka saja',
		],

		'gol_darah' => [
			'required' => 'Anda wajib mengisi golongan darah',
			'alpha' => 'Golongan darah wajib diisi dengan huruf saja',
		],

		'jml_saudara' => [
			'required' => 'Anda wajib mengisi jumlah saudara',
			'numeric' => 'Jumlah saudara wajib diisi dengan angka saja',
		],

		'ipk' => [
			'required' => 'Anda wajib mengisi IPK',
			'decimal' => 'IPK wajib diisi dengan angka desimal saja',
		],
	];

	public $updateMahasiswa = [
		'nama_mhs' => 'required|max_length[250]',
		'tempat_lahir' => 'required|max_length[100]',
		'tgl_lahir' => 'required|valid_date',
		'alamat' => 'required|max_length[250]',
		'semester' => 'required|numeric',
		'nama_ibu' => 'required|max_length[250]',
		'penghasilan_ortu' => 'required|numeric',
		'gol_darah' => 'required|alpha',
		'jml_saudara' => 'required|numeric',
		'ipk' => 'required|decimal',
	];

	public $updateMahasiswa_errors = [
		'nama_mhs' => [
			'required' => 'Anda wajib mengisi nama lengkap',
			'max_length' => 'Jumlah maksimal karakter pada nama lengkap adalah 250 karakter',
		],

		'tempat_lahir' => [
			'required' => 'Anda wajib mengisi tempat lahir',
			'max_length' => 'Jumlah maksimal karakter pada tempat lahir adalah 100 karakter',
		],

		'tgl_lahir' => [
			'required' => 'Anda wajib mengisi tanggal lahir',
			'valid_date' => 'Masukkan format tanggal yang benar pada tanggal lahir',
		],

		'alamat' => [
			'required' => 'Anda wajib mengisi alamat',
			'max_length' => 'Jumlah maksimal karakter pada alamat adalah 250 karakter',
		],

		'semester' => [
			'required' => 'Anda wajib mengisi semester',
			'numeric' => 'Semester wajib diisi dengan angka saja'
		],

		'nama_ibu' => [
			'required' => 'Anda wajib mengisi nama ibu',
			'max_length' => 'Jumlah maksimal karakter pada nama ibu adalah 250 karakter',
		],

		'penghasilan_ortu' => [
			'required' => 'Anda wajib mengisi penghasilan orangtua',
			'numeric' => 'Penghasilan orangtua wajib diisi dengan angka saja',
		],

		'gol_darah' => [
			'required' => 'Anda wajib mengisi golongan darah',
			'alpha' => 'Golongan darah wajib diisi dengan huruf saja',
		],

		'jml_saudara' => [
			'required' => 'Anda wajib mengisi jumlah saudara',
			'numeric' => 'Jumlah saudara wajib diisi dengan angka saja',
		],

		'ipk' => [
			'required' => 'Anda wajib mengisi IPK',
			'decimal' => 'IPK wajib diisi dengan angka desimal saja',
		],
	];

	public $insertBeasiswa = [
		'nama_beasiswa' => 'required|max_length[250]',
		'nama_penyelenggara' => 'required|max_length[250]',
		'tahun' => 'required',
		'kuota' => 'required|numeric',
	];

	public $insertBeasiswa_errors = [
		'nama_beasiswa' => [
			'required' => 'Anda wajib mengisi bagian nama beasiswa',
			'max_length' => 'Jumlah maksimal karakter pada nama beasiswa adalah 250 karakter',
		],

		'nama_penyelenggara' => [
			'required' => 'Anda wajib mengisi bagian nama penyelenggara',
			'max_length' => 'Jumlah maksimal karakter pada nama penyelenggara adalah 250 karakter',
		],

		'tahun' => [
			'required' => 'Anda wajib mengisi bagian tahun',
		],

		'kuota' => [
			'required' => 'Anda wajib mengisi bagian kuota',
		],
	];

	public $insertKriteria = [
		'nama_kriteria' => 'required|max_length[50]',
		'sifat' => 'required',
		'bobot' => 'required|decimal',
	];

	public $insertKriteria_errors = [
		'nama_kriteria' => [
			'required' => 'Anda wajib mengisi bagian nama kriteria',
			'max_length' => 'Jumlah maksimal karakter pada nama kriteria adalah 50 karakter',
		],

		'sifat' => [
			'required' => 'Anda wajib mengisi bagian sifat',
		],

		'bobot' => [
			'required' => 'Anda wajib mengisi bagian bobot',
			'decimal' => 'Kriteria wajib diisi dengan angka desimal saja',
		],
	];

	public $insertBobot = [
		'keterangan' => 'required|max_length[50]',
		'value' => 'required|decimal',
	];
	
	public $insertBobot_errors = [
		'keterangan' => [
			'required' => 'Anda wajib mengisi bagian keterangan',
			'max_length' => 'Jumlah maksimal karakter pada keterangan adalah 50 karakter',
		],

		'value' => [
			'required' => 'Anda wajib mengisi bagian value',
			'decimal' => 'Bobot wajib diisi dengan angka desimal saja',
		],
	];
}