<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Specialized
 * 
 * @property string $specialized_code
 * @property string|null $specialized_name
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Specialized extends Model
{
	protected $table = 'specialized';
	protected $primaryKey = 'specialized_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'specialized_name'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class, 'specialized_code');
	}
}
