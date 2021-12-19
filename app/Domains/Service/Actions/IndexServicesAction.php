<?php
declare(strict_types=1);

namespace App\Domains\Service\Actions;

use App\Domains\Service\Logic\ServiceLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexServicesAction
 * @package App\Domains\Service\Actions
 */
class IndexServicesAction
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
						$response = response()->json($this->serviceLogic->indexServices());
				}catch(Exception $exception){
						$response = response()->json("Não foi possível concluir a requisição", 500);
				}

				return $response;
		}
}