<?php

namespace application\controllers;
use application\core\Controller;
use application\models\Works;

class WorkController extends Controller
{
    public $works;

    public function __construct($route, array $url_params = [], array $post_vars = [])
    {
        parent::__construct($route, $url_params, $post_vars);

        $this->works = new Works;
    }
    
    public function index()
    {
        return $this->view->render('Mongo');
    }

    public function createWork()
    {
        $this->works->create();
    }

    public function updateWork()
    {
        $this->works->update();
    }

    public function getOneWork()
    {
        dump($this->works->getOne());
    }

    public function getAllWorksByKeys()
    {
        $cursor = $this->works->getAllByKeys();
        foreach ( $cursor as $id => $value )
            {
                dump( $value );
            }
    }

    public function getAllWorks()
    {
        $cursor = $this->works->getAll();
        foreach ( $cursor as $id => $value )
            {
                dump( $value );
            }
    }

    public function insertManyWorks()
    {
        $quantityOfRequests = $_POST['quantityOfRequests'];
        $starttime = microtime(true);

        for ($i = 0; $i < $quantityOfRequests; $i++) {
            $this->works->create();     
        }

        $endtime = microtime(true);
        $duration = $endtime - $starttime; //calculates total time taken

        dump('time of make ' .$quantityOfRequests. ' queries = '. $duration);
    }
}