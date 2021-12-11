<?php
declare(strict_types=1);

namespace App\Models;

use App\Domains\Core\HidesTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Pregnancy
 * @package App\Models
 */
class Pregnancy extends HidesTimestamps
{
    use HasFactory;
}
