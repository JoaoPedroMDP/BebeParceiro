<?php
declare(strict_types=1);

namespace Tests\Helpers;

use App\Models\Token;
use Exception;
use Tests\Tools;

/**
 * Class TokenTestHelper
 * @package Tests\Helpers
 */
class TokenTestHelper extends Tools
{
	/**
	 * @return string
	 * @throws Exception
	 */
	public function getValidToken(): string
	{
		$actor = $this->getActor('Secretario inicial');
		$response = $this->get('token/generate/1');
		return $response->json()[0];
	}
}