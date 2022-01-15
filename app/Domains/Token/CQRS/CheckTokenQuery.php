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
			'rules' => ['string']
		]
	];

	/**
	 * @var string
	 */
	public $token;

	/**
	 * @param string $token
	 * @param array $fields
	 */
	public function __construct(string $token, array $fields)
	{
		$this->token = $token;
		$this->fields = $fields;
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
			$data['token'],
			array_keys(self::FIELDS)
		);
	}
}