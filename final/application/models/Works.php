<?php 
	namespace application\models;
    use application\models\Dao;

    class Works implements Dao
    {
        public $worksCollection;
        public $table = 'works';

        public function __construct()
        {
            require "application\core\Db.php";

            $this->worksCollection = $client->worksCollection;
            parent::__construct();
        }

        public function create($workValues, $authorValues, $genreValues, $countryValues)
        {
            if($db = 'mongo') {
                $this->worksCollection->insertOne(['name' => 'Test', 'age' => 12]);
            }
            else {
                $workKey = $this->createWork($workValues);
                $authorKey = $this->createAuthor($authorValues);
                $genreKey = $this->createGenre($genreValues);
                $countryKey = $this->createCountry($countryValues);

                $this->createWorksAuthorsRelations($workKey, $authorKey);
                $this->createGenreWorkRelations($genreKey, $workKey);
                $this->createCountryAuthorRelations($countryKey, $authorKey);
            }
            
        }

        public function update()
        {
            if($db = 'mongo') {
                $this->worksCollection->updateMany(['name' => 'Test', 'age' => 12], ['$set'=> ['name' => 'Updated', 'age' => 13, 'makitra' => 1]]); 
            }
            else {
                if(!empty($data['workValues'])) {
                    $this->updateWork($data['workValues']['columns'], 
                                      $data['workValues']['values'], 
                                      $data['workValues']['condition']);
                    $workUKey = $data['workValues']['condition'];
                }
            }
        }

        public function updateWork($columns, $values, $condition)
        {
            return $this->updateRecord('works', $columns, $values, 'id_works', $condition);
        }

        public function getOne()
        {
            if($db = 'mongo') {
                return $this->worksCollection->findOne(['name' => 'Test', 'age' => 12]);
            }
            else {
                return $this->getOne($this->table, 'id_works', intval($id));
            }
        }

        public function getAllByKeys()
        {
            if($db = 'mongo') {
                return $this->worksCollection->find(['name' => 'Test', 'age' => 12]);
            }
            else {
                return $this->getAllByTag(['name' => 'Test', 'age' => 12]);
            }
        }

        public function getAll()
        {
            if($db = 'mongo') {
                return $this->worksCollection->find();
            }
            else {
                return $this->getAllWithRelations();
            }
        }

        private function createWork($values)
        {
            $columns = ['work_name', 'cr_year'];
            return $this->createRecord('works', $columns, $values);
        }

        private function createAuthor($values)
        {
            $columns = ['frst_name', 'scnd_name', 'pen_name', 'birth', 'death'];
            return $this->createRecord('authors', $columns, $values);
        }

        private function createGenre($values) 
        {
            $columns = ['genre_name'];
            return $this->createRecord('genre', $columns, $values);
        }

        private function createCountry($values)
        {
            $columns = ['country_name', 'city_name'];
            return $this->createRecord('countries', $columns, $values);
        }

        private function createWorksAuthorsRelations($workKey, $authorKey)
        {
            $columns = ['id_w', 'id_a'];
            $this->createRecord('id_w_id_a', $columns, [$workKey, $authorKey]);
        }

        private function createGenreWorkRelations($genreKey, $workKey)
        {
            $columns = ['id_g', 'id_w'];
            $this->createRecord('id_g_id_w', $columns, [$genreKey, $workKey]);
        }

        private function createCountryAuthorRelations($countryKey, $authorKey)
        {
            $columns = ['id_c', 'id_a'];
            $this->createRecord('id_c_id_a', $columns, [$countryKey, $authorKey]);
        }

    }
