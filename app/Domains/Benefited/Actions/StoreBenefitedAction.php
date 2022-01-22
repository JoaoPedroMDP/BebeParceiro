<?php
declare(strict_types=1);

namespace App\Domains\Benefited\Actions;

use App\Domains\Benefited\CQRS\StoreBenefitedCommand;
use App\Domains\Benefited\Logic\BenefitedLogic;
use Exception;
use Illuminate\Http\Request;

/**
 * Class StoreBenefitedAction
 * @package App\Domains\Benefited\Actions
 */
class StoreBenefitedAction
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
	 * @return void
	 */
	public function handle(Request $request, string $token){
		try{
			$params = array_merge(['token' => $token], $request->all());
			$response = $this->benefitedLogic->storeBenefited(StoreBenefitedCommand::fromArray($params));
		}catch(Exception $e){
			dd($e);
			$response = response()->json($e->getMessage());
		}

		return $response;
	}
}