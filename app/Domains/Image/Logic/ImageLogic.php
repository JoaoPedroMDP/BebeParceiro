<?php
declare(strict_types=1);

namespace App\Domains\Image\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Image\CQRS\StoreImageCommand;
use App\Models\Image;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageLogic
 * @package App\Domains\Image
 */
class ImageLogic extends LogicsAndRepositories
{
	/**
	 * @param StoreImageCommand $command
	 * @return Image
	 */
	public function storeImage(StoreImageCommand $command): Image
	{
		$command->path = $command->image->storeAs($command->path, $this->generateFileName($command->image, $command->toArray()));

		return $this->repository("image")->storeImage($command->toArray());
	}

	/**
	 * @param UploadedFile $file
	 * @param array $data
	 * @return string
	 */
	public function generateFileName(UploadedFile $file, array $data): string
	{
		$fileExtension = '.' . $file->extension();

		return str_replace(' ', '_', $data['fileName']) . $fileExtension;
	}
}