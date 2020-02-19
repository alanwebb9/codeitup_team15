<?php 
class Person {
	//class properties

	private $Archive_Date,$Group,
                $Hospital_HIPE,$Hospital,
                $Specialty_HIPE1,$Speciality,
                $Adult_Child,$Age_Profile,
                $Time_Bands,$Total;
        
	//constructor
	function __construct($Archive_Date,$Group,
                $Hospital_HIPE,$Hospital,
                $Specialty_HIPE1,$Speciality,
                $Adult_Child,$Age_Profile,
                $Time_Bands,$Total) 
                
                
	{  
	
            $this->set_ArchiveDate($Archive_Date);
            $this->set_Group($Group);
            $this->set_Hospital_Hipe($Hospital_HIPE);
            $this->set_Hospital($Hospital);
            $this->set_Speciality_Hipe1($Specialty_HIPE1);
            $this->set_Speciality($Speciality);
            $this->set_Adult_Child($Adult_Child);
            $this->set_Age_Profile($Age_Profile);
            $this->set_Time_Bands($Time_Bands);
            $this->set_Total($Total);
            
	}
	
	//class methods
	
	//getters
	public function get_ArchiveDate() {	
		return $this->Archive_Date;
	}
	
	public function get_Group() {	
		return $this->Group;
	}
        
        public function get_Hospital_Hipe() {	
		return $this->Hospital_HIPE;
	}
        public function get_Hospital() {	
		return $this->Hospital;
	}
        public function get_Speciality_Hipe1() {	
		return $this->Specialty_HIPE1;
	}
        public function get_Speciality() {	
		return $this->Speciality;
	}
        public function get_Adult_Child() {	
		return $this->Adult_Child;
	}
        public function get_Age_Profile() {	
		return $this->Age_Profile;
	}
        public function get_Time_Bands() {	
		return $this->Time_Bands;
	}
        public function get_Total() {	
		return $this->Total;
	}
        
        
        
        
        
        
        
        public function set_ArchiveDate($nr) {	
		return $this->Archive_Date=$nr;
	}
	
	public function set_Group($group) {	
		return $this->Group=$group;
	}
        
        public function set_Hospital_Hipe($HG) {	
		return $this->Hospital_HIPE=$HG;
	}
        public function set_Hospital($H) {	
		return $this->Hospital=$H;
	}
        public function set_Speciality_Hipe1($SH) {	
		return $this->Specialty_HIPE1=$SH;
	}
        public function set_Speciality($s) {	
		return $this->Speciality=$s;
	}
        public function set_Adult_Child($AC) {	
		return $this->Adult_Child=$AC;
	}
        public function set_Age_Profile($AP) {	
		return $this->Age_Profile=$AP;
	}
        public function set_Time_Bands($TB) {	
		return $this->Time_Bands=$TB;
	}
        public function set_Total($T) {	
		return $this->Total=$T;
	}
        
        
	
	
}  //end class Person
