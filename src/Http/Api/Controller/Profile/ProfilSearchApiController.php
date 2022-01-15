<?php


namespace App\Http\Api\Controller\Profile;


use App\Domain\AuthDomain\Auth\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Api\Controller\Profil
 */
class ProfilSearchApiController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserRepository $repository
     * @return Response
     * @Route("/profil/search", name="api_profil_search", methods={"POST"})
     */
    public function index(Request $request, UserRepository $repository): Response
    {
        $data = json_decode($request->getContent(), true);

        if($data){
            $user = null;
            if (array_key_exists('email', $data)) {
                $user = $repository->findOneBy(['email' => $data['email']]);
            } elseif (array_key_exists('phone', $data)) {
                $user = $repository->findOneBy(['phone' => $data['phone']]);
            }

            if ($user) {
                return $this->json(['message' => $user], 200, [], ['groups' => 'read:user']);
            }

            return $this->json(['message' => 'user not found'], 404);
        }

        return $this->json(['message' => 'Bad request'], 400);
    }
}