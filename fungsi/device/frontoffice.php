<?php

class Frontoffice extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'test/t_test_m',
            'masterdata/m_patienttype_m',
            'masterdata/m_sex_m',
            'masterdata/m_doctor_m',
            'masterdata/m_classs_m',
            'masterdata/m_patientinout_m',
            'test/t_resulttype_m',
            'queue/q_service_m','fo/register_m'));
    }

    function index()
    {
        $dt['extrajs'] = array('underscore-min' ,'duo_disp','frontoffice', 'f_register', 'f_cashier', 'f_patientstatus', 'q_queue', 'f_resultdelivery', 'jzebra');
        $dt['extracss'] = array('frontoffice');
        //$dt['extrabasicjs'] = array('/includes/js/underscore-min.js');
        if (!$this->input->get('ct'))
            $dt['inlinejs'] = "$.ct='tabbRegister';";
        else
            $dt['inlinejs'] = "$.ct='{$this->input->get('ct')}';";
		$dt['inlinejs'] .= "$.prm='{$this->input->get('prm')}';$.qdate='{$this->input->get('qdate')}';
							$.labno='{$this->input->get('labno')}';";

        $dt["date"] = date("l, d-m-Y");
        $dt["pagetitle"] = "FRONT OFFICE PAGE";
        $dt['dialogs'] = $this->load->view('parts/dialogform', '', true);
        $dt['patienttypelist'] = $this->m_patienttype_m
                                  ->get_key_value('M_PatientTypeID as id',
                                      'concat(M_PatientTypeName,"||",M_PatientTypeAddress) as name');
        $dt['patienttypelist_default'] = $this->m_patienttype_m->get_default();
        $dt['resulttypelist'] = $this->t_resulttype_m->get_key_value('T_ResultTypeID', 'T_ResultTypeName');
        $dt['resulttypelist'][0] = 'All';
        $dt['sexlist'] = $this->m_sex_m->get_key_value('M_SexID', 'M_SexName');
        $dt['qservicelist'] = $this->q_service_m->get_key_value('Q_ServiceID', 'Q_ServiceName');
        $dt['classslist'] = $this->m_classs_m->get_key_value('M_ClasssID', 'M_ClasssName');
        $dt['patientinoutlist'] = $this->m_patientinout_m->get_key_value('M_PatientInOutID', 'M_PatientInOutName');
        $dt['doctorpjlist'] = $this->m_doctor_m->get_doctorpj_list();
        $dt['doctorpjdefault'] = $this->m_doctor_m->get_doctorpj_default();

        $billing = $this->register_m->billing();
        $dt['cancel_pay'] = 'N';
        if (isset($this->menud['CASHIER']))
          if(array_search('cancelpay', $this->menud['CASHIER']) !== false){
              $dt['cancel_pay'] = 'Y';
          }

        $dt['favorites'] = $this->t_test_m->get_favorites();

        if($billing->S_SystemsBilling == 'N'){
            $this->load->view('pages/frontoffice', $dt);
        }
        else{
            foreach($dt['extrajs'] as $k=>$v){
                if($v == 'f_register' ){
                    $dt['extrajs'][$k] = 'f_registerbilling';
                }
            }

            $dt['reporturl'] = $billing->S_SystemsReportUrl;
            $dt['onbilling'] = $billing->S_SystemsBillingOnScreen;
            $this->load->model('report/m_menureport_m');
            $dt['database'] = $this->db->database;
            $dt['reportkwitansi'] = $this->m_menureport_m->get_report_filename('OT-SMARTLAB-003');
            $this->load->view('pages/frontoffice_billing', $dt);
        }
    }
}
?>
