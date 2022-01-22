<?php
declare(strict_types=1);

namespace App\Domains\Token\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use App\Models\Token;
use Webmozart\Assert\Assert;

/**
 * Class CheckTokenQuery
 * @package App\Domains\Token\CQRS
 */
class CheckTokenQuery extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'token' => [
			'rules' => ['required', 'string']
		]
	];

	/**
	 * @var string
	 */
	public $token;

	/**
	 * @param string $token
	 */
	public function __construct(string $token)
	{
		$this->token = $token;
	}

	/**
	 * @param array $data
	 * @return CheckTokenQuery
	 */
	public static function fromArray(array $data): CheckTokenQuery
	{
		self::validate($data, self::FIELDS);
		Assert::regex($data['token'], Token::REGEX, 'Formato de código inválido');

		return new self(
			$data['token']
		);
	}
}