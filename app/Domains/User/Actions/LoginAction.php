<?php
declare(strict_types=1);

namespace App\Domains\User\Actions;

use App\Domains\User\CQRS\AuthenticateUserCommand;
use App\Domains\User\Logic\UserLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LoginAction
 * @package App\Domains\User\Actions
 */
class LoginAction
{
	/**
	 * @var UserLogic
	 */
	private $userLogic;

	/**
	 * @param UserLogic $userLogic
	 */
	public function __construct(UserLogic $userLogic)
	{
		$this->userLogic = $userLogic;
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function handle(Request $request): JsonResponse
	{
		try{
			$response = response()->json([
				'token' => $this->userLogic->authenticateUser(AuthenticateUserCommand::fromArray($request->all()))
			]);
		}catch(Exception $e){
			$response = response()->json("Houve um erro ao completar a requisição Login");
		}

		return $response;
	}
}