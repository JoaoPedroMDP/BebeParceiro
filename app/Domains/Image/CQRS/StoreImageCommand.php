<?php
declare(strict_types=1);

namespace App\Domains\Image\CQRS;

use App\Domains\Core\CommandQuery;
use App\Domains\Core\Validates;
use Illuminate\Http\UploadedFile;

/**
 * Class StoreImageCommand
 * @package App\Domains\Image\CQRS
 */
class StoreImageCommand extends CommandQuery
{
	use Validates;
	const FIELDS = [
		'image' => [
			'rules' => ['uploadedFile']
		],
		'description' => [
			'rules' => ['string']
		],
		'path' => [
			'rules' => ['string']
		],
		'fileName' => [
			'rules' => ['string']
		],

	];
	/**
	 * @var UploadedFile
	 */
	public $image;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @var string
	 */
	public $path;

	/**
	 * @var string
	 */
	public $fileName;

	/**
	 * @param UploadedFile $image
	 * @param string $description
	 * @param array $fields
	 * @param string $path
	 * @param string $fileName
	 */
	public function __construct(UploadedFile $image, string $description, string $path, string $fileName, array $fields)
	{
		$this->image = $image;
		$this->description = $description;
		$this->fields = $fields;
		$this->path = $path;
		$this->fileName = $fileName;
	}

	/**
	 * @param array $data
	 * @return StoreImageCommand
	 */
	public static function fromArray(array $data): StoreImageCommand
	{
		self::validate($data, self::FIELDS);

		return new self(
			$data['image'],
			$data['description'],
			$data['path'],
			$data['fileName'],
			array_keys(self::FIELDS)
		);
	}
}