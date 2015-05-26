<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 25/05/2015
 * Time: 21:42
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends BasicController{

    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction() {
        return $this->render('index.html.twig');
    }

}