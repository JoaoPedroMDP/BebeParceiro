<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Core\Action;
use App\Domains\Service\CQRS\StoreServiceCommand;
use App\Domains\Service\Logic\ServiceLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class StoreServiceAction
 * @package App\Domains\Service\Actions
 */
class StoreServiceAction extends Action
{
	/**
	 * @var ServiceLogic
	 */
	private $serviceLogic;

	public function __construct()
	{
		$this->serviceLogic = new ServiceLogic();
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function handle(Request $request): JsonResponse
	{
		try{
			$data = $this->serviceLogic->storeService(StoreServiceCommand::fromArray($request->all()));
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}
}