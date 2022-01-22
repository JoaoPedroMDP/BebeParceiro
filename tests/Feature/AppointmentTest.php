<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Exception;
use Tests\Helpers\AppointmentTestHelper;
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
	    $response = $this->actingAs($actor)->get('/appointment');
	    $response->assertOk();
	}

	/**
	 * @throws Exception
	 */
	public function test_get_user_dummy_appointments(){
		$actor = $this->getActor('Doula');
		// Cria um agendamento na mão ali pra ver se retorna certinho
		$appointmentName = $this->withCreatedAppointment($actor);

		// Atua como outro usuário para garantir que não existem vazamentos
		$actor = $this->getActor('Admin');
		$this->asAnotherUser($actor, $appointmentName);
	}

	/**
	 * @throws Exception
	 */
	private function withCreatedAppointment(User $actor)
	{
		$appointmentHandler = new AppointmentTestHelper();
		$appointment = $appointmentHandler->createDummyAppointment($actor);
		//Cria um agendamento para garantir que pelo menos 1 terá

		$response = $this->actingAs($actor)->get('/appointment');
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
		$response = $this->actingAs($actor)->get('/appointment');
		$response->assertJsonMissing([
			"name"=> $previouslyCreatedAppointmentName
		]);
	}
}
