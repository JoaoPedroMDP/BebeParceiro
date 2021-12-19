<?php
declare(strict_types=1);

namespace App\Domains\Service\CQRS;

use App\Domains\Core\Command;
use App\Domains\Core\Validates;
use Illuminate\Http\UploadedFile;
use Webmozart\Assert\Assert;

/**
 * Class StoreServiceCommand
 * @package App\Domains\Service\CQRS
 */
class StoreServiceCommand extends Command
{
	use Validates;

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var UploadedFile
	 */
	public $image;

	/**
	 * @var string
	 */
	public $description;

	/**
	 * @param string $name
	 * @param UploadedFile $image
	 * @param string $description
	 * @param array $fields
	 */
	public function __construct(string $name, UploadedFile $image, string $description, array $fields)
	{
		$this->name = $name;
		$this->image = $image;
		$this->description = $description;
		$this->fields = $fields;
	}

	/**
	 * @param array $data
	 * @return StoreServiceCommand
	 */
	public static function fromArray(array $data): StoreServiceCommand
	{
		$fields = ['name', 'image', 'description'];
		self::keysExists($data, $fields);
		self::isString($data, 'name');
		self::isString($data, 'description');

		Assert::isInstanceOf($data['image'], UploadedFile::class, "Erro ao carregar a imagem na requisição");

		return new self(
			$data['name'],
			$data['image'],
			$data['description'],
			$fields
		);
	}
}