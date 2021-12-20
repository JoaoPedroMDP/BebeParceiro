<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Actions;

use App\Domains\Appointment\Logic\AppointmentLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexAppointmentsAction
 */
class IndexAppointmentsAction
{
	/**
	 * @var AppointmentLogic
	 */
	private $appointmentLogic;

	public function __construct()
	{
		$this->appointmentLogic = new AppointmentLogic();
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function handle(Request $request): JsonResponse
	{
		try{
			$response = response()->json(
				$this->appointmentLogic->indexAppointments($request->user()),
				200
			);
		}catch(Exception $exception){
			$response = response()->json("Não foi possível concluir a requisição", 500);
		}

		return $response;
	}
}