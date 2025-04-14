<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuitJob
 * 
 * @property string $employee_code
 * @property string|null $reason
 * @property Carbon $quit_job_date
 * 
 * @property Employee $employee
 *
 * @package App\Models
 */
class QuitJob extends Model
{
	protected $table = 'quit_jobs';
	protected $primaryKey = 'employee_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'quit_job_date' => 'datetime'
	];

	protected $fillable = [
		'reason',
		'quit_job_date'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employee_code');
	}
}
