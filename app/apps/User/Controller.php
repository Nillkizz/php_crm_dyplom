<?php namespace apps\User;


class Controller extends \Core\Controller
{
    public function index()
    {
        $this->pageData['title'] = "Страница пользователя";
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
    }

    public function login()
    {
        $this->pageData['title'] = "Вход в личный кабинет";
        if (!empty($_SESSION['user'])) {
            header('Location: /user/');
        }

        if (!empty($_POST)) {
            $login = $_POST['login'];
            $password = md5($_POST['password']);

            $userID = $this->model->checkUser($login, $password);
            if (empty($userID)) {
                $this->pageData['error'] = "Не правильный логин или пароль";
            } else {
                $_SESSION['user'] = $userID;
                header("Location: /user");
            }
        }
    }


    public function logout()
    {
        session_destroy();
        header('Location: /user/login');
    }
}