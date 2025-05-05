<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * 
 * @property string $contract_code
 * @property string|null $contract_type
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property string|null $note
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Contract extends Model
{
	protected $table = 'contracts';
	protected $primaryKey = 'contract_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'contract_type',
		'start_date',
		'end_date',
		'note',
		'salary_detail_id',
		'employee_code'
	];

	public function employees()
	{
		return $this->belongsTo(Employee::class, 'employee_code');
	}
	public function salaryDetail()
	{
		return $this->belongsTo(SalaryDetail::class, 'salary_detail_id');
	}
}
