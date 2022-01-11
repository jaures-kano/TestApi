<?php

namespace App\Http\Api\Controller\Registration;

use App\Application\Profile\Command\UpdateProfileCommand;
use App\Application\Profile\Dto\ProfileDto;
use App\Domain\Auth\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateProfileApiController
 * @package App\Http\Api\Controller\AuthRegistration
 * @author jaures kano <ruddyjaures@mail.com>
 */
class UpdateProfileApiController extends AbstractController
{

    /**
     * @Route("/registration/complete/info", name="api_registration_profile_update")
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function indexUpdateProfileUser(Request              $request,
                                           UserRepository       $userRepository,
                                           UpdateProfileCommand $command): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $user = $userRepository->findOneBy(['email' => $content['email']]);

        if ($user !== null) {
            if ((float)$content['code'] === $user->getConfirmationCode()) {
                if ($content['password'] === $content['confirmPassword']) {
                    $dto = new ProfileDto($user, $content['firstName'],
                        $content['lastName'],
                        new DateTime($content['birthday']),
                        $content['password']);
                    $response = $command->updatedProfile($dto);
                    return $this->json([
                        'message' => $response->messages
                    ]);
                }
                return $this->json([
                    'message' => 'Password d\'ont match'
                ], 400);
            }
            return $this->json([
                'message' => 'Wrong confirmation code'
            ], 400);
        }

        return $this->json([
            'message' => 'Unknow user'
        ], 400);
    }
}