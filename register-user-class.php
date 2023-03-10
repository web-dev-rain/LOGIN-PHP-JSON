<?php

class RegisterUser
{
    private $login;
    private $raw_password;
    private $confirm_password;
    private $email;
    private $username;
    private $encrypted_password;

    public $error;
    public $loginError;
    public $passwordError;
    public $confirmPasswordError;
    public $emailError;
    public $usernameError;
    public $success;
    private $storage = "data.json";
    private $stored_users;
    private $new_user;

    public function __construct(
        $login,
        $password,
        $confirm_password,
        $email,
        $username
    )
    {

        $this->login = $login;

        $this->raw_password = filter_var($password, FILTER_SANITIZE_STRING);
        $this->encrypted_password = md5($this->raw_password . 'ัะตัั');


        $this->confirm_password = filter_var(trim($confirm_password), FILTER_SANITIZE_STRING);

        $this->email = trim($email);

        $this->username = $username;
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);

        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->new_user = [
            "id" => count($this->stored_users) + 1,
            "username" => $this->username,
            "password" => $this->encrypted_password,
            "login" => $this->login,
            "email" => $this->email
        ];

        if ($this->checkFieldValues()) {
            $this->insertUser();
        }
    }

    private function checkFieldValues()
    {
        $letterPassword = preg_match('@[A-Za-z]@', $this->raw_password);
        $name = preg_match("/^([a-zA-Z' ]+)$/",$this->username);

        $number = preg_match('@[0-9]@', $this->raw_password);

        $spaceLogin = preg_match("|\s|", $this->login);
        $spacePassword = preg_match("|\s|", $this->raw_password);
        $spaceUsername = preg_match("|\s|", $this->username);

        $passwordSpecialChars = preg_match("/^[A-Za-z0-9]+$/", $this->raw_password);

        if (
            empty($this->login) ||
            empty($this->raw_password) ||
            empty($this->email) ||
            empty($this->username)
        ) {
            $this->error = "ะัะต ะฟะพะปั ะดะพะปะถะฝั ะฑััั ะทะฐะฟะพะปะฝะตะฝั.";
            return false;
        } else if (strlen($this->login) < 6) {
            $this->loginError = "ะะปะธะฝะฐ ะปะพะณะธะฝะฐ - ะฝะต ะผะตะฝะตะต 6 ัะธะผะฒะพะปะพะฒ";
            return false;
        } else if ($spaceLogin) {
            $this->error = "ะะพะณะธะฝ ะฝะต ะดะพะปะถะตะฝ ัะพะดะตัะถะฐัั ะฟัะพะฑะตะปั";
            return false;
        } else if ($spacePassword) {
            $this->passwordError = "ะะฐัะพะปั ะฝะต ะดะพะปะถะตะฝ ัะพะดะตัะถะฐัั ะฟัะพะฑะตะปั";
            return false;
        } else if ($this->raw_password !== $this->confirm_password) {
            $this->confirmPasswordError = "ะะฐัะพะปะธ ะฝะต ัะพะฒะฟะฐะดะฐัั";
            return false;
        } else if (!$letterPassword || !$number) {
            $this->passwordError = "ะะฐัะพะปั ะดะพะปะถะตะฝ ัะพะดะตัะถะฐัั ัะธััั ะธ ะฑัะบะฒั";
            return false;
        } else if (!$passwordSpecialChars) {
            $this->passwordError = "ะะฐัะพะปั ะฝะต ะดะพะปะถะตะฝ ัะพะดะตัะถะฐัั ัะฟะตััะธะผะฒะพะปั";
            return false;
        } else if (strlen($this->raw_password) < 6) {
            $this->passwordError = "ะะปะธะฝะฐ ะฟะฐัะพะปั - ะผะธะฝะธะผัะผ 6 ัะธะผะฒะพะปะพะฒ";
            return false;
        } else if (!(filter_var($this->email, FILTER_VALIDATE_EMAIL))) {
            $this->emailError = "Email ัะบะฐะทะฐะฝ ะฝะตะฒะตัะฝะพ";
            return false;
        } else if (!$name) {
            $this->usernameError = "ะะผั ะฟะพะปัะทะพะฒะฐัะตะปั ะดะพะปะถะฝะพ ัะพะดะตัะถะฐัั ัะพะปัะบะพ ะฑัะบะฒั";
            return false;
        }  else if (strlen($this->username) < 2) {
            $this->usernameError = "ะะปะธะฝะฐ ะธะผะตะฝะธ - ะผะธะฝะธะผัะผ 2 ัะธะผะฒะพะปะฐ";
            return false;
        } else if ($spaceUsername) {
            $this->usernameError = "ะะผั ะฝะต ะดะพะปะถะฝะพ ัะพะดะตัะถะฐัั ะฟัะพะฑะตะปั";
            return false;
        } else {
            return true;
        }
    }

    private function isLoginUnique()
    {
        foreach ($this->stored_users as $user) {
            if ($this->login == $user['login']) {
                $this->loginError = "ะะพะณะธะฝ ัะถะต ะธัะฟะพะปัะทัะตััั.";
                return true;
            }
        }
        return false;
    }

    private function isEmailUnique()
    {
        foreach ($this->stored_users as $user) {
            if ($this->email == $user['email']) {
                $this->emailError = "Email ัะถะต ะธัะฟะพะปัะทัะตััั.";
                return true;
            }
        }
        return false;
    }

    private function insertUser()
    {
        if (!$this->isLoginUnique()) {
            if (!$this->isEmailUnique()) {
                $this->stored_users[] = $this->new_user;
                if (file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))) {
                    return $this->success = "ะ?ะตะณะธัััะฐัะธั ะฟัะพัะปะฐ ััะฟะตัะฝะพ";
                } else {
                    return $this->emailError = "ะะพะณะธะฝ ะธ Email ะดะพะปะถะฝั ะฑััั ัะฝะธะบะฐะปัะฝัะผะธ";
                }
            }
        }
    }
}