<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<20;$i++){
            $teacher = new Teacher();
            $teacher->setName("Teacher $i");
            $teacher->setAge(30);
            $teacher->setBirthplace("Ha Noi");
            $teacher->setGmail("teacher@gmail.com");
            $teacher->setImage("https://static.remove.bg/remove-bg-web/a8b5118d623a6b3f4b7813a78c686de384352145/assets/start_remove-c851bdf8d3127a24e2d137a55b1b427378cd17385b01aec6e59d5d4b5f39d2ec.png");
            $manager->persist($teacher);
        }

        $manager->flush();
    }
}
