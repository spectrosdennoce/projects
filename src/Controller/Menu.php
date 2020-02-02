<?php
namespace App\Controller;

use App\Entity\Utils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class Menu extends AbstractController
{
    public function index()
    {
        return $this->render('Menu.html.twig');
    }
    public function Login()
    {
        return $this->render('Login.html.twig');
    }
    public function Register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) contruit le formulaire 
        $user = new Utils();
        $form = $this->createForm(UserType::class, $user);

        // 2) submit se produit au "post"
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode le mdp 
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Enregistre le mot de passe 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            // set un "flash" sucess pour l'utilisateur et son inscription

            return $this->redirectToRoute('user_registration');
        }
        return $this->render('Register.html.twig');
    }
    public function Add_Formulaire()
    {
        return $this->render('Add.Formulaire.html.twig');
    }
    public function Read_Formulaire()
    {
        return $this->render('Read.Formulaire.html.twig');
    }
}