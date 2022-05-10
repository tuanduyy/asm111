<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
/**
     * @Route("/student", name="student_index")
     */
    public function studentIndex() {
        $students = $this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render(
            'student/index.html.twig',
            [
                'students' => $students
            ]
        );
    }
    /**
     * @Route("/student/detail/{id}", name="student_detail")
     */
    public function studentDetail($id) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student == null) {
            $this->addFlash('Error', 'Student is not existed');
            return $this->redirectToRoute('student_index');
        }
        else{ //$student != null
            return $this->render(
                'student/detail.html.twig',
                [
                    'student' => $student
                ]
            );
        }
    }
    /**
     * @Route("/student/delete/{id}", name="student_delete")
     */
    public function studentDelete($id) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if($student == null) {
            $this->addFlash('Error', 'Student is not existed');
        }
        else {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($student);
            $manager->flush();
            $this->addFlash('Success','Student has been deleted successfully');
            
        }
        return $this->redirectToRoute('student_index');
    }
    /**
     * @Route("/student/add", name="student_add")
     */
    public function studentAdd(Request $request) {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash("Success", "Add new teacher successfully");
            return $this ->redirectToRoute('student_index');
        }
        return $this->render
        ("student/add.html.twig",
        [  
            "form"=>$form->createView()
        ]
        );
    }   
    /**
     * @Route("/student/edit/{id}", name="student_edit")
     */
    public function studentEdit(Request $request, $id) {
        $student = $this->getDoctrine()->getRepository(Student ::class)->find($id);
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($student);
            $manager->flush();

            $this->addFlash("Success", "Edit student successfully");
            return $this ->redirectToRoute('student_index');
        }
        return $this->render
        ("student/edit.html.twig",
        [  
            "form"=>$form->createView()
        ]
        );
    }
    /**sap xep */
    /**
     * @Route("/student/asc", name="asc")
     */
    public function sortAsc(StudentRepository $studentRepository) {
        $students = $studentRepository->sortStudentAsc();
        return $this->render("student/index.html.twig",
                             [
                                 'students' => $students,
                                 
                             ]);
    }
 
    /**
     * @Route("/student/desc", name="desc")
     */
    public function sortDesc(StudentRepository $studentRepository) {
        $students = $studentRepository->sortStudentDesc();
        return $this->render("student/index.html.twig",
                             [
                                 'students' => $students,
                                 
                             ]);
    }
 
    /**
     * @Route("/search", name="search")
     */
    public function search (Request $request, StudentRepository $studentRepository, ManagerRegistry $registry) {
        $keyword = $request->get('name');
        $students = $studentRepository->search($keyword);
        return $this->render("student/index.html.twig",
                             [
                                 'students' => $students,
                                 
                             ]);
    }
}
