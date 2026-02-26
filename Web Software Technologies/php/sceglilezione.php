<header>

</header>

<body>

	<link rel="stylesheet"
		  type="text/css"
		  href="../css/cssScegliLezione.css"
	>
	
	<div id="header">
		<td><a href="home.php"> <img src="../src/home.png"></a></td>
	</div>
	
	<div id="body">
		<table id="lezioni">
		<tr>
			<form id="myForm" action="seguilezione.php" method="POST">
			<td><button type="submit" name="Verbo" ><img src="../src/lezverbi.png"></button></td>
			<td><button type="submit" name="Nome"><img src="../src/leznomi.png"></button></td>
			<td><button type="submit" name="Aggettivo"><img src="../src/lezaggettivi.png"></button></td>
			</form>
			<td>
				<h1>Todo List Lezioni</h1>
				<h3>Aggiungi Lezione di</h3>
				
					<table id="selezione" >

					<tr>
					<td>
					<h3>Verbi</h3>
					<select id="verbi" name="verbi" onchange="handleAggiungiVerbi()">
						<option></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
					</td>
					
					<td>
					<h3>Aggettivi</h3>
					<select id="aggettivi" onchange="handleAggiungiAggettivi()">
						<option></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					</td>
					
					<td>
					<h3>Nomi</h3>
					<select id="nomi" onchange="handleAggiungiNomi()">
						<option></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					</td>
					</tr>
					
					<tr>
						<td><input id="risultato" type="text"></td>
					</tr>
					
			</td>
		</tr>
		</table>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



	<script>
		function handleAggiungiVerbi() {
			var req = new XMLHttpRequest();
			var str = document.getElementById("risultato").value;
			alert("contenuto inputtext: "+ str); 
			req.onreadystatechange = function() {
				if(req.readyState == 4 && req.status == 200){
					str = str + "\n" + req.responseText;
					alert("contenuto inputtext: "+ str);
				}
			}
			var dati = new formData();
			var valore = document.getElementById("verbi").value;
			dati.append("verbi", valore);
			req.open("POST", "selezione.php", true);
			req.send(dati);
		}
		
		
		function handleAggiungiAggettivi() {
			var req = new XMLHttpRequest();
			var str = document.getElementById("risultato").value;
			alert("contenuto inputtext: "+ str); 
			req.onreadystatechange = function() {
				if(req.readyState == 4 && req.status == 200){
					str = str + "\n" + req.responseText;
					alert("contenuto inputtext: "+ str);
				}
			}
			var dati = new formData();
			var valore = document.getElementById("aggettivi").value;
			dati.append("aggettivi", valore);
			req.open("POST", "selezione.php", true);
			req.send(dati);
		}
		
		function handleAggiungiNomi() {
			var req = new XMLHttpRequest();
			var str = document.getElementById("risultato").value;
			alert("contenuto inputtext: "+ str); 
			req.onreadystatechange = function() {
				if(req.readyState == 4 && req.status == 200){
					str = str + "\n" + req.responseText;
					alert("contenuto inputtext: "+ str);
				}
			}
			var dati = new formData();
			var valore = document.getElementById("nomi").value;
			dati.append("nomi", valore);
			req.open("POST", "selezione.php", true);
			req.send(dati);
		}
	</script>
</body>


</html>