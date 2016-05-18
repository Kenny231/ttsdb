<div class = "container">
	<div class="wrapper">
		<form
			method="post"
			name="LoginForm"
			class="form-signin",
			ng-submit="LoginForm.$valid && login()"
		>
			<h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
			<span ng-show="login_error">{{login_error}}</span>
			<hr class="colorgraph"><br>

			<input
				type="text"
				class="form-control"
				ng-model="username"
				placeholder="Username"
				required
			/>
			<input
				type="password"
				class="form-control"
				ng-model="password"
				placeholder="Password"
				required=""
			/>

			<button
				class="btn btn-lg btn-primary btn-block"
				type="submit">Login
			</button>
		</form>
	</div>
</div>
