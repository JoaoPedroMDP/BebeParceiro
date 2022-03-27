<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Measure
 * @package App\Models
 * @mixin Builder
 */
class Measure extends Model
{
    use HasFactory;
}
