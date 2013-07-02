<?php $this->load->view( 'common/meta' ); ?>
<body>
	<style>
		html, body { height: auto; overflow: hidden; }
	</style>
    <?php $this->load->view( 'common/header' ); ?>
    
    <div class="container-fluid login_page" id="maincontent">
        <br/>
        <div class="login_box">
			<form method="post" id="login_form">
				<input type="hidden" name="action" value="login" />
				
				<div class="top_b">Sign in</div>
				<div id="alert" class="alert alert-info alert-login">Enter Email and Password.</div>
    			
				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="email" placeholder="Email" />
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" name="passwd" placeholder="Password" />
						</div>
					</div>
				</div>
				<div class="btm_b clearfix">
					<input type="submit" value="Login" class="btn btn-inverse pull-right" style="margin: 0 10px 0 0;" />
				</div>
			</form>
			
			<form method="post" id="pass_form" class="hide">
				<div class="top_b">Can't sign in?</div>    
					<div class="alert alert-info alert-login">
					Please enter your email address. You will receive a link to create a new password via email.
				</div>
				<div class="cnt_b">
					<div class="formRow clearfix">
						<div class="input-prepend">
							<span class="add-on">@</span><input type="text" placeholder="Your email address" />
						</div>
					</div>
				</div>
				<div class="btm_b tac">
					<button class="btn btn-inverse" type="submit">Request New Password</button>
				</div>  
			</form>
		</div>
		
        <footer class="footer center">
            <p>&copy; <?php echo date("Y"); ?></p>
        </footer>
    </div>
    
	<?php $this->load->view( 'common/js' ); ?>
    <script type="text/javascript">
        $(document).ready(function() {
			setTimeout('$("html").removeClass("js")', 100);
			
			$('#login_form').submit( function() {
				var param = Site.Form.GetValue('login_form');
				Func.ajax({ url: web.base + 'ajax/user', param: param, callback: function(result) {
					if (result.status == 1) {
						window.location.href = web.base;
					} else {
						Func.show_message({ message: result.message });
					}
				} });
				
				return false;
            });
        });
    </script>
  </body>
</html>