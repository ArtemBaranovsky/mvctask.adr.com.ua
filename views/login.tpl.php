<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" id="bootstrap-css">
	<script src="/js/bootstrap.min.js"></script>
</head>
<body>
	
	<header></header>

	<div id="content">

		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<h1 class="text-center login-title">Войти в кабинет</h1>
					<div class="account-wall">
						<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
							alt="">
						<form class="form-signin" id="form-signin" method="post">
							<?php if(!empty($pageData['error'])) :?>
								<p><?php echo $pageData['error']; ?></p>
							<?php endif; ?>
						<input type="text" class="form-control" name="login" id="login" placeholder="Email" required autofocus>
						<input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
						<button class="btn btn-lg btn-primary btn-block" type="submit">
							Войти</button>
						<label class="checkbox pull-left">
							<input type="checkbox" value="remember-me">
							Запомнить меня
						</label>
						<a href="#" class="pull-right need-help">Нужна помощь? </a><span class="clearfix"></span>
						</form>
					</div>
					<a href="#" class="text-center new-account">Создать аккаунт </a>
				</div>
			</div>
		</div>
	</div>

	<footer>
		
	</footer>


</body>
</html>