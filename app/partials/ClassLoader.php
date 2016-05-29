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
    //new Account\Backend\Config\AccountRouter($this->app);
    new Toernooi\Backend\Config\ToernooiRoute($this->app);
    new Login\Backend\Config\LoginRouter($this->app);
    new Inschrijfadres\Backend\Config\InschrijfadresRoute($this->app);
    new Wedstrijd\Backend\Config\WedstrijdRoute($this->app);
    new Registratie\Backend\Config\RegistratieRoute($this->app);
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
    new Toernooi\Backend\DependencyInjection\ToernooiDI($this->app);
    new Resources\Backend\DependencyInjection\ResourceDI($this->app);
    new Login\Backend\DependencyInjection\LoginDI($this->app);
    new Inschrijfadres\Backend\DependencyInjection\InschrijfadresDI($this->app);
    new wedstrijd\Backend\DependencyInjection\WedstrijdDI($this->app);
    new Registratie\Backend\DependencyInjection\RegistratieDI($this->app);
    //new Account\Backend\DependencyInjection\AccountDI($this->app);

  }
}

?>
