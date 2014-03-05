<?php
class NeLinkLogCommand extends CConsoleCommand
{
    public function actionIndex($startdate,$enddate,$ipadd) {

        $Success = 0;
        $sql1 = "SELECT COUNT(tb2.counts) AS counts
                FROM (SELECT tb1.ATTRIB_TYPE_ID, tb1.ATTRIB_VALUE, COUNT(*) AS counts
                FROM
                  (SELECT 
                    b.id,
                    b.UPDATE_DATE,
                    b.IP_ADDR,
                    b.GROUP_ID AS GROUP_ID_ATTRIB,
                    b.ENTRY_ID,
                    b.ATTRIB_KEY_ID,
                    c.ATTRIB_TYPE_ID,
                    b.ATTRIB_VALUE 
                  FROM
                    NE_LINK_RULE a,
                    NE_RUN_ATTRIB b,
                    ATTRIB_LIST c 
                  WHERE a.NE_RUN_TYPE_ID = b.NE_RUN_TYPE_ID 
                    AND IF(a.GROUP_ID IS NULL, '', a.GROUP_ID) = IF(b.GROUP_ID IS NULL, '', b.GROUP_ID) 
                    AND a.ATTRIB_KEY_ID = b.ATTRIB_KEY_ID 
                    AND b.ATTRIB_KEY_ID = c.ID ";
        if($startdate!="" and $enddate!=""){
            $sql1 .= "AND b.UPDATE_DATE  BETWEEN '$startdate' AND '$enddate' ";
        }
        if($ipadd!="" and $ipadd!="null" and $ipadd!="NULL"){
            $sql1 .= "AND b.IP_ADDR='$ipadd' ";
        }
                    
          $sql1 .= "ORDER BY b.ID ASC) tb1, (SELECT DISTINCT ATTRIB_TYPE_ID FROM ATTRIB_LIST) d 
                WHERE tb1.ATTRIB_TYPE_ID = d.ATTRIB_TYPE_ID 
                GROUP BY tb1.ATTRIB_TYPE_ID,
                  tb1.ATTRIB_VALUE 
                HAVING COUNT(*) > 1 
                ORDER BY d.ATTRIB_TYPE_ID ASC, tb1.ATTRIB_VALUE) AS tb2";
        $query1 = Yii::app()->db->createCommand($sql1)->queryAll();

        for($LoopAmountAll = 0;$LoopAmountAll< $query1[0]["counts"];$LoopAmountAll++){
            
                $sql2 = "SELECT tb1.ATTRIB_TYPE_ID, tb1.ATTRIB_VALUE, COUNT(*) counts
                        FROM
                          (SELECT b.id, b.UPDATE_DATE, b.IP_ADDR, b.GROUP_ID AS GROUP_ID_ATTRIB, b.ENTRY_ID, b.ATTRIB_KEY_ID, c.ATTRIB_TYPE_ID, b.ATTRIB_VALUE 
                          FROM NE_LINK_RULE a, NE_RUN_ATTRIB b, ATTRIB_LIST c 
                          WHERE a.NE_RUN_TYPE_ID = b.NE_RUN_TYPE_ID 
                            AND IF(a.GROUP_ID IS NULL, '', a.GROUP_ID) = IF(b.GROUP_ID IS NULL, '', b.GROUP_ID) 
                            AND a.ATTRIB_KEY_ID = b.ATTRIB_KEY_ID 
                            AND b.ATTRIB_KEY_ID = c.ID ";
                if($startdate!="" and $enddate!=""){
                    $sql2 .= "AND b.UPDATE_DATE  BETWEEN '$startdate' AND '$enddate' ";
                }
                if($ipadd!="" and $ipadd!="null" and $ipadd!="NULL"){
                    $sql2 .= "AND b.IP_ADDR='$ipadd' ";
                }

              $sql2 .= "ORDER BY b.ID ASC) tb1, (SELECT DISTINCT ATTRIB_TYPE_ID FROM ATTRIB_LIST) d 
                        WHERE tb1.ATTRIB_TYPE_ID = d.ATTRIB_TYPE_ID 
                        GROUP BY tb1.ATTRIB_TYPE_ID,
                          tb1.ATTRIB_VALUE 
                        HAVING COUNT(*) > 1 
                        ORDER BY d.ATTRIB_TYPE_ID ASC, tb1.ATTRIB_VALUE LIMIT $LoopAmountAll,1";
                $query2 = Yii::app()->db->createCommand($sql2)->queryAll();
                $ATTRIB_TYPE_ID = $query2[0][ATTRIB_TYPE_ID];
                $ATTRIB_VALUE = $query2[0][ATTRIB_VALUE];
                
		$CountSub = 0;
		
		$SRC_IP_ADDR = "";
		$SRC_GROUP_ID = "";
		$SRC_ENT_ID = "";
		$SRC_ATTRIB_KEY_ID = "";
		
		$DEST_IP_ADDR = "";
		$DEST_GROUP_ID = "";
		$DEST_ENT_ID = "";
		$DEST_ATTRIB_KEY_ID = "";
                   
                for($LoopAmountSub = 0;$LoopAmountSub< $query2[0]["counts"];$LoopAmountSub++){
            
                    $CountSub = $CountSub + 1;

                    
                    if($CountSub==1){
                        $sql3 = "SELECT tb1.IP_ADDR,tb1.GROUP_ID_ATTRIB,tb1.ENTRY_ID,tb1.ATTRIB_KEY_ID
				FROM
				  (SELECT 
				    b.id,b.UPDATE_DATE,b.IP_ADDR,b.GROUP_ID AS GROUP_ID_ATTRIB,b.ENTRY_ID,b.ATTRIB_KEY_ID,c.ATTRIB_TYPE_ID,b.ATTRIB_VALUE 
				  FROM NE_LINK_RULE a, NE_RUN_ATTRIB b, ATTRIB_LIST c 
				  WHERE a.NE_RUN_TYPE_ID = b.NE_RUN_TYPE_ID 
				    AND IF(a.GROUP_ID IS NULL, '', a.GROUP_ID) = IF(b.GROUP_ID IS NULL, '', b.GROUP_ID) 
				    AND a.ATTRIB_KEY_ID = b.ATTRIB_KEY_ID 
				    AND b.ATTRIB_KEY_ID = c.ID ";
                        if($startdate!="" and $enddate!=""){
                            $sql3 .= "AND b.UPDATE_DATE  BETWEEN '$startdate' AND '$enddate' ";
                        }
                        if($ipadd!="" and $ipadd!="null" and $ipadd!="NULL"){
                            $sql3 .= "AND b.IP_ADDR='$ipadd' ";
                        }

                        $sql3 .= "ORDER BY b.ID ASC) tb1, (SELECT DISTINCT ATTRIB_TYPE_ID FROM ATTRIB_LIST) d 
				WHERE tb1.ATTRIB_TYPE_ID = d.ATTRIB_TYPE_ID 
				AND tb1.ATTRIB_TYPE_ID = '$ATTRIB_TYPE_ID' AND tb1.ATTRIB_VALUE = '$ATTRIB_VALUE'
				ORDER BY tb1.ID ASC LIMIT $LoopAmountSub,1";
                        $query3 = Yii::app()->db->createCommand($sql3)->queryAll();
                        
                        $SRC_IP_ADDR = $query3[0][IP_ADDR];
                        $SRC_GROUP_ID = $query3[0][GROUP_ID_ATTRIB];
                        $SRC_ENT_ID = $query3[0][ENTRY_ID];
                        $SRC_ATTRIB_KEY_ID = $query3[0][ATTRIB_KEY_ID];
                    }elseif($CountSub==2){
                        $sql4 = "SELECT tb1.IP_ADDR,tb1.GROUP_ID_ATTRIB,tb1.ENTRY_ID,tb1.ATTRIB_KEY_ID
				FROM
				  (SELECT 
				    b.id,b.UPDATE_DATE,b.IP_ADDR,b.GROUP_ID AS GROUP_ID_ATTRIB,b.ENTRY_ID,b.ATTRIB_KEY_ID,c.ATTRIB_TYPE_ID,b.ATTRIB_VALUE 
				  FROM NE_LINK_RULE a, NE_RUN_ATTRIB b, ATTRIB_LIST c 
				  WHERE a.NE_RUN_TYPE_ID = b.NE_RUN_TYPE_ID 
				    AND IF(a.GROUP_ID IS NULL, '', a.GROUP_ID) = IF(b.GROUP_ID IS NULL, '', b.GROUP_ID) 
				    AND a.ATTRIB_KEY_ID = b.ATTRIB_KEY_ID 
				    AND b.ATTRIB_KEY_ID = c.ID ";
                        if($startdate!="" and $enddate!=""){
                            $sql4 .= "AND b.UPDATE_DATE  BETWEEN '$startdate' AND '$enddate' ";
                        }
                        if($ipadd!="" and $ipadd!="null" and $ipadd!="NULL"){
                            $sql4 .= "AND b.IP_ADDR='$ipadd' ";
                        }

                        $sql4 .= "ORDER BY b.ID ASC) tb1, (SELECT DISTINCT ATTRIB_TYPE_ID FROM ATTRIB_LIST) d 
				WHERE tb1.ATTRIB_TYPE_ID = d.ATTRIB_TYPE_ID 
				AND tb1.ATTRIB_TYPE_ID = '$ATTRIB_TYPE_ID' AND tb1.ATTRIB_VALUE = '$ATTRIB_VALUE'
				ORDER BY tb1.ID ASC LIMIT $LoopAmountSub,1";
                        $query4 = Yii::app()->db->createCommand($sql4)->queryAll();
                        
                        $DEST_IP_ADDR = $query4[0][IP_ADDR];
                        $DEST_GROUP_ID = $query4[0][GROUP_ID_ATTRIB];
                        $DEST_ENT_ID = $query4[0][ENTRY_ID];
                        $DEST_ATTRIB_KEY_ID = $query4[0][ATTRIB_KEY_ID];
                        
                        $sql5 = "SELECT COUNT(*) AS countLog
				FROM NE_LINK_LOG 
				WHERE 
				(IF(SRC_IP_ADDR IS NULL, '', SRC_IP_ADDR) IN ('$SRC_IP_ADDR','$DEST_IP_ADDR') AND 
				 IF(SRC_GROUP_ID IS NULL, '', SRC_GROUP_ID) IN ('$SRC_GROUP_ID','$DEST_GROUP_ID') AND 
				 IF(SRC_ENT_ID IS NULL, '', SRC_ENT_ID) IN ('$SRC_ENT_ID','$DEST_ENT_ID') AND 
				 IF(SRC_ATTRIB_KEY_ID IS NULL, '', SRC_ATTRIB_KEY_ID) IN ('$SRC_ATTRIB_KEY_ID','$DEST_ATTRIB_KEY_ID'))
				 AND
				 (IF(DEST_IP_ADDR IS NULL, '', DEST_IP_ADDR) IN ('$SRC_IP_ADDR','$DEST_IP_ADDR') AND 
				 IF(DEST_GROUP_ID IS NULL, '', DEST_GROUP_ID) IN ('$SRC_GROUP_ID','$DEST_GROUP_ID') AND 
				 IF(DEST_ENT_ID IS NULL, '', DEST_ENT_ID) IN ('$SRC_ENT_ID','$DEST_ENT_ID') AND 
				 IF(DEST_ATTRIB_KEY_ID IS NULL, '', DEST_ATTRIB_KEY_ID) IN ('$SRC_ATTRIB_KEY_ID','$DEST_ATTRIB_KEY_ID'))";
                        $query5 = Yii::app()->db->createCommand($sql5)->queryAll();
                        
                        if($SRC_IP_ADDR==''){$SRC_IP_ADDR='NULL';}else{$SRC_IP_ADDR="'$SRC_IP_ADDR'";}
                        if($SRC_GROUP_ID==''){$SRC_GROUP_ID='NULL';}else{$SRC_GROUP_ID="'$SRC_GROUP_ID'";}
                        if($SRC_ENT_ID==''){$SRC_ENT_ID='NULL';}else{$SRC_ENT_ID="'$SRC_ENT_ID'";}
                        if($SRC_ATTRIB_KEY_ID==''){$SRC_ATTRIB_KEY_ID='NULL';}else{$SRC_ATTRIB_KEY_ID="'$SRC_ATTRIB_KEY_ID'";}
                        if($DEST_IP_ADDR==''){$DEST_IP_ADDR='NULL';}else{$DEST_IP_ADDR="'$DEST_IP_ADDR'";}
                        if($DEST_GROUP_ID==''){$DEST_GROUP_ID='NULL';}else{$DEST_GROUP_ID="'$DEST_GROUP_ID'";}
                        if($DEST_ENT_ID==''){$DEST_ENT_ID='NULL';}else{$DEST_ENT_ID="'$DEST_ENT_ID'";}
                        if($DEST_ATTRIB_KEY_ID==''){$DEST_ATTRIB_KEY_ID='NULL';}else{$DEST_ATTRIB_KEY_ID="'$DEST_ATTRIB_KEY_ID'";}
                        
                        if($query5[0][countLog]==0){
                             $sql = "INSERT INTO NE_LINK_LOG 
                                    (SRC_IP_ADDR,SRC_GROUP_ID,SRC_ENT_ID,SRC_ATTRIB_KEY_ID,DEST_IP_ADDR,DEST_GROUP_ID,DEST_ENT_ID,DEST_ATTRIB_KEY_ID)
                                    VALUES
                                    ($SRC_IP_ADDR,$SRC_GROUP_ID,$SRC_ENT_ID,$SRC_ATTRIB_KEY_ID,$DEST_IP_ADDR,$DEST_GROUP_ID,$DEST_ENT_ID,$DEST_ATTRIB_KEY_ID)";
                             Yii::app()->db->createCommand($sql)->execute();
                             $Success = $Success + 1;
                        }
                    }else{
                        $LoopAmountSubs = $LoopAmountSub - 1;
                        $sql6 = "SELECT tb1.IP_ADDR,tb1.GROUP_ID_ATTRIB,tb1.ENTRY_ID,tb1.ATTRIB_KEY_ID
				FROM
				  (SELECT 
				    b.id,b.UPDATE_DATE,b.IP_ADDR,b.GROUP_ID AS GROUP_ID_ATTRIB,b.ENTRY_ID,b.ATTRIB_KEY_ID,c.ATTRIB_TYPE_ID,b.ATTRIB_VALUE 
				  FROM NE_LINK_RULE a, NE_RUN_ATTRIB b, ATTRIB_LIST c 
				  WHERE a.NE_RUN_TYPE_ID = b.NE_RUN_TYPE_ID 
				    AND IF(a.GROUP_ID IS NULL, '', a.GROUP_ID) = IF(b.GROUP_ID IS NULL, '', b.GROUP_ID) 
				    AND a.ATTRIB_KEY_ID = b.ATTRIB_KEY_ID 
				    AND b.ATTRIB_KEY_ID = c.ID ";
                        if($startdate!="" and $enddate!=""){
                            $sql6 .= "AND b.UPDATE_DATE  BETWEEN '$startdate' AND '$enddate' ";
                        }
                        if($ipadd!="" and $ipadd!="null" and $ipadd!="NULL"){
                            $sql6 .= "AND b.IP_ADDR='$ipadd' ";
                        }

                        $sql6 .= "ORDER BY b.ID ASC) tb1, (SELECT DISTINCT ATTRIB_TYPE_ID FROM ATTRIB_LIST) d 
				WHERE tb1.ATTRIB_TYPE_ID = d.ATTRIB_TYPE_ID 
				AND tb1.ATTRIB_TYPE_ID = '$ATTRIB_TYPE_ID' AND tb1.ATTRIB_VALUE = '$ATTRIB_VALUE'
				ORDER BY tb1.ID ASC LIMIT $LoopAmountSubs,1";
                        $query6 = Yii::app()->db->createCommand($sql6)->queryAll();
                        
                        $SRC_IP_ADDR = $query6[0][IP_ADDR];
                        $SRC_GROUP_ID = $query6[0][GROUP_ID_ATTRIB];
                        $SRC_ENT_ID = $query6[0][ENTRY_ID];
                        $SRC_ATTRIB_KEY_ID = $query6[0][ATTRIB_KEY_ID];
                        
                        $sql7 = "SELECT tb1.IP_ADDR,tb1.GROUP_ID_ATTRIB,tb1.ENTRY_ID,tb1.ATTRIB_KEY_ID
				FROM
				  (SELECT 
				    b.id,b.UPDATE_DATE,b.IP_ADDR,b.GROUP_ID AS GROUP_ID_ATTRIB,b.ENTRY_ID,b.ATTRIB_KEY_ID,c.ATTRIB_TYPE_ID,b.ATTRIB_VALUE 
				  FROM NE_LINK_RULE a, NE_RUN_ATTRIB b, ATTRIB_LIST c 
				  WHERE a.NE_RUN_TYPE_ID = b.NE_RUN_TYPE_ID 
				    AND IF(a.GROUP_ID IS NULL, '', a.GROUP_ID) = IF(b.GROUP_ID IS NULL, '', b.GROUP_ID) 
				    AND a.ATTRIB_KEY_ID = b.ATTRIB_KEY_ID 
				    AND b.ATTRIB_KEY_ID = c.ID ";
                        if($startdate!="" and $enddate!=""){
                            $sql7 .= "AND b.UPDATE_DATE  BETWEEN '$startdate' AND '$enddate' ";
                        }
                        if($ipadd!="" and $ipadd!="null" and $ipadd!="NULL"){
                            $sql7 .= "AND b.IP_ADDR='$ipadd' ";
                        }

                        $sql7 .= "ORDER BY b.ID ASC) tb1, (SELECT DISTINCT ATTRIB_TYPE_ID FROM ATTRIB_LIST) d 
				WHERE tb1.ATTRIB_TYPE_ID = d.ATTRIB_TYPE_ID 
				AND tb1.ATTRIB_TYPE_ID = '$ATTRIB_TYPE_ID' AND tb1.ATTRIB_VALUE = '$ATTRIB_VALUE'
				ORDER BY tb1.ID ASC LIMIT $LoopAmountSub,1";
                        $query7 = Yii::app()->db->createCommand($sql7)->queryAll();
                        
                        $DEST_IP_ADDR = $query7[0][IP_ADDR];
                        $DEST_GROUP_ID = $query7[0][GROUP_ID_ATTRIB];
                        $DEST_ENT_ID = $query7[0][ENTRY_ID];
                        $DEST_ATTRIB_KEY_ID = $query7[0][ATTRIB_KEY_ID];
                        

                        $sql8 = "SELECT COUNT(*) AS countLog
				FROM NE_LINK_LOG 
				WHERE 
				(IF(SRC_IP_ADDR IS NULL, '', SRC_IP_ADDR) IN ('$SRC_IP_ADDR','$DEST_IP_ADDR') AND 
				 IF(SRC_GROUP_ID IS NULL, '', SRC_GROUP_ID) IN ('$SRC_GROUP_ID','$DEST_GROUP_ID') AND 
				 IF(SRC_ENT_ID IS NULL, '', SRC_ENT_ID) IN ('$SRC_ENT_ID','$DEST_ENT_ID') AND 
				 IF(SRC_ATTRIB_KEY_ID IS NULL, '', SRC_ATTRIB_KEY_ID) IN ('$SRC_ATTRIB_KEY_ID','$DEST_ATTRIB_KEY_ID'))
				 AND
				 (IF(DEST_IP_ADDR IS NULL, '', DEST_IP_ADDR) IN ('$SRC_IP_ADDR','$DEST_IP_ADDR') AND 
				 IF(DEST_GROUP_ID IS NULL, '', DEST_GROUP_ID) IN ('$SRC_GROUP_ID','$DEST_GROUP_ID') AND 
				 IF(DEST_ENT_ID IS NULL, '', DEST_ENT_ID) IN ('$SRC_ENT_ID','$DEST_ENT_ID') AND 
				 IF(DEST_ATTRIB_KEY_ID IS NULL, '', DEST_ATTRIB_KEY_ID) IN ('$SRC_ATTRIB_KEY_ID','$DEST_ATTRIB_KEY_ID'))";
                        $query8 = Yii::app()->db->createCommand($sql8)->queryAll();
                         
                        
                        if($SRC_IP_ADDR==''){$SRC_IP_ADDR='NULL';}else{$SRC_IP_ADDR="'$SRC_IP_ADDR'";}
                        if($SRC_GROUP_ID==''){$SRC_GROUP_ID='NULL';}else{$SRC_GROUP_ID="'$SRC_GROUP_ID'";}
                        if($SRC_ENT_ID==''){$SRC_ENT_ID='NULL';}else{$SRC_ENT_ID="'$SRC_ENT_ID'";}
                        if($SRC_ATTRIB_KEY_ID==''){$SRC_ATTRIB_KEY_ID='NULL';}else{$SRC_ATTRIB_KEY_ID="'$SRC_ATTRIB_KEY_ID'";}
                        if($DEST_IP_ADDR==''){$DEST_IP_ADDR='NULL';}else{$DEST_IP_ADDR="'$DEST_IP_ADDR'";}
                        if($DEST_GROUP_ID==''){$DEST_GROUP_ID='NULL';}else{$DEST_GROUP_ID="'$DEST_GROUP_ID'";}
                        if($DEST_ENT_ID==''){$DEST_ENT_ID='NULL';}else{$DEST_ENT_ID="'$DEST_ENT_ID'";}
                        if($DEST_ATTRIB_KEY_ID==''){$DEST_ATTRIB_KEY_ID='NULL';}else{$DEST_ATTRIB_KEY_ID="'$DEST_ATTRIB_KEY_ID'";}
                        
                        if($query8[0][countLog]==0){
                            $sql = "INSERT INTO NE_LINK_LOG 
                                    (SRC_IP_ADDR,SRC_GROUP_ID,SRC_ENT_ID,SRC_ATTRIB_KEY_ID,DEST_IP_ADDR,DEST_GROUP_ID,DEST_ENT_ID,DEST_ATTRIB_KEY_ID)
                                    VALUES
                                    ($SRC_IP_ADDR,$SRC_GROUP_ID,$SRC_ENT_ID,$SRC_ATTRIB_KEY_ID,$DEST_IP_ADDR,$DEST_GROUP_ID,$DEST_ENT_ID,$DEST_ATTRIB_KEY_ID)";
                            Yii::app()->db->createCommand($sql)->execute();
                            $Success = $Success + 1;
                        }
                    }
                }
            
        }         
        echo "Insert $Success Record";
    }
}
?>
