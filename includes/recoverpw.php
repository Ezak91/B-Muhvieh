<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
        <div class="logo" align="center">
          <img src="images/navbar_1.png" height="250" width="250"/>
        </div>
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="recover-form-link">New Password</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="recover-form" action="includes/resetpw.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="New password" value="">
                    <input type="hidden" name="userid" value="<?php echo $user_id ?>">
                    <input type="hidden" name="token" value="<?php echo $token ?>">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="recover-submit" id="recover-submit" tabindex="4" class="form-control btn btn-recover" value="Set new password">
											</div>
										</div>
									</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
