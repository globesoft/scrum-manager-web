<?php

namespace GlobeSoft\ScrumManagerWebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller {

    public function indexAction() {
        return new Response('Heyo');
    }
}