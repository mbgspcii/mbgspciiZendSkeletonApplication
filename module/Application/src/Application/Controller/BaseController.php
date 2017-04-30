<?php

namespace Application\Controller;


use Application\Service\ServiceProviderTrait;
use Application\Utils\Utils;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class BaseController extends AbstractActionController
{
    use ServiceProviderTrait;

    /**
     * @var  Request
     */
    protected $request;


    /** Initialise le layout de l'application (header, footer, etc.). */
    protected function initLayout()
    {
        // Version de l'application
        $version = Utils::getValueWithDefault('version', $this->getConfigService(), null);
        $this->layout()->setVariable('layout_version', $version);



    }


    /** {@inheritdoc} */
    public function onDispatch(MvcEvent $e)
    {
        parent::onDispatch($e);
        $this->initLayout();

    }










    protected function getLoggerArray()
    {
        return array(
            'class' => __CLASS__,
            'ligne' => __LINE__,
            'methode' => __METHOD__
        );
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return parent::getRequest();
    }







}
