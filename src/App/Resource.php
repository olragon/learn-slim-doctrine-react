<?php
namespace App;
use Slim\Slim;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
abstract class Resource
{
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_ACCEPTED = 202;
    const STATUS_NO_CONTENT = 204;
    const STATUS_MULTIPLE_CHOICES = 300;
    const STATUS_MOVED_PERMANENTLY = 301;
    const STATUS_FOUND = 302;
    const STATUS_NOT_MODIFIED = 304;
    const STATUS_USE_PROXY = 305;
    const STATUS_TEMPORARY_REDIRECT = 307;
    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_METHOD_NOT_ALLOWED = 405;
    const STATUS_NOT_ACCEPTED = 406;
    const STATUS_INTERNAL_SERVER_ERROR = 500;
    const STATUS_NOT_IMPLEMENTED = 501;
    /**
     * @var \Slim\Slim
     */
    private $slim;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;
    /**
     * Construct
     */
    public function __construct()
    {
        $this->setSlim(Slim::getInstance());
        $this->setEntityManager();
        $this->init();
    }
    /**
     * Default init, use for overwrite only
     */
    public function init()
    {}

    /**
     * Default get method
     */
    public function get($id)
    {

        if ($id === null) {
            $data = $this->getEntityManager()->getRepository($this->repository)->findAll();
            $response = array($this->entityNamePlural => $data);
        } else {
            $data = $this->getEntityManager()->find($this->repository, $id);
            $response = array($this->entityName => $data);
        }

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        self::response(self::STATUS_OK, $response);
    }

    /**
     * Default post method
     */
    public function post()
    {
        $entity = new $this->repository;
        $params = $this->getSlim()->request()->params();

        foreach ($this->getSlim()->request()->params() as $param => $value) {
            $methodSet = 'set' . ucfirst($param);
            if (method_exists($entity, $methodSet)) {
                $entity->{$methodSet}($value);
            } else {
                $entity->{$param} = $value;
            }
        };

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        $response = array($this->entityName => $entity);

        self::response(self::STATUS_CREATED, $response);
    }

    /**
     * Default put method
     */
    public function put($id = null)
    {
        if (empty($id)) {
            return $this->post();
        }

        $entity = $this->getEntityManager()->find($this->repository, $id);
        $params = $this->getSlim()->request()->params();

        foreach ($this->getSlim()->request()->params() as $param => $value) {
            $methodSet = 'set' . ucfirst($param);
            if (method_exists($entity, $methodSet)) {
                $entity->{$methodSet}($value);
            }
        };

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        self::response(self::STATUS_NO_CONTENT);
    }

    /**
     * Default delete method
     */
    public function delete($id)
    {
        $entity = $this->getEntityManager()->getRepository($this->repository)->find($id);
        if ($entity === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
        self::response(self::STATUS_OK);
    }

    /**
     * General options method
     */
    public function options()
    {
        $this->response(self::STATUS_METHOD_NOT_ALLOWED);
    }
    /**
     * @param int $status
     * @param array $data
     */
    public static function response($status = 200, array $data = array(), $allow = array())
    {
        /**
         * @var \Slim\Slim $slim
         */
        $slim = \Slim\Slim::getInstance();
        $slim->status($status);
        $slim->response()->header('Content-Type', 'application/json');
        if (!empty($data)) {
            $slim->response()->body(json_encode($data));
        }
        if (!empty($allow)) {
            $slim->response()->header('Allow', strtoupper(implode(',', $allow)));
        }
        return;
    }
    /**
     * @param $resource
     * @return mixed
     */
    public static function load($resource)
    {
        $class = __NAMESPACE__ . '\\Resource\\' . ucfirst($resource) . 'Resource';
        if (!class_exists($class)) {
            return null;
        }
        return new $class();
    }
    /**
     * @return \Slim\Slim
     */
    public function getSlim()
    {
        return $this->slim;
    }
    /**
     * @param \Slim\Slim $slim
     */
    public function setSlim($slim)
    {
        $this->slim = $slim;
    }
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    /**
     * Create a entity manager instance
     */
    public function setEntityManager()
    {
        $config = new Configuration();
        $config->setMetadataCacheImpl(new ArrayCache());
        $driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . '/Entity'));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setProxyDir(__DIR__ . '/Entity/Proxy');
        $config->setProxyNamespace('Proxy');
        $appConfig = require_once ROOT_DIR . '/config/config.php';
        $this->entityManager = EntityManager::create($appConfig['db'], $config);
    }
}
?>