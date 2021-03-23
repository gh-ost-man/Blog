<?php
    namespace controllers;

    use core\BaseController;
    use models\UserModel;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class UserController extends BaseController
    {
        public function __construct()
        {
            $this->layots = true;

            if(!isset($_SESSION)) session_start();
        }

        public function actionIndex()
        {
            echo __CLASS__;
        }

        public function actionLogin()
        {
            $model = new UserModel;
            if($model->loadPost()){
                $user = UserModel::find()
                ->where(['email' => $model->email,'password' => $this->passwordHasher($model->password)])
                ->one();

                if($user){
                    $_SESSION['Auth'] = $user->id;
                    $_SESSION['Nick'] = $user->nick;
                    $_SESSION['Role'] = $user->role;
                    $_SESSION['Avatar'] = $user->url_avatar;
                    $_SESSION['Email'] = $user->email;
                    $this->redirect('/blog');
                }
            }

            $this->render('login', ['model' => $model]);
        }

        public function actionLogOut()
        {
            if(!isset($_SESSION)) session_start();

            session_unset();
            session_destroy();
            $this->redirect('/blog');
        }
        public function actionRegister()
        {
            // Пошук по email чи не має такого емайлу в БД
            // 1. find SELECT * FROM table
            // 2. where - add fields and value 
            // 3. all execute query and return value(масив обєктів)  
            // 4. one виконати повернути обєкт

            $model = new UserModel;
            if($model->loadPost() && $model->validate()){
                $user = UserModel::find()
                ->where(['email' => $model->email])
                ->one();

                if(!$user){
                    $model->password = $this->passwordHasher($model->password);
                    if($_FILES['avatar']['name'] != ""){
                        $fileExtension = explode('.', $_FILES['avatar']['name']);
                        $fileName = md5(microtime()) . '.' . $fileExtension[count($fileExtension) - 1];
    
                        if(!file_exists('avatar')){
                            mkdir('avatar');
                        }
                        move_uploaded_file($_FILES['avatar']['tmp_name'], 'avatar/' . $fileName);
                    } else {
                        $fileName = 'notAvatar.png';
                    }
                   
                    $model->url_avatar = 'avatar/' . $fileName;     
                   
                    if($model->save()) {
                        $this->actionSendEmail($model);
                        $_SESSION['success'] = "OK";
                        $this->redirect('/blog');
                    } else {
                        $_SESSION['error'] = "Error";
                        $this->redirect('/blog');
                        die();
                    }
                } else {
                    $_SESSION['error'] = 'User with this email is already registered';
                    $this->redirect('/blog');
                }
            }
            $this->render('create',['model' => $model]);
        }

        //Для відправки повідомлення для підтвердження
        public function actionSendEmail($user)
        {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'hunter216018@gmail.com';                     //SMTP username
                $mail->Password   = 'testpasswordphp5';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //Recipients
                $mail->setFrom('hunter216018@gmail.com', 'Mailer');
                $mail->addAddress($user->email, 'Joe User');     //Add a recipient
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirm registration';
                $mail->Body    = '<p> Confirm </p> <a href="http://localhost/user/confirm?user=' . $user->id . '" target="_blank">Confirm</a>';
            
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                die();
            }
        }

        public function actionConfirm()
        {
            var_dump($_GET);
            die();
        }
    }