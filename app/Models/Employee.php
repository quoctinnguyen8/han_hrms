<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property string $employee_code
 * @property string|null $username
 * @property string|null $password
 * @property string|null $full_name
 * @property Carbon|null $birthday
 * @property string|null $hometown
 * @property string|null $image
 * @property int|null $gender
 * @property string|null $ethnic
 * @property string|null $phone_number
 * @property string|null $employee_position_code
 * @property bool $status
 * @property string|null $department_code
 * @property string|null $contract_code
 * @property string|null $specialized_code
 * @property string|null $education_level_code
 * @property string|null $identity_card
 * 
 * @property Contract|null $contract
 * @property Department|null $department
 * @property EducationLevel|null $education_level
 * @property EmployeePosition|null $employee_position
 * @property Specialized|null $specialized
 * @property AfterUniversity|null $after_university
 * @property Bonus|null $bonus
 * @property Discipline|null $discipline
 * @property Collection|EducationLevelUpdate[] $education_level_updates
 * @property Collection|EmployeeRotation[] $employee_rotations
 * @property ForeignLanguage|null $foreign_language
 * @property QuitJob|null $quit_job
 * @property Salary|null $salary
 * @property SalaryDetail|null $salary_detail
 * @property SalaryUpdate|null $salary_update
 * @property ScientificResearchTopic|null $scientific_research_topic
 * @property ScientificWork|null $scientific_work
 * @property University|null $university
 * @property WorkingProcess|null $working_process
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';
	protected $primaryKey = 'employee_code';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'birthday' => 'datetime',
		'gender' => 'int',
		'status' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'full_name',
		'birthday',
		'hometown',
		'image',
		'gender',
		'ethnic',
		'phone_number',
		'employee_position_code',
		'status',
		'department_code',
		'contract_code',
		'specialized_code',
		'education_level_code',
		'identity_card'
	];

	public function contract()
	{
		return $this->belongsTo(Contract::class, 'contract_code');
	}

	public function department()
	{
		return $this->belongsTo(Department::class, 'department_code');
	}

	public function education_level()
	{
		return $this->belongsTo(EducationLevel::class, 'education_level_code');
	}

	public function employee_position()
	{
		return $this->belongsTo(EmployeePosition::class, 'employee_position_code');
	}

	public function specialized()
	{
		return $this->belongsTo(Specialized::class, 'specialized_code');
	}

	public function after_university()
	{
		return $this->hasOne(AfterUniversity::class, 'employee_code');
	}

	public function bonus()
	{
		return $this->hasOne(Bonus::class, 'employee_code');
	}

	public function discipline()
	{
		return $this->hasOne(Discipline::class, 'employee_code');
	}

	public function education_level_updates()
	{
		return $this->hasMany(EducationLevelUpdate::class, 'employee_code');
	}

	public function employee_rotations()
	{
		return $this->hasMany(EmployeeRotation::class, 'employee_code');
	}

	public function foreign_language()
	{
		return $this->hasOne(ForeignLanguage::class, 'employee_code');
	}

	public function quit_job()
	{
		return $this->hasOne(QuitJob::class, 'employee_code');
	}

	public function salary()
	{
		return $this->hasOne(Salary::class, 'employee_code');
	}

	public function salary_detail()
	{
		return $this->hasOne(SalaryDetail::class, 'employee_code');
	}

	public function salary_update()
	{
		return $this->hasOne(SalaryUpdate::class, 'employee_code');
	}

	public function scientific_research_topic()
	{
		return $this->hasOne(ScientificResearchTopic::class, 'employee_code');
	}

	public function scientific_work()
	{
		return $this->hasOne(ScientificWork::class, 'employee_code');
	}

	public function university()
	{
		return $this->hasOne(University::class, 'employee_code');
	}

	public function working_process()
	{
		return $this->hasOne(WorkingProcess::class, 'employee_code');
	}
}
