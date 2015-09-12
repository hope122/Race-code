<?php		
	//資料庫連線
	/*	public function Data2Array($conn, $strSQL, $kind=0, $pk=NULL){
			$data = NULL;
			if( !empty($strSQL) ){
				$stmt = $conn->query($strSQL);
				$i=0;
				if( $stmt and $stmt->num_rows){
					while ($ar = $stmt->fetch_array(MYSQLI_ASSOC)) {
						$j=0;
						foreach($ar as $key=>$val){
							//echo $key."=>".$val;
							if( !empty($pk) ){
								$p = $ar[$pk];
								if($kind==0) $data[$p][$key]=$val;
								elseif($kind==1) $data[$p][$j]=$val;
							}
							else{
								if($kind==0) $data[$i][$key]=$val;
								elseif($kind==1) $data[$i][$j]=$val;
							}
							$j++;
						}
						$i++;
					}
				}
			}
			return $data;	
		}
*/
?>