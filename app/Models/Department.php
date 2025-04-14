<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property string $department_code
 * @property string $department_name
 * @property string|null $address
 * @property string|null $department_phone_number
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'departments';
	protected $primaryKey = 'department_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'department_code',
		'department_name',
		'address',
		'department_phone_number'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class, 'department_code');
	}
}
