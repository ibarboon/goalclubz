<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
		<style type="text/css">
			body { background-color: #222; margin-top: 13%; }
		</style>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript">
			$(function(){
// 				if ($('[name=input-signin-status]').val() == 'failed') {
// 					var alertMsg = '<div class="alert alert-danger"><strong>Error!</strong> The username or password you entered is incorrect.</div>';
// 					$(alertMsg).prependTo('#alert-panel').hide().slideDown('fast', function(){
// 						$('#alert-panel').find('div').not(':first').slideUp('fast');
// 					});
// 				}

				$('input:text:first').focus();

// 				$('body').on('submit', 'form', function(){
// 					var validate = true;
// 					$('form :text, :password').each(function(){
// 						if($(this).val() == '' || $(this).val() == null){
// 							var alertMsg = '<div class="alert alert-warning"><strong>Warning!</strong> Please enter your ' + $(this).attr('placeholder').toLowerCase() + '.</div>';
// 							$(alertMsg).prependTo('#alert-panel').hide().slideDown('fast', function(){
// 								$('#alert-panel').find('div').not(':first').slideUp('fast');
// 							});
// 							$(this).focus();
// 							validate = false;
// 							return validate;
// 						}
// 					});
// 					return validate;
// 				});
			});
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Sign In</h3>
						</div>
						<div class="panel-body">
							<?php echo validation_errors('<div class="alert alert-warning" role="alert"><strong>Warning!</strong> ', '</div>'); ?>
							<?php echo ((bool)$error_message)? $error_message: NULL; ?>
							<form role="form" method="post" accept-charset="utf-8" action="<?php echo site_url('admin/signin'); ?>">
								<div class="form-group">
									<label for="input-username">Username :</label>
									<input type="text" class="form-control" name="input-username" id="input-username" placeholder="your username">
								</div>
								<div class="form-group">
									<label for="input-password">Password :</label>
									<input type="password" class="form-control" name="input-password" id="input-password" placeholder="your password">
								</div>
								<p class="text-right">
									<input type="submit" class="btn btn-primary" name="input-signin" value="Sign In">
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>