<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationLevelUpdate
 * 
 * @property int $update_code
 * @property string $employee_code
 * @property Carbon $update_day
 * @property string $previous_education_level_code
 * @property string $education_level_update_code
 * 
 * @property Employee $employee
 *
 * @package App\Models
 */
class EducationLevelUpdate extends Model
{
	protected $table = 'education_level_updates';
	protected $primaryKey = 'update_code';
	public $timestamps = false;

	protected $casts = [
		'update_day' => 'datetime'
	];

	protected $fillable = [
		'employee_code',
		'update_day',
		'previous_education_level_code',
		'education_level_update_code'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employee_code');
	}
}
