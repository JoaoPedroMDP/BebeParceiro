<?php
declare(strict_types=1);

namespace App\Domains\Appointment\Actions;

use App\Domains\Appointment\Logic\AppointmentLogic;
use App\Domains\Core\Action;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexAppointmentsAction
 */
class IndexAppointmentsAction extends Action
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
			$data = $this->appointmentLogic->indexAppointments($request->user());
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}
}