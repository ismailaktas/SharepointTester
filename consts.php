<?php
class project
{
    const name = "SharePoint Upload Tester";
    const mainPageName = "SPTESTER";
    const baseUrl = "http://localhost/sptest/";
    const uploadFolder = "Uploads/";
    const deksisRootFolder = "/sptest"; //  serverda "" olacak
    const googleFont = "http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"; // serverda http:// yerine sadece // koymak gerekiyor
}

class sp {
    const WSDL = 'https://sharepointurl.com/_vti_bin/Lists.asmx?WSDL';
    const userName = 'sptest';
    const passWord = '***';
    const sharepointListName = 'spListName';
}


?>
