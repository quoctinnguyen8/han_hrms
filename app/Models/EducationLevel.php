<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationLevel
 * 
 * @property string $education_level_code
 * @property string $education_level_name
 * @property float|null $tier_coefficient
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class EducationLevel extends Model
{
	protected $table = 'education_levels';
	protected $primaryKey = 'education_level_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'tier_coefficient' => 'float'
	];

	protected $fillable = [
		'education_level_name',
		'tier_coefficient'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class, 'education_level_code');
	}
}
