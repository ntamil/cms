<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Appform extends Model
{
    protected $table = 'appforms';
    protected $primaryKey = 'appform_id';
    public $timestamp = 'true';
    protected $fillable = [
    'transaction_id',
    'sales_activity',
    'user_id',
    'application_type',
    'existing_service',
    'streamyx_tel_no',
    'streamyx_package',
    'applicant_name',
    'ic_passport_num',
    'ic',
    'passport',
    'nationality',
    'date_of_birth',
    'passport_exp_date',
    'inst_address',
    'contact_num',
    'email_address',
    'remark',
    'thumbprint_coll',
    'company_name',
    'buss_reg_num',
    'docs_uploaded',
    'eform_id',
    'runner_name',
    'process_status',
    'job_status',
    'admin_remark',
    'altuser_id',
    'finalstatus',
    'agenteformstatus',
    'admineformstatus',
    'runnereformstatus',
    ];

	// Manager
    public function getAppFormData($search)
    {
		if(isset($search['master_status_id']) && $search['master_status_id'] != '') {
			$appData = DB::table('appforms')
				->select('*')
				->join('status', 'status.status_id', '=', 'appforms.process_status')
				->join('apptypes', 'apptypes.apptype_id', '=', 'appforms.application_type')
				->join('internetpackages', 'internetpackages.intpackage_id', '=', 'appforms.streamyx_package')
				->where('status.master_status_id',$search['master_status_id'])
				->get();
		} else {
			$appData = DB::table('appforms')
				->select('*')
				->join('status', 'status.status_id', '=', 'appforms.process_status')
				->join('apptypes', 'apptypes.apptype_id', '=', 'appforms.application_type')
				->join('internetpackages', 'internetpackages.intpackage_id', '=', 'appforms.streamyx_package')
				->get();
		}
        return $appData;
    } 

	// Agent
    public function getAppFormList($search)
    {
		if(isset($search['master_status_id']) && $search['master_status_id'] != '') {
			$appData = DB::table('appforms')
				->select('*','status.status as process_status_name', 'agenteformstatus.status as agenteformstatus_status')
				->join('status', 'status.status_id', '=', 'appforms.process_status')
				->join('agenteformstatus', 'agenteformstatus.agenteformstatus_id', '=', 'appforms.agenteformstatus')
				->join('users', 'appforms.user_id', '=', 'users.user_id')
				->join('apptypes', 'apptypes.apptype_id', '=', 'appforms.application_type')
				->join('internetpackages', 'internetpackages.intpackage_id', '=', 'appforms.streamyx_package')
				->where('status.master_status_id',$search['master_status_id'])
				->where('users.user_id',$search['user_id'])
				->get();
		} else {
			$appData = DB::table('appforms')
				->select('*','status.status as process_status_name', 'agenteformstatus.status as agenteformstatus_status')
				->join('status', 'status.status_id', '=', 'appforms.process_status')
				->join('agenteformstatus', 'agenteformstatus.agenteformstatus_id', '=', 'appforms.agenteformstatus')
				->join('users', 'appforms.user_id', '=', 'users.user_id')
				->join('apptypes', 'apptypes.apptype_id', '=', 'appforms.application_type')
				->join('internetpackages', 'internetpackages.intpackage_id', '=', 'appforms.streamyx_package')
				->where('users.user_id',$search['user_id'])
				->get();
		}
        return $appData;
    }


    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    } 

    public function runners()
    {
        return $this->belongsTo('App\User','runner_name');
    } 

    public function admins()
    {
        return $this->belongsTo('App\User','user_id');
    } 

    public function managers()
    {
        return $this->belongsTo('App\User','user_id');
    } 

    public function packages()
    {
        return $this->belongsTo('App\InternetPackage','streamyx_package');
    } 

    public function activities()
    {
        return $this->belongsTo('App\SalesActivity','sales_activity');
    } 

    public function thumbprints()
    {
        return $this->belongsTo('App\ThumbprintStatus','thumbprint_coll');
    }

    public function apptypes()
    {
        return $this->belongsTo('App\Apptype','application_type');
    }

    public function docsups()
    {
        return $this->belongsTo('App\DocsUpload','docs_uploaded');
    }

    public function exservs()
    {
        return $this->belongsTo('App\ExistService','existing_service');
    }

    public function icpass()
    {
        return $this->belongsTo('App\IcPassport','icpass');
    }

    public function status()
    {
        return $this->belongsTo('App\Status','process_status');
    }

    public function jobstatus()
    {
        return $this->belongsTo('App\JobStatus','job_status');
    }

    public function finals()
    {
        return $this->belongsTo('App\AdminFinal','finalstatus');
    }

    public function agentefs()
    {
        return $this->belongsTo('App\AgentEformStatus','agenteformstatus');
    }

    public function adminefs()
    {
        return $this->belongsTo('App\AdminEformStatus','admineformstatus');
    }

    public function runnerefs()
    {
        return $this->belongsTo('App\RunnerEformStatus','runnereformstatus');
    }
    public function countries()
    {
        return $this->belongsTo('App\Countries','nationality');
    }    

}
