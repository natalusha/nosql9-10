<?php 
	namespace application\models;
    use application\models\Dao;

    class Works implements Dao
    {
        public $worksCollection;

        public function __construct()
        {
            require "application\core\Db.php";

            $this->worksCollection = $client->worksCollection;
        }

        public function create()
        {
            $this->worksCollection->insertOne(['name' => 'Test', 'age' => 12]);
        }

        public function update()
        {
            $this->worksCollection->updateMany(['name' => 'Test', 'age' => 12], ['$set'=> ['name' => 'Updated', 'age' => 13, 'makitra' => 1]]); 
        }

        public function getOne()
        {
            return $this->worksCollection->findOne(['name' => 'Test', 'age' => 12]);
        }

        public function getAllByKeys()
        {
            return $this->worksCollection->find(['name' => 'Test', 'age' => 12]);
        }

        public function getAll()
        {
            return $this->worksCollection->find();
        }
    }
