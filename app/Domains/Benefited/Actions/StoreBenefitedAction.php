<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Actions;

use App\Domains\Benefited\CQRS\StoreBenefitedCommand;
use App\Domains\Benefited\Logic\BenefitedLogic;
use App\Domains\Core\Action;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class StoreBenefitedAction
 * @package App\Domains\Benefited\Actions
 */
class StoreBenefitedAction extends Action
{

	/**
	 * @var BenefitedLogic
	 */
	private $benefitedLogic;

	/**
	 * @param BenefitedLogic $benefitedLogic
	 */
	public function __construct(BenefitedLogic $benefitedLogic)
	{
		$this->benefitedLogic = $benefitedLogic;
	}

	/**
	 * @param Request $request
	 * @param string $token
	 * @return JsonResponse
	 */
	public function handle(Request $request, string $token): JsonResponse
	{
		try{
			$params = array_merge(['token' => $token], $request->all());
			$data = $this->benefitedLogic->storeBenefited(StoreBenefitedCommand::fromArray($params));
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 201);
	}
}