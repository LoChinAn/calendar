<?php	
	require_once ("lunercalendar.php");
	if(isset($_POST['Year']) && isset($_POST['Month'])){
		$Year = $_POST['Year'];
		$Month = $_POST['Month'];
	}
	else{
		$Year = date('Y');
		$Month = date('m');
	}
?>
<html>
	<head>  <title>萬年曆</title> </head>
	<body>
		<div style="text-align:center;margin-top:50px;font-size:30px;font-weight:bold;">
			I4A22&nbsp2006-2026年的萬年曆
		</div>
		<div style="text-align:center;margin-top:60px;font-size:20px;">
			<form method="POST" action="">
				選擇年分：
				<select name="Year" onchange="submit()">
					<?php
						for($i = 2006; $i <= 2026; $i++){							
							echo '<option value="' . $i. '"';
							if($i==$Year) echo 'selected';
							echo ">$i</option>\n";
						}
					?>					
				</select>
				選擇月份：
				<select name="Month" onchange="submit()">
					<?php
						for($j = 1; $j <= 12; $j++){							
							echo '<option value="' . $j. '"';
							if($j==$Month) echo 'selected';
							echo ">$j</option>\n";
						}
					?>					
				</select>
				<br />
				<br />				
			</form>
			
			<?php					
				$arrayMonth = array();					
				$FirstDayOfMonth = date('F', mktime(0, 0, 0, $Month, 1, $Year));
				$LastDate = date('j', mktime(0, 0, 0, $Month + 1, 0, $Year));				
				for($r = 0; $r < 6; $r++){
					for($c = 0; $c < 7; $c++){
						$arrayMonth[$r][$c] = '';
					}					
				}
				$r = 0;
				for($d = 1; $d <= $LastDate; $d++){
					$c = date('w', mktime(0, 0, 0, $Month, $d, $Year));
					if($c == 0 && $d > 1) $r++;
					$arrayMonth[$r][$c] = $d;					
				}					
			?>
			
			<?php 				
				echo $FirstDayOfMonth . ', ' . $Year;				
			?>
			<br /><br />
			<table width="550" border="1" align="center">
				<tr height="30" align="center">
					<td><font color="red">日</td>
					<td>一</td>
					<td>二</td>
					<td>三</td>
					<td>四</td>
					<td>五</td>
					<td><font color="red">六</td>
				</tr>						
				<?php					
					for($a = 0; $a < 6; $a++){								
						for($c = 0; $c < 7; $c++){								
							if($arrayMonth[$a][$c] == ''){
								if($c == 6) break;
								if($arrayMonth[$a][$c + 1] == '') $c++;									
							}								
							else{
								echo "<tr height = \"30\" align = \"center\">";
								for($b = 0; $b < 7; $b++){	
									$LDay = '';
									if (!empty($arrayMonth[$a][$b])){
										$DayOfMonth = date('Y-m-d', mktime(0,0,0,$Month,$arrayMonth[$a][$b],$Year));
										$LDay = GetLDay($DayOfMonth);										
									}	
									if($b == 0 || $b == 6){
										if($Year == date("Y") && $Month == date("m") && $arrayMonth[$a][$b] == date("d")){
											echo "<td bgcolor=\"#00FF00\" style =\"color:red\">";
										}
										else{
											echo "<td style =\"color:red\">"; 
										}										
									} 
									else{
										if($Year == date("Y") && $Month == date("m") && $arrayMonth[$a][$b] == date("d")){
											echo "<td bgcolor=\"#00FF00\">";
										}
										else{
											echo "<td>";
										}										
									}
									$arrayMonth[$a][$b] .= '<br />' . $LDay;
									echo $arrayMonth[$a][$b] . "</td>";																						
								}									
								echo "</tr>";
							break;
							}
						}							
					}										
				?>
			</table>	
		</div>		
	</body>
</html>
									
																		