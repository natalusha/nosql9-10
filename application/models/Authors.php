<?php 
	namespace application\models;
    use application\models\Dao;

    class Authors implements Dao
    {
        public $authorsCollection;

        public function __construct()
        {
            require "application\core\Db.php";

            $this->authorsCollection = $client->authorsCollection;
        }

        public function create()
        {
            $this->authorsCollection->insertOne(['name' => 'author', 'age' => 12]);
        }

        public function update()
        {
            $this->authorsCollection->updateMany(['name' => 'author', 'age' => 12], ['$set'=> ['name' => 'authorUpdated', 'age' => 13, 'makitra' => 1]]); 
        }

        public function getOne()
        {
            return $this->authorsCollection->findOne(['name' => 'author', 'age' => 12]);
        }

        public function getAllByKeys()
        {
            return $this->authorsCollection->find(['name' => 'author', 'age' => 12]);
        }

        public function getAll()
        {
            return $this->authorsCollection->find();
        }
    }
