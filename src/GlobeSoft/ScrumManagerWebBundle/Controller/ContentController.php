<?php

namespace GlobeSoft\ScrumManagerWebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ContentController extends Controller {

    public function homeAction() {
        return $this->render('@GSScrumWeb/Content/home.html.twig');
    }
}