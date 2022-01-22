<?php
declare(strict_types=1);

namespace App\Domains\User\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\User\CQRS\AuthenticateUserCommand;
use App\Domains\User\CQRS\StoreUserCommand;
use App\Domains\User\Exceptions\InvalidCredentials;
use App\Domains\User\Exceptions\LoginAlreadyTaken;
use App\Domains\User\Exceptions\UserNotFound;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

/**
 * Class UserLogic
 * @package App\Domains\User\Logic
 */
class UserLogic extends LogicsAndRepositories
{
	/**
	 * @param string $field
	 * @param $value
	 * @return User
	 * @throws UserNotFound
	 */
	public function getFirstUserWhere(string $field, $value): User
	{
		$user = $this->userRepository()->getFirstUserWhere($field, $value);
		if(is_null($user)){
			throw new UserNotFound();
		}

		return $user;
	}

	/**
	 * @param AuthenticateUserCommand $command
	 * @return string
	 * @throws UserNotFound | InvalidCredentials
	 */
	public function authenticateUser(AuthenticateUserCommand $command): string
	{
		$user = $this->getFirstUserWhere('login', $command->login);

		if(!Hash::check($command->password, $user->password))
		{
			throw new InvalidCredentials();
		}

		// Teoricamente é pra cada usuário ter apenas uma role, mas quem sabe o que o futuro nos guarda....
		$role = $user->getRoleNames()[0];
		return $user->createToken($role)->plainTextToken;
	}

	/**
	 * @param StoreUserCommand $command
	 * @return User
	 * @throws LoginAlreadyTaken
	 */
	public function storeUser(StoreUserCommand $command): User
	{
		$this->checkIfLoginIsUnique($command->telephone);
		$userParams = array_merge(
			['login' => $command->telephone],
			$command->toArray()
		);

		return $this->userRepository()->storeUser($userParams);
	}

	/**
	 * @throws LoginAlreadyTaken
	 */
	private function checkIfLoginIsUnique(string $login)
	{
		$potentialDuplicate = $this->userRepository()->getFirstUserWhere('login', $login);
		if(!is_null($potentialDuplicate)){
			throw new LoginAlreadyTaken();
		}
	}
}