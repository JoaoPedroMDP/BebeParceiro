<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Exception;
use Tests\Tools;
use Webmozart\Assert\Assert;

/**
 * Class AppointmentTest
 * @package Tests\Feature
 */
class AppointmentTest extends Tools
{
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function test_get_user_appointments()
    {
		$actor = $this->getActor('Doula');
	    $this->simpleGet($actor);

		// Cria um agendamento na mão ali pra ver se retorna certinho
		$appointmentName = $this->withCreatedAppointment($actor);

		// Atua como outro usuário para garantir que não existem vazamentos
	    $actor = $this->getActor('Admin');
	    $this->asAnotherUser($actor, $appointmentName);
    }

	/**
	 * @param User $actor
	 * @return void
	 */
	private function simpleGet(User $actor)
	{
		$response = $this->actingAs($actor)->get('/appointments');
		$response->assertOk();
	}

	/**
	 * @throws Exception
	 */
	private function withCreatedAppointment(User $actor)
	{
		//Cria um agendamento para garantir que pelo menos 1 terá
		$appointment = new Appointment;
		$appointment->name = "Teste";
		$appointment->datetime = now()->addWeek();
		$serviceTest = new ServiceTest;
		$serviceTest->test_store_service(); // para ter um serviço no BD
		$appointment->service()->associate(Service::find(1));
		try{
			$appointment->save();
			$appointment->users()->attach($actor);
		}catch(Exception $e){
			error_log($e->getMessage());
			throw $e;
		}

		$response = $this->actingAs($actor)->get('/appointments');
		Assert::true(
			count($response->json()) >= 1,
			"Tamanho do JSON de resposta menor que 1"
		);

		return $appointment->name;
	}

	/**
	 * @param User $actor
	 * @param string $previouslyCreatedAppointmentName
	 * @return void
	 */
	private function asAnotherUser(User $actor, string $previouslyCreatedAppointmentName)
	{
		$response = $this->actingAs($actor)->get('/appointments');
		$response->assertJsonMissing([
			"name"=> $previouslyCreatedAppointmentName
		]);
	}
}
