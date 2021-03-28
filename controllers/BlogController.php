<?php
    namespace controllers;
    use core\BaseController;
    use models\RecordModel;
    use models\UserModel;
    use models\CommentModel;

    class BlogController extends BaseController
    {
        public function __construct()
        {
            if(!isset($_SESSION)) session_start();
        }

        public function actionIndex()
        {
            $this->layots = true;
            $blogModel = RecordModel::find()
                    ->where(['status' => 'approved'])
                    ->all();
            
            $blogModel = array_reverse($blogModel);
            $authorNicks = [];
            $qty_comments = [];

            foreach($blogModel as $key => $value){
                $commentModel = CommentModel::find()
                            ->where(['status' => 'approved', 'id_record' => $value->id])
                            ->all();

                $userModel = UserModel::find()
                            ->where(['id'=>$value->id_user])
                            ->one();

                $authorNicks[$value->id] = $userModel->nick;
                $qty_comments[$value->id] = count($commentModel); 
            }

            $this->render('index',['model' => $blogModel, 'authorNicks' => $authorNicks, 'qty_comments' => $qty_comments]);
        }

        public function actionCreate()
        {
            $this->layots = true;
            $model = new RecordModel;
            if($model->loadPost()){
                $model->id_user = $_SESSION['Auth'];
            
                if($model->save()){
                    $_SESSION['success'] = 'Record added';
                    $this->redirect('/blog/authorRecords?id=' . $_SESSION['Auth']);
                } else {
                    $_SESSION['error'] = 'Error added Record';
                    $this->redirect('/blog/authorRecords?id='. $_SESSION['Auth']);
                }
            }

            $this->render('create');
        }

        public function actionLikeDislike()
        {
            if(isset($_POST)){
                $id = $_POST['id'];
                $type = $_POST['type'];
               
                $model = new RecordModel;
                $record =  RecordModel::find()
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

        public function actionItem()
        {
            $this->layots = true;
            $id = $_GET['id'];
            
            $record = RecordModel::find()
                    ->where(['id' => $id])
                    ->one();

            $author = UserModel::find()
            ->where(['id' => $record->id_user])
            ->one(); 

            $comments = CommentModel::find()
                    ->where(['id_record' => $id,'status' => 'approved'])
                    ->all();

            $comments = array_reverse($comments);
            
            $authors_comments= [];

            foreach($comments as $key => $value){
                $author_comment = UserModel::find()
                                ->where(['id' => $value->id_user])
                                ->one();
                $authors_comments[$value->id] = $author_comment->nick;                  
            }

            $this->render('item',['record' => $record, 'comments' => $comments, 'author' => $author, 'authors_comments' => $authors_comments]);
        }

        public function actionEdit()
        {
            $this->layots = true;

            $model = new RecordModel;

            $record = RecordModel::find()
                    ->where(['id' => $_GET['id']])
                    ->one();

            //заповнює поля 
            foreach($record as $key => $value){
                if($key != 'password') {
                    $model->{$key} = $value;
                }
            }

            if($model->loadPost() && $model->validate()) {
                $model->date = date("Y-m-d");
                if($model->update(['id' => $record->id])){
                    $_SESSION['success'] = "OK";
                } else {
                    $_SESSION['error'] = "Error";
                }
                $this->redirect('/blog/authorItem?id=' . $model->id);
            }
            $this->render('create',['model' => $model]);
        }

        public function actionAuthorRecords()
        {
            $this->layots = true;

            $id = $_GET['id'];
           
            $records = RecordModel::find()
            ->where(['id_user' => $id])
            ->all();

            $qty_comments = [];
            
            $records = array_reverse($records);

            foreach($records as $key => $value){
                $commentModel = CommentModel::find()
                ->where(['id_record' => $value->id])
                ->all();
               
                $qty_comments[$value->id] = count($commentModel); 
            }

            $this->render('index_author',['records' => $records, 'qty_comments' => $qty_comments]);
        }

        public function actionAuthorItem()
        {
            $this->layots = true;
            $id = $_GET['id'];
            
            $record = RecordModel::find()
                    ->where(['id' => $id])
                    ->one();

            $author = UserModel::find()
            ->where(['id' => $record->id_user])
            ->one(); 

            $comments = CommentModel::find()
                    ->where(['id_record' => $id,'status' => 'approved'])
                    ->all();

            $comments = array_reverse($comments);
            
            $authors_comments= [];

            foreach($comments as $key => $value){
                $author_comment = UserModel::find()
                                ->where(['id' => $value->id_user])
                                ->one();
                $authors_comments[$value->id] = $author_comment->nick;                  
            }

            $this->render('/authorItem',['record' => $record, 'comments' => $comments, 'author' => $author, 'authors_comments' => $authors_comments]);
        }

        public function actionUpdateItem()
        {
            if(isset($_POST['id'])){
                $id = $_POST['id'];
           
                $model = new RecordModel;
                $record = RecordModel::find()
                        ->where(['id' => $id])
                        ->one();
                        
                foreach($record as $key => $value){
                    $model->{$key} = $value;
                }
        
                $model->date = date("Y-m-d");
                $model->status = 'not approved';

                CommentModel::delete(['id_record' => $id]);

                if($model->update(['id' =>  $id])){
                    echo json_encode(['status' => 'success', 'id' => $id]);
                } else {
                    echo json_encode(['status' => 'error', 'id' => $id]);
                }       
            } else {
                echo json_encode(['status' => 'error', 'id' => $id]);
            }
        }
    }