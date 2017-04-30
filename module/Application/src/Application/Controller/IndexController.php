<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Service\ServiceProviderTrait;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{

    use ServiceProviderTrait;

    public function indexAction()
    {


        $myBaseService = $this->getBaseService();

        $myBaseService->testLogger();

        $params = array_merge(
            array(

            )
        );

        return new ViewModel(
            $params
        );
    }

    public function resetAction()
    {
        $myBaseService = $this->getBaseService()->resetModel();

        $this->redirect()->toRoute('home');

    }
}
