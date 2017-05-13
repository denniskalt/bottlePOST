<?php
class Controller{

	private $request = null;
	private $template = '';
	private $view = null;

	/**
	 * Konstruktor, erstellet den Controller.
	 *
	 * @param Array $request Array aus $_GET & $_POST.
	 */
	public function __construct($request){
		$this->view = new View();
		$this->request = $request;
		$this->template = !empty($request['view']) ? $request['view'] : 'default';
	}

	/**
	 * Methode zum Anzeigen des Contents.
	 *
	 * @return String Inhalt der Applikation.
	 */
	public function display() {
		$view = new View();

        switch($this->template) {
			case 'hashtag':
                include('hashtagController.php');
				$view->setTemplate('hashtag');
				$entryid = $this->request['id'];
                $user = new Users();
				break;
            case 'post':
                include('postController.php');
				$view->setTemplate('post');
				$entryid = $this->request['id'];
                $user = new Users();
				break;
            case 'profile':
                include('profileController.php');
                $view->setTemplate('profile');
                $entryid = $this->request['id'];
                $user = new Users();
                break;
            case 'error':
                include('errorController.php');
                $view->setTemplate('error');
                $entryid = $this->request['id'];
                $user = new Users();
                break;

            case 'default':
			default:
                include('defaultController.php');
                $user = new Users();
        }
		$this->view->setTemplate('theblog');
		$this->view->assign('blog_title', 'Der Titel des Blogs');
		$this->view->assign('blog_footer', 'Ein Blog von und mit MVC');
		$this->view->assign('blog_content', $view->loadTemplate());
		return $this->view->loadTemplate();
	}
}
?>
