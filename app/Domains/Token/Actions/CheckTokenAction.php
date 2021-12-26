<?php
declare(strict_types=1);

namespace App\Domains\Token\Actions;

use App\Domains\Token\CQRS\CheckTokenQuery;
use App\Domains\Token\Logic\TokenLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CheckTokenAction
 * @package App\Domains\Token\Actions
 */
class CheckTokenAction
{

	/**
	 * @var TokenLogic
	 */
	private $tokenLogic;

	/**
	 * @param TokenLogic $tokenLogic
	 */
	public function __construct(TokenLogic $tokenLogic)
	{
		$this->tokenLogic = $tokenLogic;
	}

	/**
	 * @param Request $request
	 * @param $token
	 * @return JsonResponse
	 */
	public function handle(Request $request, $token): JsonResponse
	{
		try{
			$response = response()->json(
				$this->tokenLogic->checkToken(CheckTokenQuery::fromArray(['token'=>$token]))
			,200);
		}catch(Exception $e){
			$response = response()->json("A requisição não pôde ser concluída", 400);
			dd($e->getMessage());
		}

		return $response;
	}

}