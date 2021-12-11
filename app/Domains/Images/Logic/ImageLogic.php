<?php
declare(strict_types=1);

namespace App\Domains\Images\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Images\CQRS\StoreImageCommand;

/**
 * Class ImageLogic
 * @package App\Domains\Images
 */
class ImageLogic extends LogicsAndRepositories
{
	/**
	 * @param StoreImageCommand $command
	 * @return void
	 */
	public function storeImage(StoreImageCommand $command){
		$command->path = $command->image->store($command->path);

		$this->repository("image")->storeImage($command->toArray())
	}
}