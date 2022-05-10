<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin_index")
     */
    public function adminIndex() {
        $admins = $this->getDoctrine()->getRepository(Admin::class)->findAll();
        return $this->render(
            'admin/index.html.twig',
            [
                'admins' => $admins
            ]
        );
    }
    /**
     * @Route("/admin/detail/{id}", name="admin_detail")
     */
    public function adminDetail($id) {
        $admin = $this->getDoctrine()->getRepository(ADmin::class)->find($id);
        if ($admin == null) {
            $this->addFlash('Error', 'Admin is not existed');
            return $this->redirectToRoute('admin_index');
        }
        else{ //$course != null
            return $this->render(
                'admin/detail.html.twig',
                [
                    'admin' => $admin
                ]
            );
        }
    }
    /**
     * @Route("/admin/delete/{id}", name="course_delete")
     */
}
