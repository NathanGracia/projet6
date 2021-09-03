<?php


namespace App\Controller;



use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private  $userRepository;


    /**
     * @Route("/signup", name="signup")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            //test password


               $password = $passwordEncoder->encodePassword($user, $user->getPassword());
               $user->setPassword($password);

               // 4) Send email
               $token = Uuid::uuid4()->toString();
               $user->setToken($token);


               // Create the Transport
               $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, "ssl"))
                   ->setUsername('nathan.gracia.863@gmail.com')
                   ->setPassword('unqdljjregvmadvf');

               // Create the Mailer using your created Transport
               $mailer = new \Swift_Mailer($transport);

               // Create a message
               $message = (new \Swift_Message('Activez votre compte SnowTricks'))
                   ->setFrom('nathan.gracia.863@gmail.com')
                   ->setReplyTo('nathan.gracia.863@gmail.com')
                   ->setTo($user->getEmail())
                   ->setBody($this->render('mail/signin.html.twig', ['token' => $token]),  'text/html');


               // Send the message
               $result = $mailer->send($message);



               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($user);
               $entityManager->flush();
            $this->addFlash('success', "Le mail d'inscription a bien été envoyé au nouvel utilisateur");



            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('home');
        }

        return $this->render(
            'security/signup.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/validateAccount/{token}", name="validateAccount")
     */
    public function validateAccount($token){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['token' => $token]);
        $user->setConfirmed(true);


        $entityManager->flush();
        $this->addFlash('success', 'Votre compte est bien validé. Merci de vous connecter');
        return $this->redirectToRoute('login');
    }
}