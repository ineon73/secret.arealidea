<?php namespace App\Controllers;

use App\Models\SecretModel;

class SecretController extends BaseController
{
    public function index()
    {
        $data['button'] = 'Зашифровать';
        echo view('header');
        echo view('index', $data);
        echo view('footer');
    }

    public function create()
    {
        $model = new SecretModel();
        $url = substr(uniqid(md5(rand()), true), 0, 6);
        $data = [
            'text' => $model->code($this->request->getPost('text')),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'url' => $url
        ];
        $data = $model->create($data);
        $data['message'] = 'Ваша ссылка:' . ' <a href=' . $data['url'] . ">{$data['url']}</a>";
        echo view('header');
        echo view('message', $data);
        echo view('footer');
    }

    public function show()
    {
        $data['mode'] = 3;
        $data['button'] = 'Расшифровать';
        echo view('header');
        echo view('index', $data);
        echo view('footer');
    }

    public function decode()
    {
        $password = $this->request->getPost('password');
        $url = $this->request->uri->getSegment(1);
        $model = new SecretModel();
        $code = $model->where('url', $url)->first();
        if (password_verify($password, $code['password'])) {
            $text = $code['text'];
            $text = $model->decode($text);
            $data['message'] = $text;
            echo view('header');
            echo view('message', $data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('message', ['message' => "Неправильный пароль"]);
            echo view('footer');
        }
    }

    public function delete()
    {
        $url = $this->request->uri->getSegment(1);
        $model = new SecretModel();
        $model->where('url', $url)->delete();
        $data['message'] = 'Успешно удалено';
        echo view('header');
        echo view('message', $data);
        echo view('footer');
    }
    //--------------------------------------------------------------------

}
