<?php
declare(strict_types=1);

namespace App\Domains\Image\CQRS;

use App\Domains\Core\Command;
use App\Domains\Core\Validates;
use Illuminate\Http\UploadedFile;

/**
 * Class StoreImageCommand
 * @package App\Domains\Image\CQRS
 */
class StoreImageCommand extends Command
{
	use Validates;

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
	public function __construct(UploadedFile $image, string $description, array $fields, string $path, string $fileName)
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
		$fields = ['image', 'description', 'path', 'fileName'];

		self::keysExists($data, $fields);
		self::isString($data, 'description');
		self::isString($data, 'path');
		self::isString($data, 'fileName');

		return new self(
			$data['image'],
			$data['description'],
			$fields,
			$data['path'],
			$data['fileName']
		);
	}
}