<?php namespace App\Models;

use CodeIgniter\Model;

class SecretModel extends Model
{

    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['text', 'password', 'url'];

    public function create($data)
    {
        while ($this->where('url', $data['url'])->first() !== NULL) {
            $data['url'] = substr(uniqid(md5(rand()), true), 0, 6);
        }
        $this->save($data);
        return $this->where('url', $data['url'])->first();
    }

    public function code($text)
    {
        $key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
        $iv = hex2bin('34857d973953e44afb49ea9d61104d8c');
        $text = openssl_encrypt($text, 'AES-256-CBC', $key, 0, $iv);
        return $text;
    }

    public function decode($text)
    {
        $key = hex2bin('5ae1b8a17bad4da4fdac796f64c16ecd');
        $iv = hex2bin('34857d973953e44afb49ea9d61104d8c');
        $text = openssl_decrypt($text, 'AES-256-CBC', $key, 0, $iv);
        return $text;
    }

}
