<?php
declare(strict_types=1);

namespace App\Domains\Appointment\CQRS;

use App\Domains\Appointment\Exceptions\AppointmentInPast;
use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Exception;

/**
 * Class CreateAppointmentCommand
 * @package App\Domains\Appointment\CQRS
 */
class CreateAppointmentCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'name' => [
			'rules' => ['string']
		],
		'datetime' => [
			'rules' => ['futureDatetime']
		],
		'serviceId' => [
			'rules' => ['integer']
		],
	];

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var string
	 */
	public $datetime;

	/**
	 * @var int
	 */
	public $serviceId;

	/**
	 * @param string $name
	 * @param string $datetime
	 * @param int $serviceId
	 */
	public function __construct(string $name, string $datetime, int $serviceId)
	{
		$this->name = $name;
		$this->datetime = $datetime;
		$this->serviceId = $serviceId;
	}

	/**
	 * @param array $data
	 * @return CreateAppointmentCommand
	 */
	public static function fromArray(array $data): CreateAppointmentCommand
	{
		self::validate($data, self::FIELDS);

		return new self(
			$data['name'],
			$data['datetime'],
			intval($data['serviceId'])
		);
	}
}