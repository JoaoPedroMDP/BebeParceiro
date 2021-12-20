<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\Core\HidesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Image
 * @package App\Models
 */
class Image extends HidesTimestamps
{
    use HasFactory;

	public function __construct()
	{
		$fieldsToHide = [
			"imageable_type", "imageable_id"
		];

		parent::__construct($fieldsToHide);
	}

	protected $fillable = [
		'path'. 'description'
	];

	/**
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 */
	public function setPath(string $path): void
	{
		$this->path = $path;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription(string $description): void
	{
		$this->description = $description;
	}


}
