<?php
declare(strict_types=1);

namespace App\Domains\Token\Logic;

use App\Domains\Core\LogicsAndRepositories;
use App\Domains\Core\Utils;
use App\Domains\Token\CQRS\GenerateTokensCommand;
use Exception;
use Illuminate\Support\Str;

/**
 * Class TokenLogic
 * @package App\Domains\Token\Logic
 */
class TokenLogic extends LogicsAndRepositories
{

	/**
	 * @param GenerateTokensCommand $command
	 * @return array
	 * @throws Exception vem do randomAlpha, caso a função random_int não encontre uma fonte de randomização válida
	 */
	public function generateTokens(GenerateTokensCommand $command): array
	{
		$utils = new Utils();
		$prefix = substr($command->user->name, 0 , 3);
		$tokens = [];
		for( $i = 0; $i < $command->amount; $i++){
			$firstTriple = Str::upper($prefix);
			$secondTriple = Str::upper($utils->randomAlphaString(3));
			$thirdTriple = Str::upper($utils->randomAlphaString(3));

			$newToken = $firstTriple . '-' . $secondTriple . '-' . $thirdTriple;
			$data = [
				"volunteer" => $command->user,
				"token" => $newToken
			];
			$this->tokenRepository()->createToken($data);
			$tokens[$i] = $newToken;
		}

		return $tokens;
	}
}