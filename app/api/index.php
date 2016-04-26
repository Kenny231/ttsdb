<?php

require_once '../libs/slim/vendor/autoload.php';
// Autoload scripts.
spl_autoload_register(function ($name) {
	require $_SERVER['DOCUMENT_ROOT'] . "ttsdb/app/partials/" . $name . ".php";
});

class App extends \Slim\App
{
	private $app;

	public function __construct() {
		$this->app = new \Slim\App(new \Slim\Container());

		// Get 'ClassLoader'
		$class_loader = new ClassLoader($this->app);

		// Setup
		$this->setupDependencies($class_loader);
		$this->setupMiddleware($class_loader);
		$this->setupRoutes($class_loader);

		// Run
		$this->app->run();
	}

	private function setupDependencies($class_loader) {
		$class_loader->RegisterDependencyInjection();
	}

	private function setupMiddleware($class_loader) {
		$class_loader->RegisterMiddleware();
	}

	private function setupRoutes($class_loader) {
		$class_loader->RegisterRouters();
	}
}

$app = new App();

?>
