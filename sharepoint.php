<?php
use Thybag\SharePointAPI;
//require_once  'consts.php';

//require_once  dirname()..'/Library/sp/SharePointAPI.php';
//require_once dirname(dirname(__FILE__)) . "/sptest/Library/sp/SharePointAPI.php";
//dirname(dirname(__FILE__)) . "/sptest/sharepoint.php";

//echo "DDDDD: " . dirname(__FILE__) . "/Library/sp/src/Thybag/Auth/SoapClientAuth.php";

require_once dirname(__FILE__) . "/consts.php";
require_once dirname(__FILE__) . "/Library/sp/SharePointAPI.php";
require_once dirname(__FILE__) . "/Library/sp/src/Thybag/Auth/SoapClientAuth.php";


class sharePoint {
    
    public $splistName;
    
    public $ID;
    public $title;
    public $academicYear;
    public $courseCode;
    public $courseName;
    public $docType;
    public $attachment;
    public $postFileName;
    
    public function __construct($splistName,$itemID=NULL)
    {
        $this->ID=$itemID;
        $this->splistName=$splistName;
        $this->refresh();
    }
    
    function refresh() {
        $sp = new SharePointAPI(sp::userName, sp::passWord, sp::WSDL,'NTLM');
        if ($this->ID>0) {
            $result = $sp->read($this->splistName, 1, array('ID'=>$this->ID));
            $this->ID=$result[0]["ID"];
            $this->title=$result[0]["Title"];
            $this->academicYear=$result[0]["AcademicYear"];
            $this->courseCode=$result[0]["CourseCode"];
            $this->courseName=$result[0]["CourseName"];
            $this->docType=$result[0]["DocType"];
           // $this->attachment=$sp->getAttachments($this->splistName, $this->ID)[0];
        }
    }
    
    function save() {
        $sp = new SharePointAPI(sp::userName, sp::passWord, sp::WSDL,'NTLM');
        $fields = array('Title'=>$this->title,
                        'AcademicYear'=>$this->academicYear,
                         'CourseCode'=>$this->courseCode,
                         'CourseName'=>$this->courseName,
                         'DocType'=>$this->docType
        );
        if ($this->ID>0) {
            $result = $sp->update($this->splistName,$this->ID, $fields);
        } else {
             $result = $sp->write($this->splistName, $fields);
             $this->ID=$result[0]["id"];
        }
        if (isset($this->postFileName)) {
            if ($this->attachment!="") {
                $sp->deleteAttachment($this->splistName,$this->ID,$this->attachment);
            }
            if ($sp->addAttachment($this->splistName, $this->ID, $this->postFileName)) {
                $this->attachment=$sp->getAttachments($this->splistName, $this->ID)[0];
            } 
            
        }
        return $this->ID;
    }
    
    function delete() {
        $sp = new SharePointAPI(sp::userName, sp::passWord, sp::WSDL,'NTLM');
        $sp->delete($this->splistName, $this->ID);
        return $this->ID;
    }
    
}
?>
