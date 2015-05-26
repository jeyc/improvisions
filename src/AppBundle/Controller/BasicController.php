<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 26/05/2015
 * Time: 12:52
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BasicController extends Controller {

    /**
     * Get doctrine entity manager
     *
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    protected function getEM()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Get repository for entity
     *
     * @param $entityShortName
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepo($entityShortName) {
        return $this->getEM()->getRepository($entityShortName);
    }

}
