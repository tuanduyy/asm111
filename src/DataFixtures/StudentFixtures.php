<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<20;$i++){
            $student = new Student();
            $student->setName("Student $i");
            $student->setAge(20);
            $student->setBirthplace("Ha Noi");
            $student->setCode("Student ID $i");
            $student->setGmail("student@gmail.com");
            $student->setImage("https://static.remove.bg/remove-bg-web/a8b5118d623a6b3f4b7813a78c686de384352145/assets/start_remove-c851bdf8d3127a24e2d137a55b1b427378cd17385b01aec6e59d5d4b5f39d2ec.png");
            $manager->persist($student);
        }

        $manager->flush();
    }
}
