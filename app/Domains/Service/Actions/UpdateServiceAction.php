<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Service\CQRS\UpdateServiceCommand;
use App\Domains\Service\Logic\ServiceLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class UpdateServiceAction
 * @package App\Domains\Service\Actions
 */
class UpdateServiceAction
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
			$data = array_merge(
				["id" => intval($id)],
				$request->all()
			);

			$response = response()->json(
				$this->serviceLogic->updateService(UpdateServiceCommand::fromArray($data)),
				200
			);
		}catch(Exception $exception){
//			$response = response()->json("Não foi possível concluir a requisição UpdateService", 500);
			Log::error($exception->getMessage());
			Log::error($exception->getTraceAsString());
			$response = response()->json($exception->getMessage(), 500);
		}

		return $response;
	}
}