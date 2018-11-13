<?php
	
	class TasksController extends Controller {
		
		private $pageTpl = "/views/tasks.tpl.php";
		
		
		public function __construct() {
			$this->model = new TasksModel();
			$this->view = new View();
		}
		
		public function index() {
			
			$this->model->per_page = 3;		// tasks layout limit per page
			
			$this->pageData['title'] = "Задачи";
			
			$tasksCount = $this->model->getTasksCount();
			$this->pageData['tasksCount'] = $tasksCount;
			
			$solvedTasksCount = $this->model->getSolvedTasksCount();
			$this->pageData['solvedTasksCount'] = $solvedTasksCount;
			
			$tasks = $this->model->getTasks($_GET['sort'], explode('?', $_GET['asc'])[0]);
			$this->pageData['tasks'] = $tasks;
			
			$usersCount = $this->model->getUsersCount();
			$this->pageData['usersCount'] = $usersCount;
			
			$this->view->num_pages=ceil($tasksCount/$this->model->per_page);
			$this->pageData['num_pages'] = $this->view->num_pages;
			$this->pageData['per_page'] = $this->model->per_page;
			
			$queryAttrs = [
				'page' => (($_GET['page'])) ? $_GET['page'] : '1',
				// 'sort' => "username",
				'asc' => (empty($_GET['asc'])) ? 'ASC' : 
							( ($_GET['asc'] == 'ASC') ? 'DESC' : 'ASC' ) 
			];
			
			$this->view->render($this->pageTpl, $this->pageData);
		}
		
	    public function add() {
			
			$this->pageData['title'] = "Добавить задачу";
			
			if ($_POST['name']) {
				$uploaddir = $_SERVER['DOCUMENT_ROOT']. '/images/';
				$uploadfile = $uploaddir .iconv('utf-8', 'cp1251',$_FILES['files']['name'][0]);

				list($width, $height) = getimagesize($_FILES['files']['tmp_name'][0]);
				$sourceFile = $_FILES['files']['tmp_name'][0];
				$imageFileType = explode('/', $_FILES['files']['type'][0])[1];
				
				// получение новых размеров
				list($width, $height) = getimagesize($sourceFile);
				$percent = min(320/$width,240/$height);
				$new_width = (int)floor($width * $percent);
				$new_height = (int)floor($height * $percent);
				
				// resempling
				$image_p = imagecreatetruecolor($new_width, $new_height);
				
				switch ($imageFileType) {
						case 'jpg' : ;
						case 'jpeg' : 
							$image = imagecreatefromjpeg($sourceFile);
							break;
						case 'png' : 
							$image = imagecreatefrompng($sourceFile);
							break;
						case 'gif' :
							$image = imagecreatefromgif($sourceFile);
							break;
				}
				
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				
				// output
				
				switch ($imageFileType) {
						case 'jpg' : ;
						case 'jpeg' : 
							imagejpeg($image_p, $sourceFile, 100);
							break;
						case 'png' : 
							imagepng($image_p, $sourceFile, 9);
							break;
						case 'gif' :
							imagegif($image_p, $sourceFile, 100);
							break;
				}
				
				if (move_uploaded_file($sourceFile, $uploadfile)) {
					echo "Файл {$_FILES['files']['name'][0]} корректен и был успешно загружен.<br>";
					} else {
					echo "Ошибка загрузки!.<br>";
				} 
				
				$this->model->sendToDB(); 
				
			} 
			$this->view->render($this->pageTpl, $this->pageData);
			
			
		}
		
	    public function update() {		
			
			$this->model->updateDB(); 	
			
			$pageTpl = "/views/tasks.tpl.php";
			
			// header("Location: /");
			$this->view->render($this->pageTpl, $this->pageData);
			
		}
		
		public function logout() {
			session_destroy();
			header("Location: /");
		}
	}
