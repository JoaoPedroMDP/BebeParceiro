<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Core\Action;
use App\Domains\Service\Logic\ServiceLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexServicesAction
 * @package App\Domains\Service\Actions
 */
class IndexServicesAction extends Action
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
			$data = $this->serviceLogic->indexServices();
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}
}