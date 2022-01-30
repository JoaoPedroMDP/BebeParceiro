<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Core\Action;
use App\Domains\Service\Logic\ServiceLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class DeleteServicesAction
 * @package App\Domains\Service\Actions
 */
class DeleteServiceAction extends Action
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
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse([], 200, 'Serviço deletado');
	}
}