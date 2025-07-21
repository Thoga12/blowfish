<?php

namespace App\Http\Controllers;

use App\Models\FileLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\Blowfish;
use phpseclib3\Crypt\Common\SymmetricKey;
use phpseclib3\Crypt\Engine;


class EncryptedsControllers extends Controller
{
    //
    public function encrypt(Request $request)
    {

        // dd($request);
        $request->validate([
            'file' => 'required|file|max:10240',
            'key'  => 'required|string|min:8'
        ]);

        $file = $request->file('file');
        // $key = $request->input('key');

        $data = file_get_contents($file);
        // $originalSize = strlen($data);

        $iv = random_bytes(8); // Blowfish CBC pakai IV 8 byte
        $key = $request->key;

        // Inisialisasi Blowfish
        // SymmetricKey::setPreferredEngine(\phpseclib3\Crypt\Engine::ENGINE_OPENSSL);
        $blowfish = new Blowfish('cbc');
        $blowfish->setPreferredEngine($blowfish::ENGINE_OPENSSL);
        $blowfish->setKey($key);
        $blowfish->setIV($iv);

         // Enkripsi
         $encrypted = $blowfish->encrypt($data);
        // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("BF-CBC"));
        // $encrypted = openssl_encrypt($data, "BF-CBC", $key, OPENSSL_RAW_DATA, $iv);
        // if ($encrypted === false) {
        //     while ($msg = openssl_error_string()) {
        //         Log::error("OpenSSL Error: $msg");
        //     }
        //     Log::error("Enkripsi gagal, openssl_encrypt() menghasilkan false");
        //     return response("Encryption failed", 500);
        // }

        if (!$encrypted) {
            return response("Encryption failed", 500);
        }

        $output = $iv . $encrypted;


        // $encryptedSize = strlen($output);
        // $output = base64_encode($output);
        // Log::info("Original size: $originalSize bytes");
        // Log::info("Encrypted size: $encryptedSize bytes");

        // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("BF-CBC"));
        // $encrypted = openssl_encrypt($data, "BF-CBC", $key, OPENSSL_RAW_DATA, $iv);
        // $output = $iv . $encrypted;
        FileLogs::create([
            'file_name' => $file->getClientOriginalName(),
            'type' => 'encryption',
            'size' => strlen($data),
        ]);

        return response($output)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="' . $file->getClientOriginalName() . '.enc"');
    }


    public function decrypt(Request $request)
{
    $request->validate([
        'file' => 'required|file|max:10240',
        'key' => 'required|string|min:8',
    ]);

    $file = $request->file('file');
    // $key = $request->input('key');
    $data = file_get_contents($file);

    $iv = substr($data, 0, 8); // ambil IV dari awal
        $ciphertext = substr($data, 8);
        $key = $request->key;
    // $ivLength = openssl_cipher_iv_length("BF-CBC");
    // $iv = substr($data, 0, $ivLength);
    // $encryptedData = substr($data, $ivLength);


    $blowfish = new Blowfish('cbc');
    $blowfish->setPreferredEngine($blowfish::ENGINE_OPENSSL);

        $blowfish->setKey($key);
        $blowfish->setIV($iv);
    // $decrypted = openssl_decrypt($encryptedData, "BF-CBC", $key, OPENSSL_RAW_DATA, $iv);
    $decrypted = $blowfish->decrypt($ciphertext);

    FileLogs::create([
        'file_name' => $file->getClientOriginalName(),
        'type' => 'decryption',
        'size' => strlen($data),
    ]);
    if ($decrypted === false) {
        return response("Decryption failed", 500);
    }

    return response($decrypted)
        ->header('Content-Type', 'application/octet-stream')
        ->header('Content-Disposition', 'attachment; filename="'.str_replace('.enc', '', $file->getClientOriginalName()).'"');
}

}
