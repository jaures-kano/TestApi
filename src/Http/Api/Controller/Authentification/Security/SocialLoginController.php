<?php

namespace App\Http\Api\Controller\Authentification\Security;

use App\Infrastructures\Social\AuthService;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("api/authentification")
 */
class SocialLoginController extends AbstractController
{
    private const SCOPES = [
//        'github' => ['user:email'],
        'google' => [],
        'facebook' => ['email'],
    ];

    private $facebookId;

    public function __construct($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @Route("/social/connect/{service}", name="oauth_connect")
     */
    public function connect(string $service): JsonResponse
    {
        $this->ensureServiceAccepted($service);

        $clientLink = 'https://www.facebook.com/v12.0/dialog/oauth?' .
            'client_id=' . $this->facebookId . '&redirect_uri=https://127.0.0.1:8000/api/authentification/social/check/facebook';

        return $this->json([
            'link' => $clientLink
        ]);
    }

    private function ensureServiceAccepted(string $service): void
    {
        if (!in_array($service, array_keys(self::SCOPES))) {
            throw new AccessDeniedException();
        }
    }

    /**
     * @Route("/oauth/unlink/{service}", name="oauth_unlink")
     * @IsGranted("ROLE_USER")
     */
    public function disconnect(string $service, AuthService $authService, EntityManagerInterface $em): RedirectResponse
    {
        $this->ensureServiceAccepted($service);
        $method = 'set' . ucfirst($service) . 'Id';
        $authService->getUser()->$method(null);
        $em->flush();
        $this->addFlash('success', 'Votre compte a bien été dissocié de ' . $service);

        return $this->redirectToRoute('user_edit');
    }

    /**
     * @Route("/social/check/{service}", name="oauth_check")
     */
    public function check(): Response
    {
        return new Response();
    }
}
