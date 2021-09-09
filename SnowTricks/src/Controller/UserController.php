<?php


namespace App\Controller;


use App\Entity\Image;
use App\Entity\User;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/profil", name="user_show", methods={"GET", "POST"})
     */
    public function show( Request $request, UserRepository $userRepository, ImageRepository $imageRepository): Response{
        $user = $this->getUser();
        $user->image = $imageRepository->findOneBy(['id'=>$user->getIdImage()]);


        $image = new Image();

        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $image->setAlt($user->getPseudo()."_image");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();



            $user->setIdImage($image->getId());





            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "L'image a bien été enregistrée");
            return $this->redirect($request->getUri());

        }

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'form_image' => $form->createView(),
        ]);
    }


}