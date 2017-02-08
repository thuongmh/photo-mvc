<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/28/2016
 * Time: 11:37 AM
 */

namespace App\Controller;

use App\Model\Users;

use App\Libs\Validation;

use App\Libs\Helper;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


class UsersController
{
    public function index()
    {
        $user = new Users();
        $user_id = $_SESSION['user_id'];
        $profile = $user->profile($user_id);
        if (isset($_POST['name']) == "fullname_edit") {
            $newFullName = $_POST['value'];
            $edit = $user->updateProfile($user_id, "fullname_edit", $newFullName, "");
        }
        if (isset($_POST['name']) == 'description_edit') {
            $newDescription = $_POST['value'];
            $edit = $user->updateProfile($user_id, "description_edit", "", $newDescription);
        }
        require APP . "view/profile.php";
    }

    public function updateAvatar()
    {

        if (isset($_POST['uploadAvatar'])) {
            $user = new Users();

            $file_name = "images/users/" . $_FILES['avatar_new']['name'];
            $id_user = $_SESSION["user_id"];
            if (move_uploaded_file($_FILES['avatar_new']['tmp_name'] , $file_name)) {
                $user->updateAva($id_user, $file_name);
            }
            header("Location:" . "/users");
        }
    }

    public function login()
    {
        $logger = new Logger("login");
        $logger->pushHandler(new StreamHandler(__DIR__ . '/login.log', Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());
        $user = new Users();
        if (isset($_POST["btn-login"])) {
            $username = $_POST["username-login"];
            $password = $_POST["password-login"];
            Helper::oldInputLogin($username, $password);
            $checkUser = $user->checkUser($username);
//            var_dump($checkUser);exit();
            if ($checkUser == 0) {
                Helper::setError("system", "Không tồn tại tài khoản này!");
            } else {
                if (password_verify($password, $checkUser["password"])) {
                    $_SESSION["login"] = 1;
                    $_SESSION["username"] = $username;
                    $_SESSION["user_id"] = $checkUser["user_id"];
                    $_SESSION["avatar"] = $checkUser["avatar"];
                    $_SESSION["fullname"] = $checkUser['fullname'];
                    $logger->info("Thông tin tài khoản đăng nhập /id/username:", [$_SESSION["user_id"], $_SESSION["username"]]);
//                    $logger->in;
                    header("Location:/home");
                } else {
                    Helper::setError("password", "Password không chính xác!");
                    header("Location:/");
                }
            }
        }
        require APP . 'view/login.php';
    }

    public function loginGoogle()
    {
        $user = new Users();
        $clientId = '61204788076-c05tmhbe0a8hmqgfj2gajfvol1uf0n56.apps.googleusercontent.com';
        $clientSecret = 'ND4msK8ml85XTZyKn5slr8HR';
        $redirectUri = "http://localhost:8000/users/loginGoogle";

        $client = new \Google_Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $client->setHttpClient($guzzleClient);

        $service = new \Google_Service_Oauth2($client);

        if (isset($_GET["code"])) {
            $client->authenticate($_GET["code"]);
            $_SESSION["access_token"] = $client->getAccessToken();
            $_SESSION["login"] = 1;
            $infoUser = $service->userinfo->get();
            $username = $infoUser->id;
            $password = "";
            $email = $infoUser->email;
            $fullname = $infoUser->name;
            $avatar = $infoUser->picture;
            $_SESSION["username"] = $username;
            $_SESSION["avatar"] = $avatar;
            $checkUser = $user->checkUser($username);
            if ($checkUser == 0) {
                $lastUserId = $user->register($username, $password, $email, $fullname, $avatar);
                $_SESSION["user_id"] = $lastUserId;
            } else {
                $userId = $checkUser["user_id"];
                $user->updateGoogle($userId, $username, $email, $fullname, $avatar);
                $_SESSION["user_id"] = $userId;
            }
            header("Location: http://localhost:8000/home");
        }


        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
            header("Location: http://localhost:8000/home");
        } else { // Ngược lại tạo 1 link để login
            $authUrl = $client->createAuthUrl();
            header("Location:" . $authUrl);
            exit();
        }


    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require APP . 'view/register.php';
        } else {
            $user = new Users();
            if (isset($_POST["btn-register"])) {
                $username = $_POST["username-register"];
                $password = $_POST["password-register"];
                $confirm = $_POST["confirm-password"];
                $email = $_POST["email-register"];
                $firstname = $_POST["firstname-register"];
                $lastname = $_POST["lastname-register"];
                $fullname = $firstname . " " . $lastname;
                $avatar = "images/users/anonymous.png";
                Helper::oldInputResgister($username, $password, $confirm, $email, $firstname, $lastname);
                $isValid = 0;
                if (!Validation::isValidUser($username)) {
                    Helper::setError("username", "Sai định dạng username!");
                    $isValid = 1;
                }
                if (!Validation::isValidPass($password)) {
                    Helper::setError("password", "Sai định dạng password!");
                    $isValid = 1;
                }
                if (!Validation::isValidPass($confirm)) {
                    Helper::setError("confirm", "Sai định dạng confirm password!");
                    $isValid = 1;
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Helper::setError("email", "Sai định dạng email!");
                    $isValid = 1;
                }
                if ($password != $confirm) {
                    Helper::setError("confirm", "Password và Confirm password không trùng nhau!");
                    $isValid = 1;
                }
                $checkUser = $user->checkUser($username);
                if ($checkUser != 0) {
                    Helper::setError("system", "Tài khoản đã tồn tại!");
                    $isValid = 1;
                } else {
                    if ($isValid == 0) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $lastUserId = $user->register($username, $password, $email, $fullname, $avatar);
                        $_SESSION["login"] = 1;
                        $_SESSION["username"] = $username;
                        $_SESSION["user_id"] = $lastUserId;
                        // send email
                        $mail = new \PHPMailer();

                        $mail->SMTPDebug = 0;                               // Enable verbose debug output

                        $mail->isSMTP();                                    // Set mailer to use SMTP
                        $mail->CharSet = "UTF-8";
                        $mail->Host = 'mailtrap.io';                        // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                             // Enable SMTP authentication
                        $mail->Username = '3d096ec81f4797';                 // SMTP username
                        $mail->Password = '28b53de9a8c493';                 // SMTP password
                        $mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 25;                                   // TCP port to connect to

                        $mail->addAddress($email, 'MHT');                   // Add a recipient

                        $mail->isHTML(true);                                // Set email format to HTML

                        $mail->Subject = 'Thành công rồi nhé';
                        $mail->Body = 'This is the HTML message body <b>in bold!</b>';
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        if (!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo 'Message has been sent';
                        }

                        header("Location:/home");
                    } else {
                        header("Location:/users/register");
                    }
                }
            }
        }
    }

    public function reset()
    {
        $user = new Users();
        if (isset($_POST["action"]) && $_POST["action"] == "reset") {
            $email = $_POST["email_reset"];
            $token = md5($email);
            Helper::oldInputReset($email);
            $checkEmail = $user->checkEmail($email);
            if ($checkEmail == 0) {
                $error = array(
                    "error" => true,
                    "message" => "Không tồn tại email này!"
                );
                die(json_encode($error));
            } else {
                $error = array(
                    "error" => false,
                    "message" => "Đã gửi yêu cầu xác nhận đến email này!"
                );

                $_SESSION["user_id"] = $checkEmail["user_id"];

                $_SESSION["old-password"] = $checkEmail["password"];

                $mail = new \PHPMailer();

                $mail->SMTPDebug = 0;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->CharSet = "UTF-8";
                $mail->Host = 'mailtrap.io';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '3d096ec81f4797';                 // SMTP username
                $mail->Password = '28b53de9a8c493';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                $mail->setFrom('abc@gmail.com', 'Mailer');
                $mail->addAddress($email, 'MHT');     // Add a recipient

                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Xác nhận thiết lập lại mật khẩu';
                $mail->Body = 'Click vào <a href="' . URL . 'users/verify?token=' . $token . '&email=' . $email . '">đây</a> để thay đổi password';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
//                    echo 'Message has been sent';
                }
                die(json_encode($error));
            }
        }
        require APP . "/view/reset.php";
    }

    public function verify()
    {
        if (isset($_GET["token"]) && isset($_GET["email"]) && $_GET["token"] == md5($_GET["email"])) {
            $_SESSION["reset"] = md5($_GET["email"]);
            $_SESSION["email_reset"] = $_GET["email"];
            header("Location:/users/change");
        } else {
            header("Location:/");
        }
    }

    public function change()
    {
        $user = new Users();
        if (isset($_SESSION["reset"])) {
            $userId = $_SESSION["user_id"];
            if (isset($_POST["btn-change"])) {
                $oldPassword = $_POST["old-password"];
                $newPassword = $_POST["new-password"];
                $confirm = $_POST["confirm-password"];
                if (!password_verify($oldPassword, $_SESSION["old-password"])) {
                    Helper::setError("old-password", "Password cũ không đúng!");
                }
                if (!Validation::isValidPass($oldPassword) || !Validation::isValidPass($newPassword) || !Validation::isValidPass($confirm)) {
                    Helper::setError("password", "Sai định dạng password!");
                }
                if ($newPassword != $confirm) {
                    Helper::setError("confirm", "New Password và Confirm password không trùng nhau!");
                }
                $password = password_hash($newPassword, PASSWORD_DEFAULT);
                $change = $user->updatePassword($password, $userId);
                if ($change) {
                    header("Location:" . URL);
                } else {
                    Helper::setError("system", "Sai ở đâu rồi thì phải!");
                }
            }
        } else {
            header("Location:" . URL);
        }
        require APP . "view/change.php";
    }

    public function logout()
    {
        unset($_SESSION["login"]);
        $_SESSION['access_token'] = null;
        unset($_SESSION["user_id"]);
        unset($_SESSION["username"]);
        unset($_SESSION["avatar"]);
        header("Location:" . URL);
    }
}