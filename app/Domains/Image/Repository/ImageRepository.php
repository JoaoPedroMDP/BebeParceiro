<?php
declare(strict_types=1);

namespace App\Domains\Image\Repository;

use App\Domains\Core\LogicsAndRepositories;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageRepository
 * @package App\Domains\Image\Repository
 */
class ImageRepository extends LogicsAndRepositories
{

	/**
	 * @param array $data
	 * @return Image
	 */
	public function storeImage(array $data): Image
	{
		$newImage = new Image;
		$newImage->setPath($data['path']);
		$newImage->setDescription($data['path']);
		return $newImage;
	}

	/**
	 * @param Image|null $image
	 * @return void
	 */
	public function deleteImage(?Image $image){
		if(!is_null($image)){
			Storage::delete($image->getPath()); // TODO: quem sabe adicionar um failproof aqui
			$image->delete();
		}
	}
}