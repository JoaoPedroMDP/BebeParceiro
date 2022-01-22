<?php
declare(strict_types=1);

namespace App\Domains\Token\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Core\Utils;
use App\Domains\Token\CQRS\CheckTokenQuery;
use App\Domains\Token\CQRS\GenerateTokensCommand;
use App\Domains\Token\Exceptions\TokenAlreadyUsed;
use App\Domains\Token\Exceptions\TokenNotFound;
use App\Domains\User\Exceptions\NotAVolunteer;
use App\Models\Token;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Support\Str;

/**
 * Class TokenLogic
 * @package App\Domains\Token\Logic
 */
class TokenLogic extends LogicsAndRepositories
{
	/**
	 * @param User $user
	 * @param int $amount
	 * @return array
	 * @throws Exception vem do randomAlpha, caso a função random_int não encontre uma fonte de randomização válida
	 */
	public function generateTokens(User $user, int $amount): array
	{
		if($amount == 0){
			throw new Exception("Não é possível gerar $amount tokens");
		}

		$utils = new Utils();
		$prefix = substr($user->name, 0 , 3);
		$tokens = [];
		for( $i = 0; $i < $amount; $i++){
			$firstTriple = Str::upper($prefix);
			$secondTriple = Str::upper($utils->randomAlphaString(3));
			$thirdTriple = Str::upper($utils->randomAlphaString(3));

			$newToken = $firstTriple . '-' . $secondTriple . '-' . $thirdTriple;
			$data = [
				"volunteer" => $user->getVolunteer(),
				"token" => $newToken
			];
			$this->tokenRepository()->createToken($data);
			$tokens[$i] = $newToken;
		}

		return $tokens;
	}

	/**
	 * @param string $field
	 * @param string $value
	 * @return Token
	 * @throws TokenNotFound
	 */
	public function getFirstTokenWhere(string $field, string $value): Token
	{
		$token = $this->tokenRepository()->getFirstTokenWhere($field, $value);
		if(is_null($token)){
			throw new TokenNotFound();
		}

		return $token;
	}

	/**
	 * @param CheckTokenQuery $query
	 * @return bool
	 * @throws TokenNotFound|TokenAlreadyUsed
	 */
	public function checkToken(CheckTokenQuery $query): bool
	{
		$token = $this->getFirstTokenWhere('token', $query->token);
		if($token->isUsed()){
			throw new TokenAlreadyUsed();
		}

		return true;
	}

	/**
	 * @param string $token
	 * @return void
	 * @throws TokenNotFound
	 */
	public function useToken(string $token){
		$token = $this->getFirstTokenWhere('token', $token);
		$this->tokenRepository()->useToken($token);
	}

	/**
	 * @param User $user
	 * @return Token[]|DatabaseCollection
	 * @throws NotAVolunteer
	 */
	public function indexTokens(User $user)
	{
		$volunteer = $user->getVolunteer();
		$columns = ['token'];
		return $volunteer->getTokens(false, $columns);
	}
}