<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Service\Logic\ServiceLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class DeleteServicesAction
 * @package App\Domains\Service\Actions
 */
class DeleteServiceAction
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
	 * @param $id
	 * @return JsonResponse
	 */
	public function handle(Request $request, $id): JsonResponse
	{
		try{
			$this->serviceLogic->deleteService(intval($id));
			$response = response()->json("Serviço deletado", 200);
		}catch(Exception $e){
			$response = response()->json($e->getMessage(), 500);
		}

		return $response;
	}
}