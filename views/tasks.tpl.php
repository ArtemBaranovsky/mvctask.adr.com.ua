<!DOCTYPE html>
<html lang="ru">
	
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php echo $pageData['title']; ?></title>
		
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
		
		<link href="/css/admin/metisMenu.min.css" rel="stylesheet">
		
		<link href="/css/admin/sb-admin-2.css" rel="stylesheet">
		
		<link href="/css/admin/morris.css" rel="stylesheet">
		
		<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<link href="/css/style.css" rel="stylesheet">
		
		<script src="/js/jquery.js"></script>
		
		
	</head>
	
	<body>
		
		<div id="wrapper">
			
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/tasks">Сайт - задачник</a>
				</div>
				<!-- /.navbar-header -->
				
				<ul class="nav navbar-top-links navbar-right">
					
					<?php if ($_SESSION['user']) { ?>
						<a href="/index/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
						<? } else { ?>
						<a href="/index/login"><i class="fa fa-sign-in fa-fw"></i> Войти</a>
					<? } ?>
				</ul>
				<!-- /.navbar-top-links -->
				
				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">

							<li>
								<a href="/tasks/"><i class="fa fa-tasks"></i> Задачи</a>
							</li>
							<li>
								<a href="/tasks/add"><i class="fa fa-plus"></i> Добавить задачи</a>
							</li>
						</ul>
					</div>
					<!-- /.sidebar-collapse -->
				</div>
				<!-- /.navbar-static-side -->
			</nav>
			
			<div id="page-wrapper">
				<div class="row">

				</div>
				
			<?php if (!strpos($_SERVER["REQUEST_URI"], 'add')) { ?>
				<!-- /.row -->
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-tasks fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php echo $pageData['tasksCount']; ?>
										</div>
										<div>Задач</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-square fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php echo $pageData['solvedTasksCount']; ?>
										</div>
										<div>Решенных задач</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-user-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<?php echo $pageData['usersCount']; ?>
										</div>
										<div>Пользователей</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>	
				
				<!-- /.row -->
				<?php if ($pageData) { ?>
					<?php if (!strpos($_SERVER["REQUEST_URI"], 'add')) { ?>
						<form action="tasks/update" method="post">
							<div class="row">
								<div class="col-lg-12">
									<!-- /.panel -->
									<div class="panel panel-default">
										<div class="panel-heading">
											<i class="fa fa-bar-chart-o fa-fw"></i> Таблица задач
										</div>
										<!-- /.panel-heading -->
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12">
													<div class="table-responsive">
														<table class="table table-bordered table-hover table-striped">
															<thead>
																<tr>
																	<th>ID задачи</th>
																	<? $queryAttrs['sort'] = 'username'; ?>															
																	<? $queryAttrs['asc'] = (empty($_GET['asc'])) ? 'ASC' : 
																		( ($_GET['asc'] == 'ASC') ? 'DESC' : 'ASC' ); ?>
																	<? $params = http_build_query($queryAttrs,0, '&');	?>
																	<th><a href="<?="?{$params}"?>" >Имя пользователя</th>
																	
																	<? $queryAttrs['sort'] = 'email'; ?>
																	<? $queryAttrs['asc'] = (empty($_GET['asc'])) ? 'ASC' : 
																		( ($_GET['asc'] == 'ASC') ? 'DESC' : 'ASC' );	 ?>																
																	<? $params = http_build_query($queryAttrs); ?>
																	<th><a href="<? echo "?{$params}" ?>">е-mail</th>
																	<th>Текст задачи</th>
																	<th>Изображение к задаче</th>
																	
																	<? $queryAttrs['sort'] = 'status'; ?>
																	<? $queryAttrs['asc'] = (empty($_GET['asc'])) ? 'ASC' : 
																		( ($_GET['asc'] == 'ASC') ? 'DESC' : 'ASC' ); ?>
																	<? $params = http_build_query($queryAttrs); ?>
																	<th><a href="<? echo "?{$params}" ?>">Статус</th>
																</tr>
															</thead>
															<tbody>
																		

																			<?php
																				$domain = array_reverse(explode('/',$_SERVER['DOCUMENT_ROOT']))[0];
																				
																				foreach ($pageData['tasks'] as $key => $value) {
																					echo "<tr>";
																					echo "<td>" . $value['id'] . "</td>";
																					echo "<td>" . $value['username'] . "</td>";
																					echo "<td>" . $value['email'] . "</td>";
																					echo "<td>" ; 
																					if ($_SESSION['user']) {  ?>
																					<textarea name="task_<?php echo $value['id']?>" rows="10" cols="60"><?php echo $value['task'] ?></textarea></td><?
																				}
																				else { echo $value['task'];
																					
																				} ?>
																		</td>
																		<? echo "<td>" ?><a href="<?='http://'.$domain.'\\images\\' . $value['image'] ?>" ><img src="<?='http://'.$domain.'\\images\\' . $value['image'] ?>" style="width:100px" alt=''></a><?="</td>";
																			echo "<td>"; 
																			if ($_SESSION['user'])
																			{ 
																			?> 
																			Статус:<br>
																			<input type="radio" name="status_<?=$value['id']?>" <?php if (isset($value['status']) && $value['status']=="undefined") echo "checked";?> value="undefined">Undefined<br>
																			<input type="radio" name="status_<?=$value['id']?>" <?php if (isset($value['status']) && $value['status']=="executing") echo "checked";?> value="executing">Executing<br>
																		<input type="radio" name="status_<?=$value['id']?>" <?php if (isset($value['status']) && $value['status']=="solved") echo "checked";?> value="solved">Solved</td>
																	<? } else echo $value['status'] ?></td> 
																	<? echo "<tr>";
																	}
																	
															?>
														</tbody>
													</table>
												</div>
												<!-- /.table-responsive -->
											</div>
											<!-- /.col-lg-4 (nested) -->
											
											<div class="mypagination" >
												Перейти на страницу
												<? $page=$pageData['offset']; ?>
												
												<? while ($page++ < $pageData['num_pages']): ?>
												<? $queryAttrs['page'] = $page; ?>
												<? $queryAttrs['sort'] = $_GET['sort']; ?>
												<? $queryAttrs['asc'] = $_GET['asc']; ?>
												

												<? $params = http_build_query($queryAttrs); ?>
												<th><a href="<? echo "?{$params}" ?>" 
													<? if ($page == $_GET['page'] || ($_GET['page']==0 && $page == 1) ) { 
														echo "style='color: red'"; 
													   }?> ><?=$page?>
												</th>	
												<? endwhile ?> 
												</div>
												
												<!-- /.col-lg-8 (nested) -->
											</div>
											<?php if ($_SESSION['user']) { ?>
											<div class="col-sm-offset-10 col-sm-10">
												<button type="submit" class="btn btn-success ">Изменить</button>
											</div>
											<? } ?>
										</form>
										
										<!-- /.row -->
									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
								<!-- /.panel -->
							</div>
							<!-- /.col-lg-8 -->
						</div>
						<?php } else {  ?>
						
							<form id="addimage" action="add" method="post" enctype="multipart/form-data">
							<h3>Форма добавления задачи</h3>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="name" class="h4">Имя пользователя</label>
									<input type="text" class="form-control" name="name" placeholder="Введите ваше имя" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="email" class="h4">Email</label>
									<input type="email" class="form-control" name="email" placeholder="Введите ваш  email" required>
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="h4 ">Задача</label>
								<textarea name="task" class="form-control" rows="12" placeholder="Введите вашу задачу" required></textarea>
							</div>
							
							<div class="container">
								<div class="row">	
								<label class="uploadbutton">
									<!--<label>Загрузить изображение:</label>-->
									<div class="button" >Выбрать изображение</div>
									
									<input type="file" id="files" name="files[]" data-url="images/" multiple onchange="this.previousSibling.previousSibling.innerHTML = this.value" />
								</label>
								</div>
								<div class="row">
									<span id="output"></span>
								</div>
							</div>
							<div class="col-xs-12  col-sm-6 col-md-offset-2 col-md-10">
								<button type="submit" id="form-submit" target="hiddenframe" class=" btn btn-success btn pull-right " style="float: none">Отправить</button>
							</div>
							<div id="msgSubmit" class="h3 text-center hidden">Задача отправлена!</div>
						</form>
						
						
							<img id="uploadedImage" src="#" style="display: none; width:0" align="left" class="thumb" />
							<div class="col-xs-12  col-sm-6 col-md-offset-2 col-md-10">
								<button type="submit" id="preview" name="preview" class="btn btn-success btn pull-right" style="float: none">Отобразить загруженное изображение</button>
							</div>
							  <div id="myModal" class="modal">
								<div class="modal-content">
									<span class="close">&times;</span>
									  <div class="modal-header">
										<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
										<h4 class="modal-title" id="mLabel">Предварительный просмотр</h4>
									  </div>
									  <div class="modal-body">
										<div id="outputModal"></div>
									  </div>
									  <div class="modal-footer">
										<!--<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>-->
									  </div>
								</div>
							  </div>
							

							  <div class="col-xs-12  col-sm-6 col-md-offset-2 col-md-10">
								<input type="button" class="btn btn-success btn pull-right" name="previewButton" id="previewButton" value='Предварительный просмотр задачи' data-toggle="modal" data-target="#Preview" style="float: none" >
							  </div>
						<script>
							function handleFileSelect(evt) {
								var file = evt.target.files; // FileList object
								
										var f = file[0];
										// Only process image files.
										if (!f.type.match('image.*')) {
											alert("Image only please....");
										}
										var reader = new FileReader();
										// Closure to capture the file information.
										reader.onload = (function(theFile) {
											return function(e) {
												// Render thumbnail.

												$('#uploadedImage').attr('src', e.target.result);
											};
										})(f);
										// Read in the image file as a data URL.
										reader.readAsDataURL(f); 
									}

							document.getElementById('files').addEventListener('change', handleFileSelect, false);	
							el = document.getElementById("preview");
							el.addEventListener("click", function(){$('#uploadedImage').attr('style', "width:200px" );});
							
							
							var modal = document.getElementById("myModal");
							var btn = document.getElementById("previewButton");
							var span = document.getElementsByClassName("close")[0];
							
							btn.onclick = function() {
								modal.style.display = "block";									
							}							

							span.onclick = function() {
								modal.style.display = "none";									
							}							
							window.onclick = function(event) {
								if (event.target == modal)
								modal.style.display = "none";									
							}
							
							
							
							// modal window invocation
							$(document).ready(function() {
							  $("#previewButton").click(function() {	
								var formName  = $('input[name="name"]').val();	
								var formEmail = $('input[name="email"]').val();
								var formImage = $('#uploadedImage').attr('src');
								var formTask  = $('textarea[name="task"]').val();  		
							   
								$.post('/ajax/modal_preview.tpl.php',
									
									   {formName:formName,formEmail:formEmail,formImage:formImage,formTask:formTask},
									   function(data){
										 $("#outputModal").html(data);
									   }
									  );
							  });
							});
								
							</script>

						<?php } ?>
					<?php } ?>
					<!-- /.row -->
				</div>
				<!-- /#page-wrapper -->
			</div>
			<!-- /#wrapper -->
			

			
			<script src="/js/bootstrap.min.js"></script>
			
			<script src="/js/admin/metisMenu.js"></script>
			
			<script src="/js/admin/sb-admin-2.js"></script>
			
		</body>
		