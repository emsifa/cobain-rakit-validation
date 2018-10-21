<?php

// Pastikan user mengakses file ini melalui method POST
($_SERVER['REQUEST_METHOD'] == 'POST') or die("Access denied!");

// Import class yang akan digunakan
use Rakit\Validation\Validator;

// Include autoloader agar class 'Rakit\Validation\Validator' 
// diatas dapat digunakan.
require("vendor/autoload.php");

// Inisiasi validator
$validator = new Validator();

// Buat variable berisi semua inputan
// (gabungan dari $_POST dan $_FILES)
$inputs = $_POST + $_FILES;

// Tentukan rulesnya
$rules = [
    'nama' => 'required',
    'email' => 'required|email', 
    'password' => 'required|min:6',
    'konfirmasi_password' => 'required|same:password',
    'foto' => 'required|uploaded_file:0,2MB,jpg,png',
];

// Persiapkan validasi inputan
$validation = $validator->make($inputs, $rules);

// Set custom error message (karena defaultnya bahasa inggris)
$validation->setMessages([
    'required' => ':attribute harus diisi',
    'email' => ':attribute harus berisi email yang valid',
    'min' => ':attribute minimal berisi :min karakter',
    'konfirmasi_password:same' => 'Konfirmasi password harus sama dengan password',
    'foto:uploaded_file' => 'Foto harus berupa jpg atau png dengan maksimal ukuran 2MB',
]);

// Validasi inputan
$validation->validate();

// Jika terdapat yang invalid (fails)
if ($validation->fails()) {
    // Ambil pesan error
    $errors = $validation->errors()->toArray();

    // Simpan error kedalam HTTP query
    $http_query = http_build_query(['errors' => $errors]);

    // Redirect kembali ke index.php dengan mengirim pesan error
    header("Location: index.php?{$http_query}");
    exit;
}

// Jika validasi sukses (data valid)
// Redirect ke hasil.php dengan mengirimkan data inputan
$http_query = http_build_query(['data' => $inputs]);
header("Location: hasil.php?{$http_query}");
