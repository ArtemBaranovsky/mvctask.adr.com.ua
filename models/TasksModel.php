<?php
	
	class TasksModel extends Model {
		
		// public $this->offset;
		
		public function getTasksCount() {
			$sql = "SELECT COUNT(*) FROM tasks";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetchColumn();
			return $res;
		}
		
		public function getSolvedTasksCount() {
			$sql = "SELECT COUNT(*) FROM tasks WHERE `status` = 'solved'";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetchColumn();
			return $res;
		}
		
		public function getTasks($sort, $asc) {
			if ($this->getTasksCount()>0) {
				$sql = "SELECT
				task_id as id,
				username,
				email,
				task,
				image,
				status
				FROM tasks ";
				$sql.= !empty($sort) ? " ORDER BY {$sort} ".(isset($asc) ? $asc : 'ASC') : '';
				$sql.=  " LIMIT :offset, :perpage";
				$result = [];
				$stmt = $this->db->prepare($sql);
				$this->view->num_pages;
				$page = empty($_GET['page']) ? 1 : $_GET['page'];
				$this->offset = (int)(abs(($page-1)*$this->per_page));
				$stmt->bindValue(":offset", $this->offset, PDO::PARAM_INT);
				$stmt->bindValue(":perpage", $this->per_page, PDO::PARAM_INT);
				$stmt->execute();

				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$result[$row['id']] = $row;
				}
				} else {
				$result = '';
			}
			return $result;
		}
		
		public function getUsersCount() {
			$sql = "SELECT COUNT(DISTINCT username) FROM tasks";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetchColumn();
			return $res;
		}
		
		public function sendToDB() {
			if (!empty($_POST['name'])) {
				try {
					// prepare sql and bind parameters
					$stmt = $this->db->prepare("INSERT INTO tasks (username, email, task, image)
					VALUES (:username, :email, :task, :image)");
					$stmt->bindParam(':username', trim($_POST['name']));
					$stmt->bindParam(':email', trim($_POST['email']));
					$stmt->bindParam(':task', trim($_POST['task']));
					$stmt->bindParam(':image', trim($_FILES['files']['name'][0]));
					$stmt->execute();
					echo "Новые записи успешно созданы!";
					} catch (PDOException $e){
					echo "Error: " . $e->getMessage();
				}
				$conn = null;
			}
		}
		
		public function updateDB() {
			if (empty($_POST['name']))  {
				try {
					foreach ($_POST as $post => $value) {
						// the list of allowed field names
						list($upd, $id) = explode('_' , $post);
						$txt = $value;
						// prepare sql and bind parameters
						$stmt = $this->db->prepare("UPDATE tasks SET `{$upd}` = '$txt' WHERE `task_id` = {$id}");
						$stmt->execute([$upd => $txt]);
						} 
					} catch (PDOException $e){
						echo "Error: " . $e->getMessage();
					$conn = null;
				}
				echo "Данные успешно обновлены!<br>";
			}
		}	
		
	}		