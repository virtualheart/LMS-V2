<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class SettingsModel extends Model{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'app_name',
        'app_decp',
        'app_logo',
        'fine',
        'fine_stf_days',
        'fine_std_days',
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_pass',
        'smtp_sec_type'
    ];

    // Get Application Name (All Users)
    public function getAppName()
    {
        $result = $this->select('app_name')->first();
        return $result ? $result['app_name'] : null;
    }

    // Get app logo (All Users)
    public function getAppLogo()
    {
        $result = $this->select('app_logo')->first();
        return $result ? $result['app_logo'] : null;
    }

    // Get Fine amount (All users)
    public function getAppfine()
    {
        $result = $this->select('fine,fine_stf_days,fine_std_days')->first();
        return $result;
    }

    // Get SMPT server detiles (Admin)
    public function getAppSmtp()
    {
        $result = $this->select('smtp_host,smtp_port,smtp_user,smtp_pass,smtp_sec_type')->first();
        return $result ? $result['app_logo'] : null;
    }
}

