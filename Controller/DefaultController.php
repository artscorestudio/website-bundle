<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Controller;

use ASF\CoreBundle\Controller\ASFController;

/**
 * Default Controller gather generic app views
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class DefaultController extends ASFController
{
    /**
     * Website Homepage
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ASFWebsiteBundle:Default:index.html.twig');
    }
}