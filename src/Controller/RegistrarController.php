<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class RegistrarController extends AbstractController
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }

    /**
     * @Route("/registrar", name="registrar")
     */
    public function index(Request $request)
    {
        $user = new user();

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('codigo', TextType::class, array('mapped' => false))
            ->add('sys_val',choiceType ::class, array('choices' => array('Ingenieria de Sistemas'=>1,
                                                                  'Ingenieria Industrial'=> 2),'placeholder'=>'Seleccione su carrera'))
            ->add('password',PasswordType ::class)
            ->add('roles',PasswordType ::class)
            ->add('email', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $clave=$user->getPassword();
            $clave2=$user->getRolesString();
            $carrera=$user->getSysVal();
            $codigo=$form->get('codigo')->getData();

            if($clave==$clave2){
                $entityManager = $this->getDoctrine()->getManager();
                $user->setPassword($this->encoder->encodePassword($user, $clave));
                $user->setRoles('ROLE_USER');
                $user->setSysTime(new \DateTime());
                $user->setSysVal(1);
                $entityManager->persist($user);
                $entityManager->flush();

                $id= $user->getId();

                $em = $this->getDoctrine()->getEntityManager();
                $id_user = $em->getRepository(User::class)->findOneBy(['id' =>  $id ] );

                echo "<h1 style='color:red'>$codigo</h1>";

                $alumno = new alumno();
                $manager = $this->getDoctrine()->getManager();
                $alumno->setCodigo($codigo);
                $alumno->setIdCarrera($carrera);
                $alumno->setIdUsuario($id_user);
                $manager->persist($alumno);
                $manager->flush();

                return $this->redirectToRoute('login');
            }else{
//
                $this->addFlash(
                    'notice',
                    'Contraseñas no coinciden '
                );
            }
        }

        return $this->render('registrar/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/nuevoAlumno/$codigo/$carrera/$correo", name="crearAlumno")
     */
    public function crearAlumno(Request $request,$codigo){
        $codigo=$_POST['codigo'];
        $carrera=$_POST["carrera"];
        $correo=$_POST["correo"];

        $em = $this->getDoctrine()->getEntityManager();
        $id_user = $em->getRepository(User::class)->findOneBy(['email' =>  $correo ] );

        $alumno = new alumno();
        $manager = $this->getDoctrine()->getManager();
        $alumno->setCodigo($codigo);
        $alumno->setIdCarrera($carrera);
        $alumno->setIdUsuario($id_user);
        $manager->persist($alumno);
        $manager->flush();

        return new Response('Respuesta simple!');
    }
}
