# NOSQL 7-8 ПЗ

На стороне клиента **всегда** присутсвует выпадающий список для выбора БД с которой нужно работать.
![enter image description here](https://raw.githubusercontent.com/natalusha/NOSQL/master/%D0%A1%D0%BD%D0%B8%D0%BC%D0%BE%D0%BA.PNG)

На стороне сервера мы в каждом запросе получаем  параметр $_GET массива с указанной БД. Эта переменная передается каждый раз вы выполнении запросов.

**$db = $_GET['selectDB']**

    public  function  index()

	{

	$allWorksWithRelations = $this->works->getAll($db = $_GET['selectDB']);

	  

	$this->view->render('Works',['allInfo' => $allWorksWithRelations]);

	}

	  

	public  function  insertWork()

	{

	$this->works->create(

	[$_POST['workName'], $_POST['workCreationYear']],

	[$_POST['firstName'], $_POST['secondName'], $_POST['penName'], $_POST['birthDate'], $_POST['deathDate']],

	[$_POST['genre']],

	[$_POST['countryName'], $_POST['cityName']], $db = $_GET['selectDB']);

	  

	header('location: /');

	}

И так далее в каждом запросе. *Файл: WorkController.php*

После контроллера данные оправляются в модель, где уже в каждом DAO методе выполняется проверка: 

    public  function  getAll()

	{

		if($db = 'mongo') {

			return  $this->worksCollection->find();

		}

		else {

			return  $this->getAllWithRelations();

		}

	}
Файл: Model.php
