<?php
    namespace controllers;

    use core\BaseController;
    use models\RecordModel;
    use models\UserModel;
    use models\CommentModel;

    class AdminController extends BaseController
    {
        public function __construct()
        {
            $this->layots = true;

            if(!isset($_SESSION)) session_start();
        }

        public function actionRecords()
        {
            $this->layots = true;

            $records = RecordModel::find()
                    ->all();
            
            $records = array_reverse($records);

            $statuses = RecordModel::getStatuses();

            $authors = [];
            foreach($records as $key => $value){
                $author = UserModel::find()
                        ->where(['id' => $value->id_user])
                        ->one();
                $authors[$value->id] = $author->nick;   
            }

            $this->render('adminRecords',['records' => $records,'statuses' => $statuses, 'authors' => $authors ]);
        }

        public function actionUpdateStatusRecord()
        {
            $this->layots = true;

            if(isset($_POST)){
                $id = $_POST['id'];
                $status = $_POST['status_record'];

                $model = new RecordModel;
                $record = RecordModel::find()
                        ->where(['id' => $id])
                        ->one();
              
                foreach($record as $key => $value){
                    $model->{$key} = $value;
                }

                $model->status = $status;

                if($model->update(['id' =>  $id])){
                    echo json_encode(['status' => 'success', 'id' => $id]);
                } else {
                    echo json_encode(['status' => 'error', 'id' => $id]);
                }       
            } else {
                echo json_encode(['status' => 'error', 'id' => $id]);
            }
        }

        public function actionDeleteRecord()
        {
            $this->layots = true;

            if(isset($_GET)){
                $id = $_GET['id'];
               
                $model = new RecordModel;
                $record = RecordModel::find()
                        ->where(['id' => $id])
                        ->one();
              
                foreach($record as $key => $value){
                    $model->{$key} = $value;
                }
              
                switch($model->status){
                    case 'approved': 
                        // При видаленні затверджених записів («аpproved»), записи з БД не видаляються.
                        // Змінюється статус записів на «not аpproved» та видаляються всі коментарі до них.
                        
                        $model->status = 'not approved';
                        CommentModel::delete(['id_record' => $id]);
                    break;
                    case 'not approved': 
                        // При видаленні не затверджених записів («not аpproved»), записи з БД видаляються.
                       
                        RecordModel::delete(['id' => $id]);    
                    break;
                    case 'delete': break;
                }
                $this->redirect('/admin/records');
            }
            $this->redirect('/admin/records');
        }

        public function actionComments()
        {
            $this->layots = true;

            $commets = CommentModel::find()
                    ->all();
            
            $commets = array_reverse($commets);

            $statuses = CommentModel::getStatuses();

            $authors = [];
            
            foreach($commets as $key => $value){
                $author = UserModel::find()
                        ->where(['id' => $value->id_user])
                        ->one();
                $authors[$value->id] = $author->nick;   
            }

            $this->render('adminComments',['commets' => $commets,'statuses' => $statuses, 'authors' => $authors ]);
        }

        public function actionUpdateStatusComment()
        {
            $this->layots = true;

            if(isset($_POST)){
                $id = $_POST['id'];
                $status = $_POST['status_comment'];

                $model = new CommentModel;
                $comment = CommentModel::find()
                        ->where(['id' => $id])
                        ->one();
              
                foreach($comment as $key => $value){
                    $model->{$key} = $value;
                }

                $model->status = $status;

                if($model->update(['id' =>  $id])){
                    echo json_encode(['status' => 'success', 'id' => $id]);
                } else {
                    echo json_encode(['status' => 'error', 'id' => $id]);
                }       
            } else {
                echo json_encode(['status' => 'error', 'id' => $id]);
            }
        }

        public function actionDeleteComment()
        {
            $this->layots = true;

            if(isset($_GET)){
                $id = $_GET['id'];
               
                CommentModel::delete(['id' => $id]) ;

                $this->redirect('/admin/comments');
            }
            $this->redirect('/admin/comments');
        }

        public function actionUsers()
        {
            $this->layots = true;

            $users = UserModel::find()->all();
            $roles = UserModel::getRoles();

            $this->render('adminUsers', ['users' => $users, 'roles' => $roles]);
        }

        public function actionUpdateRole()
        {
            $this->layots = true;

            if(isset($_POST)){
                $id = $_POST['id'];
                $role = $_POST['role'];

                $model = new UserModel;
                $user = UserModel::find()
                        ->where(['id' => $id])
                        ->one();
              
                foreach($user as $key => $value){
                    $model->{$key} = $value;
                }

                $model->role = $role;

                if($model->update(['id' =>  $id])){
                    echo json_encode(['status' => 'success', 'id' => $id]);
                } else {
                    echo json_encode(['status' => 'error', 'id' => $id]);
                }       
            } else {
                echo json_encode(['status' => 'error', 'id' => $id]);
            }
        }

        public function actionDeleteUser()
        {
            $this->layots = true;

            if(isset($_GET)){
                $id = $_GET['id'];
               
                UserModel::delete(['id' => $id]) ;

                $this->redirect('/admin/users');
            }
            $this->redirect('/admin/users');
        }
    }