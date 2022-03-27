<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Domains\Benefited\Repository\BenefitedRepository;
use Exception;
use Tests\Tools;
use Webmozart\Assert\Assert;

/**
 * Class BenefitedTest
 * @package Tests\Feature
 */
class BenefitedTest extends Tools
{
	/**
	 * @var array
	 */
	private $standardValuesForMandatoryFields;

	/**
	 * E lá vamos nós...
	 *
	 * @return void
	 * @throws Exception
	 */
    public function test_store_benefited_child_case()
    {
		$this->configureMandatoryFields();
	    $token = $this->getValidToken();
	    $response = $this->post("/benefited/$token", $this->standardValuesForMandatoryFields);
        $response->assertStatus(201);
    }

	/**
	 * E lá vamos nós 2...
	 *
	 * @return void
	 * @throws Exception
	 */
	public function test_store_benefited_pregnancy_case()
	{
		$this->configureMandatoryFields();
		$token = $this->getValidToken();
		$params = array_merge(
			$this->standardValuesForMandatoryFields,
			['pregnancy' => ['riskyPregnancy' => true]]
		);
		$response = $this->post("/benefited/$token", $params);

		$response->assertStatus(201);
	}

	/**
	 * @throws Exception
	 */
	public function test_list_new_entries()
	{
		$actor = $this->getActor("Beneficiada");
		$pageNum = 1;
		$response = $this->actingAs($actor)->get('/newEntries?page=' . $pageNum);
		$response->assertUnauthorized();

		$actor = $this->getActor("Validador");
		$response = $this->actingAs($actor)->get('/newEntries?page=' . $pageNum);
		$response->assertOk();
		Assert::true(
			count($response->json()['data']) <= BenefitedRepository::PER_PAGE,
			"Retornou mais resultados do que o esperado"
		);
	}

	/**
	 * @return void
	 */
	private function configureMandatoryFields()
	{
		$this->standardValuesForMandatoryFields = [
			'personal' => [
				'birthday' => '13/03/1900',
				'childAlreadyBorn' => 'true',
				'maritalStatus' => 'married',
				'childCount' => 3, // Lembrando que esse número já inclui o filho da gravidez se for o caso
				'familiarIncome' => 1000.0,
				'hasDisablement' => false,
				'socialBenefits' => ['Minha casa minha vida', 'Cadastro de emprego', 'Cartão alimentação'],
				'name' => 'Mãe da silva',
				'surname' => 'Sauro',
				'email' => 'mae.silvaSauro@email.com',
				'telephone' => '44987562869',
				'password' => 'secret',
				'passwordConfirmation' => 'secret'
			],
			'address' => [
				'street' => 'Avenida Humaitá',
				'number' => 315,
				'complement' => 'Apartamento 48',
				'cep' => 87014200,
				'city' => 'Maringá'
			],
			'child' => [
				'sex' => 'male',
				'name' => 'criança',
				'surname' => 'da silva',
				'birthday' => '13/03/2022',
				'weight' => '2',
				'measurements' => [
					$this->getUploadedFile(2, 'childMeasurement1'),
					$this->getUploadedFile(3, 'childMeasurement2'),
					$this->getUploadedFile(4, 'childMeasurement3')
				]
			]
		];
	}
}
