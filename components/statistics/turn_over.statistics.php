<?php


function list_statistic_turn_over(){
    
	my_set_code_js('
		function confirmDelete(id){
            var t = confirm(\'Yakin akan menghapus data ?\');
                if(t){
                    location.href=\'index.php?com='.$_GET['com'].'&task=delete&id=\'+id;
                }
                return false;
            }
        ');	
    
	$headers= array( 
		'Date' => array( 'style' => 'width:30%;text-align:center;' ), 
		'Win amount' => array( 'style' => 'width:70%;text-align:right;' ),
        
	);

	
	
	$query 	= "SELECT DATE(ts) as ts, SUM(winAmount) as winAmount from player_history  group by DATE(ts) ORDER BY winAmount ASC LIMIT 15";
    $result = my_query($query);
    
	$row = array();
	while($ey = my_fetch_array($result)){ 

         
		$row[] = array( 
            'tanggal' => position_text_align($ey['ts'], 'center' ),
            'winamount' => position_text_align( rp_format($ey['winAmount']),  'right') 
		);
	}
	
	$datas = table_rows($row);
    
	return table_builder($headers , $datas , 9, false   ); 
}