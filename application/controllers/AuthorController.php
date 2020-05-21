<?php

namespace application\controllers;
use application\core\Controller;
use application\models\Authors;

class AuthorController extends Controller
{
    public $authors;

    public function __construct($route, array $url_params = [], array $post_vars = [])
    {
        parent::__construct($route, $url_params, $post_vars);

        $this->authors = new Authors;
    }

    public function createAuthor()
    {
        $this->authors->create();
    }

    public function updateAuthor()
    {
        $this->authors->update();
    }

    public function getOneAuthor()
    {
        dump($this->authors->getOne());
    }

    public function getAllAuthorsByKeys()
    {
        $cursor = $this->authors->getAllByKeys();
        foreach ( $cursor as $id => $value )
            {
                dump( $value );
            }
    }

    public function getAllAuthors()
    {
        $cursor = $this->authors->getAll();
        foreach ( $cursor as $id => $value )
            {
                dump( $value );
            }
    }
}