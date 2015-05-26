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

    protected function translate($message, $param = array(), $domain = null, $locale = null)
    {
        return $this->get('translator')->trans($message, $param, $domain, $locale);
    }

    /**
     * @param $type
     * @param $message
     */
    protected function flash($type, $message, $param = array(), $domain = null, $locale = null)
    {
        $str = $this->translate($message, $param, $domain, $locale);

        $this->get('session')->getFlashBag()->add(
            $type,
            $str
        );
    }

    /**
     * @param $message
     */
    protected function flashNotice($message, $param = array(), $domain = null, $locale = null)
    {
        $this->flash('notice', $message, $param, $domain, $locale);
    }

    /**
     * @param $message
     */
    protected function flashError($message, $param = array(), $domain = null, $locale = null)
    {
        $this->flash('error', $message, $param, $domain, $locale);
    }

}
