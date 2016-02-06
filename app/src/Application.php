<?php namespace Ihsw;

use Silex\Application as SilexApplication,
  Silex\Provider\DoctrineServiceProvider;
use Ihsw\HelloControllerProvider,
  Ihsw\Db;

class Application extends SilexApplication
{
  private $db;

  public function loadAll()
  {
    return $this->loadRoutes()->loadDatabase();
  }

  private function loadRoutes()
  {
    $this->mount('/', new HelloControllerProvider());
    return $this;
  }

  private function loadDatabase()
  {
    $this->db = new Db([
      'travis' => [
          'driver' => 'pdo_pgsql',
          'host' => 'localhost',
          'dbname' => 'postgres',
          'user' => 'postgres',
          'password' => ''
        ],
        'local' => [
          'driver' => 'pdo_pgsql',
          'host' => 'db',
          'dbname' => 'postgres',
          'user' => 'postgres',
          'password' => ''
        ]
    ]);
    return $this;
  }

  public function getDb()
  {
    return $this->db;
  }
}
