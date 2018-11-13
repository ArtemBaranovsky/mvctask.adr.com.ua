<?php

class IndexController extends Controller {

	private $pageTpl = '/views/login.tpl.php';


	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}

	public function index() {
		$pageTpl = '/views/tasks.tpl.php';
		$this->pageData['title'] = "Заглавная страница";
		header("Location: ".'/tasks');
		}

	public function login() {
		$pageTpl = "/views/login.tpl.php";
		$this->pageData['title'] = "Вход в личный кабинет";
		if(!empty($_POST)) {
			if(!$this->check()) {
				$this->pageData['error'] = "Неправильный логин или пароль";
			}
		}

		$this->view->render($this->pageTpl, $this->pageData);
	}

	public function check() {
		if(!$this->model->checkUser()) {
			return false;
		}
	}
	
	public function logout() {
			session_destroy();
			header("Location: /");
		}

}