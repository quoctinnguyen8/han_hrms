<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeRotation
 * 
 * @property string $employee_code
 * @property int $id
 * @property Carbon $rotation_date
 * @property string|null $rotation_reason
 * @property string|null $department_rotation
 * @property string|null $incoming_department
 * 
 * @property Employee $employee
 *
 * @package App\Models
 */
class EmployeeRotation extends Model
{
	protected $table = 'employee_rotations';
	public $timestamps = false;

	protected $casts = [
		'rotation_date' => 'datetime'
	];

	protected $fillable = [
		'employee_code',
		'rotation_date',
		'rotation_reason',
		'department_rotation',
		'incoming_department'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employee_code');
	}
}
