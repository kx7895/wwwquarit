<?php

namespace App\Controller\Landing;

use App\Entity\CrmProspect;
use Doctrine\ORM\EntityManagerInterface;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LandingController extends AbstractController
{
    #[Route('/landing', name: 'landing_index')]
    public function index(Request $request, EntityManagerInterface $eM): Response
    {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
            ])
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data  = $form->getData();

            $prospect = new CrmProspect();
            $prospect->setEmail($data['email']);
            $prospect->setSource('landing');

            $eM->persist($prospect);
            $eM->flush();

            $this->addFlash('success', 'Vielen Dank für Ihre Anmeldung.');

            return $this->redirectToRoute('landing_index');
        }

        return $this->render('landing/landing/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** @noinspection PhpUnused */
    #[Route('/landing/ec-e', name: 'landing_quarit_email')]
    public function quarsecEmail(): JsonResponse
    {
        $user = 'info';
        $domain = 'quarit.ch';

        // Generiere ein Salt (randomisiert)
        try {
            $salt = bin2hex(random_bytes(8));
        } catch (RandomException) {
            $salt = md5(rand(10000000, 99999999));
        }

        $emailWithSalt = "$user@$domain" . $salt;

        $encodedEmail = base64_encode($emailWithSalt);

        return new JsonResponse([
            'ec' => $encodedEmail,
            's' => $salt,
        ]);
    }

    /** @noinspection PhpUnused */
    #[Route('/landing/imprint', name: 'landing_imprint')]
    public function imprint(): Response
    {
        return $this->render('landing/landing/imprint.html.twig');
    }

    /** @noinspection PhpUnused */
    #[Route('/landing/privacy', name: 'landing_privacy')]
    public function privacy(): Response
    {
        return $this->render('landing/landing/privacy.html.twig');
    }

}