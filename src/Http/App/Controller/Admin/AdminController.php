<?php

namespace App\Http\App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package App\Http\App\Controller\Admin
 * @author Catherine Mani<crescencegracemani@gmail.com>
 */


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index() : Response
    {
        return $this->render("admin/base_admin/base_admin_index.html.twig");
    }

}