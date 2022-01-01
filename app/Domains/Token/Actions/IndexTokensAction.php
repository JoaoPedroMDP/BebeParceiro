<?php
declare(strict_types=1);

namespace App\Domains\Token\Actions;

use App\Domains\Token\CQRS\IndexTokensQuery;
use App\Domains\Token\Logic\TokenLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexTokensAction
 * @package App\Domains\Token\CQRS
 */
class IndexTokensAction
{
	/**
	 * @var TokenLogic
	 */
	public $tokenLogic;

	/**
	 * @param TokenLogic $tokenLogic
	 */
	public function __construct(TokenLogic $tokenLogic)
	{
		$this->tokenLogic = $tokenLogic;
	}

	/**
	 * @param Request $request
	 * @param string $showAll
	 * @return JsonResponse
	 */
	public function handle(Request $request, string $showAll): JsonResponse
	{
		try{
			$response = $this->tokenLogic->indexTokens(
				IndexTokensQuery::fromArray(
					[
						"showAll" => $showAll == 'showAll'
					]
				),
				$request->user()
			);
		}catch(Exception $e){
			$response = "A requisição não pode ser concluída";
		}

		return response()->json($response);
	}
}