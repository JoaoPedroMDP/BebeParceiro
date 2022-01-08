<?php

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
		self::keysExists($data, $fields);

		self::isString($data, 'name');
		self::isString($data, 'description');

		if(isset($data['image'])){
			Assert::isInstanceOf($data['image'], UploadedFile::class, "Erro ao carregar a imagem na requisição");
		}

		return new self(
			$data['id'],
			$data['name'],
			$data['image'] ?? null,
			$data['description'],
			$fields
		);
	}

}