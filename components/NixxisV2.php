<?php

namespace app\components;

use yii\db\mssql\PDO;

/**
 * Description of nixxisv2
 *
 * @author gpouilly
 */
class NixxisV2 {

    //put your code here
    private $_db;
    private $_AppServer;
    private $_SqlServer;
    private $_Username;
    private $_Password;
    private $_ContextDataUrl;
    var $qualifications = array();
    public $_Nixxis_OnlineTime;

    public function ConnectSqlServer() {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {

            $this->_db = new PDO("dblib:host=10.100.30.11;", "$this->_Username", "$this->_Password", $opt);
            //$this->_Nixxis_OnlineTime = new Nixxis_TimeManagement($this->_db);
        } catch (\PDOException $e) {
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }
    }

    public function ReportQuery($Query) {
        try {
            $statement = $this->_db->prepare($Query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $Query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    /*
     * Returns the database fields of the table Data & SystemData for a campaign
     * Return NULL if database not found or if error occurs
     * Add D. for the data table
     * Add SD. for the systemdata table
     * @return array()
     */

    public function Describe_CampaignData($CampaignId) {
        if ($CampaignId != '') {
            $query = "SELECT T.name as TableName, C.column_id as object_id, C.name as ColumnName "
                    . "FROM Data_" . $CampaignId . ".sys.columns C "
                    . "inner join Data_" . $CampaignId . ".sys.tables T ON (C.object_id = T.object_id) "
                    . "WHERE C.object_id = OBJECT_ID('Data_" . $CampaignId . "..Data') "
                    . "OR C.object_id = OBJECT_ID('Data_" . $CampaignId . "..SystemData') ";
            try {
                $statement = $this->_db->prepare($query);
                $statement->execute();
                $datas = $statement->fetchAll();
                $i = 1;
                foreach ($datas as &$data) {
                    if ($data['TableName'] == 'Data') {
                        $data['ColumnName'] = 'D.' . $data['ColumnName'];
                    } else {
                        $data['ColumnName'] = 'SD.' . $data['ColumnName'];
                    }

                    $data['object_id'] = $i;
                    $i++;
                }

                return $datas;
            } catch (\PDOException $e) {
                echo $query . PHP_EOL;
                echo $e->getMessage();
                return NULL;
            }
        } else
            return NULL;
    }

    /*
     * Returns the database fields of the table Data for a campaign
     * Return NULL if database not found or if error occurs
     * Add OUTC. for the Out_Contact table
     * Add INC. for the In_Contact table
     * Add TRAILS. for the OUT_TRAILS_Contact table
     *
     * @return array()
     */

    public function Describe_NixxisTable($DatabaseName, $TableName) {
        if ($TableName != '' && $DatabaseName != '') {
            $query = "SELECT T.name as TableName, C.column_id as object_id, C.name as ColumnName "
                    . "FROM " . $DatabaseName . ".sys.columns C "
                    . "inner join " . $DatabaseName . ".sys.tables T ON (C.object_id = T.object_id) "
                    . "WHERE C.object_id = OBJECT_ID('" . $DatabaseName . ".." . $TableName . "') ";
            try {
                $statement = $this->_db->prepare($query);
                $statement->execute();
                $datas = $statement->fetchAll();
                $i = 1;
                foreach ($datas as &$data) {
                    switch ($data['TableName']) {
                        case 'OUT_Contact':
                            $data['ColumnName'] = 'OUTC.' . $data['ColumnName'];
                            break;
                        case 'OUT_TRAILS_Contact':
                            $data['ColumnName'] = 'TRAIL.' . $data['ColumnName'];
                            break;
                        case 'IN_Contact':
                            $data['ColumnName'] = 'INC.' . $data['ColumnName'];
                            break;
                    }
                    $data['object_id'] = $i;
                    $i++;
                }
                return $datas;
            } catch (PDOException $e) {
                echo $query . PHP_EOL;
                echo $e->getMessage();
                return NULL;
            }
        } else
            return NULL;
    }

    public function GetList_Agents($Active = 1) {
        $query = "SELECT * FROM admin.dbo.Agents";
        if ($Active == 1)
            $query .= " where Active=$Active";
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    public function GetList_Campaigns($Active = 1) {
        $query = "SELECT Id,description FROM admin.dbo.Campaigns where Active=$Active ORDER BY Description";
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    public function GetList_Activities($CampaignId, $Active = 1) {
        $query = "SELECT Id,Description FROM admin.dbo.Activities where Active=$Active AND CampaignId='$CampaignId' ORDER BY Description";
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    // TO DO Replace with Describe_CampaignData
    public function GetList_Fields($CampaignId) {
        $query = "USE Data_$CampaignId;";
        $query2 = "SELECT COLUMN_NAME 'Description' FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='Data'";

        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            $statement = $this->_db->prepare($query2);
            $statement->execute();

            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    public function GetWorkingAgents($campaignId, $activities_array, $startdatetime, $enddatetime) {

        $query = "USE ContactRouteReport";
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
        $query = "select OUTC.OrigQualOriginatorid,Agents.account,Agents.FirstName,Agents.LastName from ContactRouteReport..Out_Contact OUTC
                    inner join Admin..Agents Agents on (Agents.Id = OUTC.OrigQualOriginatorid collate Latin1_General_BIN)
                    where OUTC.CampaignId='$campaignId'
                    group by OUTC.OrigQualOriginatorid,Agents.account,Agents.FirstName,Agents.LastName";

        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    private static function compare_qual_positive($a, $b) {
        return ($a['Positive'] < $b['Positive']);
    }

    public function ContextData_GetNixxisQualifications($Activity) {
        $curl = curl_init();
        $url = null;
        $url .= $this->_ContextDataUrl . '?';
        $url .= 'action=GetQualifications';
        $url .= '&activity=' . $Activity;

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ));

//        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
//        curl_setopt($curl, CURLOPT_TIMEOUT, 12);
        $resp = curl_exec($curl);



        $Qualifications = new \SimpleXMLElement($resp);

        foreach ($Qualifications->qualification->qualification as $GroupQualifications) {
            foreach ($GroupQualifications->qualification as $Qualification) {
                $tmp = [
                    'Id' => (string) $Qualification['id'],
                    'Description' => (string) $Qualification,
                    'Action' => (string) $Qualification['action'],
                    'Positive' => (string) $Qualification['positive'],
                    'CustomValue' => (string) $Qualification['customValue'],
                    'Argued' => (string) $Qualification['argued'],
                ];
                $this->qualifications[$tmp['Id']] = $tmp;
            }
        }
        return $this->qualifications;
    }

    public function GetList_Qualifications($CampaignId, $ActivityId = '') {
        $QualificationsList = array();
        $query = "select Qualification from Admin.dbo.Campaigns where id='" . $CampaignId . "'";
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result) {
                $root = $result[0]['Qualification'];
                $count = $this->GetChilds($root, $CampaignId);
                uasort($this->qualifications, array('self', 'compare_qual_positive'));
                return $this->qualifications;
            } else
                return NULL;
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }


        //print_r($this->qualifications);
    }

    private function GetChilds($root, $CampaignId, $filterpositive = '') {
        $query = "select Id,Description,Action,Positive from Admin.dbo.Qualifications where Active=1 and Parent='" . $root . "'";


        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            foreach ($results as $result) {
                //print_r($result);
                if ($result['Action'] != 0) {
                    if ($filterpositive) {
                        if ($filterpositive == $result['Positive']) {
                            array_push($this->qualifications, $result);
                            $this->GetChilds($result['Id'], $CampaignId, $filterpositive);
                        }
                    } else {
                        array_push($this->qualifications, $result);
                        $this->GetChilds($result['Id'], $CampaignId, $filterpositive);
                    }
                }
                $this->GetChilds($result['Id'], $CampaignId, $filterpositive);
            }
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
        return 0;
    }

    public function GetWorkingPeriod_Activity($ActivityId) {
        $query = "SELECT MIN(LocalDateTime) AS STARTDATE,MAX(LocalDateTime) AS ENDDATE
                  FROM ContactRouteReport.dbo.OUT_Contact
                  WHERE ActivityId='$ActivityId'";
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    public function GetList_Agents_Activity_Period($ActivityId, $Start_DateTime, $End_DateTime) {
        $query = "SELECT A.QualOriginatorId,B.FirstName,B.LastName,B.Account
                    FROM ContactRouteReport.dbo.Out_Contact A, Admin.dbo.Agents B
                    WHERE ActivityId='$ActivityId'
                    AND A.QualOriginatorId COLLATE Latin1_General_BIN =B.Id
                    AND LocalDateTime >= {ts'$Start_DateTime'}
                    AND LocalDateTime < {ts'$End_DateTime'}
                    GROUP BY A.QualOriginatorId,B.FirstName,B.LastName,B.Account";
        echo $query;
        try {
            $statement = $this->_db->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $query . PHP_EOL;
            echo $e->getMessage();
        }
    }

    public function setDb($db) {
        $this->_db = $db;
    }

    public function setAppServer($AppServer) {
        $this->_AppServer = $AppServer;
    }

    public function setSqlServer($SqlServer) {
        $this->_SqlServer = $SqlServer;
    }

    public function setUsername($Username) {
        $this->_Username = $Username;
    }

    public function setPassword($Password) {
        $this->_Password = $Password;
    }

    function setContextDataUrl($ContextDataUrl) {
        $this->_ContextDataUrl = $ContextDataUrl;
    }

}

// Get Data table for a contact
// http://nixxisapp.talk.intra:8088/data/?action=GetContextData&context=ff829a7f46804d40b76f82a2c4afd8ad&id=20c4e81e72714931a19c75ac56495ae5