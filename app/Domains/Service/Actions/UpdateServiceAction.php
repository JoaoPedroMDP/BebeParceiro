<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Core\Action;
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
class UpdateServiceAction extends Action
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

			$data = $this->serviceLogic->updateService(UpdateServiceCommand::fromArray($data));
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}
}