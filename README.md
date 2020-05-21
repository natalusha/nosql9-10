
# NOSQL 9-10 ПЗ

Для создания реплик мы добавляем опции подключения к MongoDB, где указываем количество реплик и по каким портам их нужно инициализировать.

    $client = (new MongoDB\Client("mongodb://localhost:27017,mongodb://localhost:27018,mongodb://localhost:27019", , ["replicaSet" => ["db1", "db2", "db3"]]))->mongo;

Остальная логика, а именно создание колекций в каждой реплике осуществляется уже в файле модели Works.php

    class  Works  implements  Dao

	{

	public  $worksCollection1;

	public  $worksCollection2;

	public  $worksCollection3;

	public  $table = 'works';

	  

	public  function  __construct()

	{

	require  "application\core\Db.php";

	  

	$this->worksCollection1 = $client[0]->worksCollection1;

	$this->worksCollection2 = $client[1]->worksCollection2;

	$this->worksCollection3 = $client[2]->worksCollection3;

	parent::__construct();

	}

Как и в предыдущей лабораторной, я добавила выпадающий список для выбора реплики, выпадающий список активен только при выборе MongoDB из списка выше.
![enter image description here](https://raw.githubusercontent.com/natalusha/nosql9-10/master/1.PNG)

На стороне сервера мы в каждом запросе получаем  параметр $_GET массива с указанной БД и Репликой. 

**$db = $_GET['selectDB'], $selectReplica = $_GET['selectReplica']**

    public  function  index()

	{

	$allWorksWithRelations = $this->works->getAll($db = $_GET['selectDB'], 	$selectReplica = $_GET['selectReplica']);

	  

	$this->view->render('Works',['allInfo' => $allWorksWithRelations]);

	}

	  

	public  function  insertWork()

	{

	$this->works->create(

	[$_POST['workName'], $_POST['workCreationYear']],

	[$_POST['firstName'], $_POST['secondName'], $_POST['penName'], $_POST['birthDate'], $_POST['deathDate']],

	[$_POST['genre']],

	[$_POST['countryName'], $_POST['cityName']], $db = $_GET['selectDB'], $selectReplica = $_GET['selectReplica']);

	  

	header('location: /');

	}

	  

	public  function  showUpdate()

	{

	if (isset($_GET['workId'])) {

	$this->view->render('Update work', ['worksInfo' => $this->works->getOneWork($_GET['workId'], $db = $_GET['selectDB'], $selectReplica = $_GET['selectReplica'])]);

	}

	}

И так далее в каждом запросе. *Файл: WorkController.php*

После контроллера данные оправляются в модель, где уже в каждом DAO методе выполняется проверка, как можно заметить, теперь добавлена проверка на реплику.

	public  function  create($workValues, $authorValues, $genreValues, $countryValues, $db, $dbReplica)

	{

	if($db == 'mongo') {

	$data = ['name' => 'Test', 'age' => 12];

	if ($dbReplica == 1) {

	$this->worksCollection1->insertOne($data);

	}

	if ($dbReplica == 2) {

	$this->worksCollection2->insertOne($data);

	}

	if ($dbReplica == 3) {

	$this->worksCollection3->insertOne($data);

	}

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
Файл: Model.php
