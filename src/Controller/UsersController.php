<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use DateTimeZone;

/**
* @Route("/users", name="users_")
*/

class UsersController extends AbstractController
{

    /**
     * @Route("/", name="users",  methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getDoctrine()->getRepository(Users::class)->findAll();
        
        $msg = "All users on database";
        return $this->returnDataMsg($msg, $user); 
    }

    /**
    * @Route("/", name="create", methods={"POST"})
    */
    public function create(Request $request)
    {
        $data = $request->request->all();

        try {
            $user = new Users();
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setphone($data['phone']);
            $user->setCreatedAt(new \DateTime('now', new DateTimezone('Europe/Lisbon')));
            $user->setUpdatedAt(new \DateTime('now', new DateTimezone('Europe/Lisbon')));

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();
            
            $msg = "User sucessful created";
        } catch (\Throwable $th) {
            $msg = "Something went wrong: " . $th->getMessage();
        }
                
        return $this->returnDataMsg($msg, $data);
    }

    /**
    * @Route("/{userId}", name="update", methods={"PUT", "PATCH"})
    */
    public function update($userId, Request $request)
    {
        $data = $request->request->all();
        $doctrine = $this->getDoctrine(); 
        
        try {
            $user = $doctrine->getRepository(Users::class)->find($userId);

            if($request->request->has('name'))
                $user->setName($data['name']);

            if($request->request->has('email'))
                $user->setEmail($data['email']);
            
            if($request->request->has('phone'))
                $user->setEmail($data['phone']);
            
            $user->setUpdatedAt(new \DateTime('now', new DateTimezone('Europe/Lisbon')));

            $manager = $doctrine->getManager();
            $manager->flush();            
            $msg = "User sucessful updated";

        } catch (\Throwable $th) {
            $msg = "Something went wrong: " . $th->getMessage();
        }
        
        return $this->returnDataMsg($msg, $data);
    }

    /**
    * @Route("/{userId}", name="delete", methods={"DELETE"})
    */
    public function delete($userId)
    {
        $doctrine = $this->getDoctrine();
        $user = $doctrine->getRepository(Users::class)->find($userId);
        
        $manager = $doctrine->getManager();

        try {
            $manager->remove($user);
            $manager->flush();
            $msg = "User sucessful deleted";

        } catch (\Throwable $th) {
            $msg = "Something went wrong: " . $th->getMessage();
        }      

        return $this->returnDataMsg($msg);
    }

    public function returnDataMsg($msg = null, $data = null)
    {
        if(!$msg)
            $msg = "Something went wrong, please contact support";
        
        if(!$data)
            $data = "No data to show";

        return $this->json([
            'result' => $msg,
            'data sent' => $data,
        ]);

    }
}