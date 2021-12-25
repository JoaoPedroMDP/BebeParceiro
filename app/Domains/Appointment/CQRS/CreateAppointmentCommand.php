<?php
declare(strict_types=1);

namespace App\Domains\Appointment\CQRS;

use App\Domains\Appointment\Exceptions\AppointmentInPast;
use App\Domains\Core\Command;
use App\Domains\Core\Validates;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Exception;

/**
 * Class CreateAppointmentCommand
 * @package App\Domains\Appointment\CQRS
 */
class CreateAppointmentCommand extends Command
{
	use Validates;

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
	 * @param array $fields
	 */
	public function __construct(string $name, string $datetime, int $serviceId, array $fields)
	{
		$this->name = $name;
		$this->datetime = $datetime;
		$this->serviceId = $serviceId;
		$this->fields = $fields;
	}

	/**
	 * @param array $data
	 * @return CreateAppointmentCommand
	 * @throws AppointmentInPast
	 */
	public static function fromArray(array $data): CreateAppointmentCommand
	{
		$fields = ['name', 'datetime', 'serviceId'];
		self::keysExists($data, $fields);
		self::isString($data, 'name');
		self::isString($data, 'datetime');

		self::validateDatetime($data['datetime']);

		return new self(
			$data['name'],
			$data['datetime'],
			intval($data['serviceId']),
			$fields
		);
	}

	/**
	 * @param $datetime
	 * @return void
	 * @throws AppointmentInPast
	 */
	private static function validateDatetime($datetime)
	{
		try {
			$parsed = Carbon::parse($datetime);
		}catch(InvalidFormatException $e){
			throw new InvalidFormatException("Formato da data está errado.");
		}

		if(!$parsed->isFuture()){
			throw new AppointmentInPast();
		}
	}
}