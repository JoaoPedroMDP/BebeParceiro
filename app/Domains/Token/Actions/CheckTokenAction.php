<?php
declare(strict_types=1);

namespace App\Domains\Token\Actions;

use App\Domains\Core\Action;
use App\Domains\Token\CQRS\CheckTokenQuery;
use App\Domains\Token\Logic\TokenLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CheckTokenAction
 * @package App\Domains\Token\Actions
 */
class CheckTokenAction extends Action
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
			$data = $this->tokenLogic->checkToken(CheckTokenQuery::fromArray(['token'=>$token]));
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}

}