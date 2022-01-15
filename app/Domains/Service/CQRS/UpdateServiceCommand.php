<?php
declare(strict_types=1);

namespace App\Domains\Service\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use Illuminate\Http\UploadedFile;
use Webmozart\Assert\Assert;

/**
 * Class UpdateServiceCommand
 * @package App\Domains\Service\CQRS
 */
class UpdateServiceCommand extends CommandQuery
{
	use Validates;

	const FIELDS = [
		'id' => [
			'rules' => ['integer']
		],
		'name' => [
			'rules' => ['string']
		],
		'image' => [
			'rules' => ['nullable', 'uploadedFile']
		],
		'description' => [
			'rules' => ['string']
		]
	];

	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var UploadedFile | null
	 */
	public $image;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @param int $id
	 * @param string $name
	 * @param UploadedFile|null $image
	 * @param string $description
	 * @param array $fields
	 */
	public function __construct(int $id, string $name, ?UploadedFile $image, string $description, array $fields)
	{
		$this->id = $id;
		$this->name = $name;
		$this->image = $image;
		$this->description = $description;
		$this->fields = $fields;
	}

	/**
	 * @param array $data
	 * @return UpdateServiceCommand
	 */
	public static function fromArray(array $data): UpdateServiceCommand
	{
		$fields = ['name', 'description', 'id'];
		self::validate($data, self::FIELDS);

		return new self(
			$data['id'],
			$data['name'],
			$data['image'] ?? null,
			$data['description'],
			$fields
		);
	}

}