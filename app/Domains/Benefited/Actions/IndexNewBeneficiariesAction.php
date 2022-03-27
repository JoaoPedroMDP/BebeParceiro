<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Actions;

use App\Domains\Benefited\CQRS\IndexNewBeneficiariesQuery;
use App\Domains\Benefited\Logic\BenefitedLogic;
use App\Domains\Core\Action;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexNewBeneficiariesAction
 * @package App\Domains\Benefited\Actions
 */
class IndexNewBeneficiariesAction extends Action
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
	 * @return JsonResponse
	 */
	public function handle(Request $request): JsonResponse
	{
		try{
			$data = $this->benefitedLogic->indexNewBeneficiaries(IndexNewBeneficiariesQuery::fromArray($request->all()));
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}
}