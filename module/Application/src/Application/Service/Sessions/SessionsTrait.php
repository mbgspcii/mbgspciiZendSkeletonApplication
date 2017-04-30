<?php

namespace Application\Service\Sessions;


use Application\Model\MyApplicationModel;
use Zend\Session\Container;


/**
 * Class SessionsTrait
 * @package Application\Service\Sessions
 */
trait SessionsTrait
{


    /**
     * @return MyApplicationModel
     */
    public function retreiveModel()
    {
        $model = $this->getContainer()->model;
        if ($model == null) {

            $this->getLogger()->debug(sprintf("Demande de modèle"));

            $model = $this->initModel();
        }

        return $model;
    }

    /**
     *
     */
    public function resetModel()
    {
        $this->getLogger()->debug("Demande de reset du modèle");
        $this->storeModel(null);
    }

    /**
     * @return MyApplicationModel
     */
    private function initModel()
    {
        $model = new MyApplicationModel();

        return $model;
    }




    /**
     *
     * Stocke le modele dans la session
     * @param $model
     */
    public function storeModel($model)
    {
        $container = $this->getContainer();
        $container->model = $model;
    }

    /**
     * Le container qui maintient le modèle en session
     * @return Container
     */
    private function getContainer()
    {
        $container = new Container("myApplicationContainer");
        return $container;
    }




}
