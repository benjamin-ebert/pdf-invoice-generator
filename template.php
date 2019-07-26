<!DOCTYPE html>
<html lang="de">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>

    body {
        height: 337mm;
        width: 210mm;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        font-family: Helvetica N
    }

    h1 {
    	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
    	font-size: 24px; 
    	font-style: normal; 
    	font-variant: normal;
    	font-weight: bold; 
    	line-height: 26px; 
    } 
    
    h3 {
    	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
    	font-size: 14px; 
    	font-style: normal; 
    	font-variant: normal; 
    	font-weight: bold; 
    	line-height: 15px;
    } 

    p, table {
    	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
    	font-size: 14px; 
    	font-style: normal; 
    	font-variant: normal; 
    	font-weight: 400; 
    	line-height: 20px; 
    } 

    blockquote { 
    	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
    	font-size: 21px; 
    	font-style: normal; 
    	font-variant: normal; 
    	font-weight: 400; 
    	line-height: 30px; 
    } 

    pre { 
    	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
    	font-size: 13px; 
    	font-style: normal; 
    	font-variant: normal; 
    	font-weight: 400; 
    	line-height: 18px;
	}
    
    </style>
  </head>
  <body>
  	<div style="margin-right: 40px; margin-left: 40px; position: relative; height: 100%;">
  	<p style="margin-bottom: 130px;">Benjamin Ebert<br>Meckelstr. 25<br>06112 Halle (Saale)</p>

  	<table style="width: 100%; margin-bottom: 130px;">
  		<tbody>
  			<tr>
  				<td style="width: 70%;"><?php echo $customer[0]; ?></td>
  				<td style="width: 30%;">Re-Nr. <?php echo $meta[3]; ?>2019</td>
  			</tr>
  			<tr>
  				<td><?php echo $customer[1]; ?> <?php echo $customer[2]; ?></td>
  				<td>Re-Datum <?php echo $meta[1]; ?></td>
  			</tr>
  			<tr>
  				<td><?php echo $customer[3]; ?> <?php echo $customer[4]; ?></td>
  			</tr>
  		</tbody>
  	</table>

  	<h3>Rechnung</h3>

  	<table style="width: 100%;">
  		<tbody>
			<tr>
  				<td style="width: 30%;">Bezeichnung</td>
  				<td style="width: 30%;">Menge</td>
  				<td style="width: 20%;">Einzelpreis</td>
  				<td style="width: 20%;">Betrag</td>
  			</tr>
  		</tbody>
  	</table>

  	<hr>
  	
  	<table style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
  		<tbody>
  			<?php foreach ($services as $service) { ?>
  				<tr>
  					<td style="width: 30%;"><?php echo $service['name']; ?></td>
  					<td style="width: 30%;"><?php echo $service['amount']; ?></td>
  					<td style="width: 20%;"><?php echo $service['price']; ?></td>
  					<td style="width: 20%;"><?php echo $service['price']; ?></td>
  				</tr>  			
			<?php } ?>  			
  		</tbody>
  	</table>

  	<hr>

  	<div style="width: 33%; margin-left: 60%;">
  		<p style="display: inline; margin-right: 47%;">Netto</p>
  		<p style="display: inline;"><?php echo $meta[0]; ?></p>
  	</div>
  	<div style="width: 33%; margin-left: 60%;">
  		<p style="display: inline; margin-right: 20%;">Umsatzsteuer</p>
  		<p style="display: inline;">0,00</p>
  	</div>
  	<div style="width: 27%; margin-left: 60%; padding-bottom: 10px; border-bottom: 1px solid gray;">
  		<p style="display: inline; margin-right: 55%;">Brutto</p>
  		<p style="display: inline;"><?php echo $meta[0]; ?></p>
  	</div>

  	<p style="margin-top: 50px;">Zahlbar bis <?php echo $meta[2]; ?></p>
  	<p>Gemäß Kleinunternehmer-Regelung nach §19 UStG steuerfrei.</p>

  	<div style="width: 100%; border-top: 1px solid gray; position: absolute; bottom: 0;">
  		<div  style="width: 30%; display: inline-block; box-sizing: border-box;">
  			<p>Benjamin Ebert<br>Meckelstr. 25<br>06112 Halle (Saale)</p>
  		</div>
  		<div  style="width: 33%; display: inline-block; box-sizing: border-box;">
  			<p>info@benjaminebert.net<br>+49 176 805 148 93<br>St-Nr: 110/215/03314</p>
  		</div>
  		<div  style="width: 33%; display: inline-block; box-sizing: border-box">
  			<p>IBAN: DE05 1203 0000 1053 1494 13<br>BIC: BYLADEM1001<br>Deutsche Kreditbank (DKB)</p>
  		</div>
  	</div>

  	</div>
  </body>
</html>
