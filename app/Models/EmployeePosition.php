<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeePosition
 * 
 * @property string $employee_position_code
 * @property string $position_name
 * @property float|null $hspc
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class EmployeePosition extends Model
{
	protected $table = 'employee_positions';
	protected $primaryKey = 'employee_position_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'hspc' => 'float'
	];

	protected $fillable = [
		'position_name',
		'hspc'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class, 'employee_position_code');
	}
}
