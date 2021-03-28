<?php
    namespace controllers;
    use core\BaseController;
    use models\RecordModel;
    use models\UserModel;
    use models\CommentModel;

    class CommentController extends BaseController
    {
        public function __construct()
        {
            if(!isset($_SESSION)) session_start();
        }

        public function actionCreate()
        {
            $this->layots = true;
            $model = new CommentModel;
            if($model->loadPost()){
                $model->id_user = $_SESSION['Auth'];
                $model->id_record = $_GET['id'];

                if($model->save()){
                    $_SESSION['success'] = 'Comment added';
                    $this->redirect('/blog/item?id=' . $_GET['id']);
                } else {
                    $_SESSION['error'] = 'Error added Comment';
                    $this->redirect('/blog/item?id=' . $_GET['id']);
                }
            }

            $this->render('create');
        }

        public function actionLikeDislike()
        {
            if(isset($_POST)){
                $id = $_POST['id'];
                $type = $_POST['type'];
               
                $model = new CommentModel;
                $record =  CommentModel::find()
                        ->where(['id' => $id])
                        ->one();
                        
                foreach($record as $key => $value){
                    $model->{$key} = $value;
                }

                $model->{$type}++;

                if($model->update(['id' =>  $id])){
                    echo json_encode(['status' => 'success', 'id' => $id]);
                } else {
                    echo json_encode(['status' => 'error', 'id' => $id]);
                }       
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }