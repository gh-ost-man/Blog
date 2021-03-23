<?php
    namespace controllers;
    use core\BaseController;

    class BlogController extends BaseController
    {
        public function actionIndex()
        {
            $model = ['id' => 1, 'record' => 'My record #1'];
            $this->layots = true;
            $this->render('index',['model' => $model, 'user' => 'author' ]);
        }

        public function actionCreate()
        {
            $this->layots = false;
            $this->render('create');
        }
    }