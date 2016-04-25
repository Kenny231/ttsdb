<?php

class ClassLoader
{
	private $app;

	public function __construct($app) {
		$this->app = $app;
	}

	/*
	 * Routers
	 */
	public function RegisterRouters() {
		new Account\Backend\Config\AccountRouter($this->app);
	}

	/*
	 * Middleware
	 */
	public function RegisterMiddleware() {
		new Resources\Backend\Middleware\ResourceMiddleware($this->app);
	}

	/*
	 * Dependency Injection
	 */
	public function RegisterDependencyInjection() {
		new Resources\Backend\DependencyInjection\ResourceDI($this->app);
		new Account\Backend\DependencyInjection\AccountDI($this->app);
	}
}

?>
