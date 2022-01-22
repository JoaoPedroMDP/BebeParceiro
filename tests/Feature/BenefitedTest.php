<?php
declare(strict_types=1);

namespace Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\Helpers\TokenTestHelper;
use Tests\TestCase;
use Tests\Tools;

/**
 * Class BenefitedTest
 * @package Tests\Feature
 */
class BenefitedTest extends Tools
{
	const STANDARD_VALUES_FOR_MANDATORY_FIELDS = [
		'name' => 'Mãe da silva',
		'surname' => 'Sauro',
		'childCount' => 3, // Lembrando que esse número já inclui o filho da gravidez se for o caso
		'birthday' => '13/03/1900',
//		'isPregnant' => , Esse campo depende do caso de teste
		'maritalStatus' => 'married',
		'email' => 'mae.silvaSauro@email.com',
		'telephone' => '44987562869',
		'familiarIncome' => 1000.0,
		'socialBenefits' => ['Minha casa minha vida', 'Cadastro de emprego', 'Cartão alimentação'],
		'hasDisablement' => false,

		'street' => 'Avenida Humaitá',
		'houseNumber' => 315,
		'cep' => 87014200,
		'city' => 'Maringá',
		'complement' => 'Apartamento 48',
		'referencePoint' => 'Ao lado da imobiliária Abrão',
	];

	/**
	 * E lá vamos nós...
	 *
	 * @return void
	 * @throws Exception
	 */
    public function test_store_benefited_child_case()
    {
	    $token = (new TokenTestHelper)->getValidToken();
		$params = array_merge(
			self::STANDARD_VALUES_FOR_MANDATORY_FIELDS,
			[
				'childName' => 'Filho da Silva',
				'childSurname' => 'Sauro Júnior',
				'childSex' => 'male',
				'childBirthday' => '13/09/2021',
				'childMeasurements' => [
					$this->getUploadedFile(2, 'childMeasurement1'),
					$this->getUploadedFile(3, 'childMeasurement2'),
					$this->getUploadedFile(4, 'childMeasurement3')
				]
			]
		);
        $response = $this->get('/');

        $response->assertStatus(200);
    }

//	/**
//	 * E lá vamos nós 2...
//	 *
//	 * @return void
//	 * @throws Exception
//	 */
//	public function test_store_benefited_pregnancy_case()
//	{
//		$token = (new TokenTestHelper)->getValidToken();
//
//		$params = [
//			'name', 'surname', 'childCount', 'birthday',
//			'isPregnant', 'maritalStatus', 'email', 'telephone',
//			'familiarIncome', 'socialBenefits', 'hasDisablement',
//
//			'street', 'houseNumber', 'cep',
//			'city', 'complement', 'referencePoint',
//
//			'sex', 'riskyPregnancy', 'fetusName',
//			'birthdayForecast', 'weightForecast'
//		];
//		$response = $this->post('/');
//
//		$response->assertStatus(200);
//	}
}
