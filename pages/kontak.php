
					<h2>
						Kontak Kami
					</h2>
							
	<div class="accordion" id="collapse-group">                          
	<div class="accordion-group widget-box">
		<div class="accordion-heading">
			<div class="widget-title">
				<a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
					<span class="icon"><i class="icon-circle-arrow-right img3"></i></span><h5>Hubungi Kami </h5>
				</a>
			</div>
		</div>
		<div class="collapse accordion-body" id="collapseGTwo">
			<div class="widget-content">
			   <div class="hero-unit">	
					<p>Silakan kirimkan kritik maupun saran anda kepada kami.</p>
<form  class="form-horizontal" action="?page=Kirim" method="post">
		
		 
						<fieldset>	
		<div class="control-group">
			<label class="control-label"  for="name">Nama</label>
			<div class="controls">
			<input type="text"  class="input-xxlarge" name="name" required>
		</div>
		</div>

		<div class="control-group">
			<label class="control-label"  for="email">Email</label>
			<div class="controls">
			<input type="text"  class="input-xxlarge" name="email" required>
		</div>
		</div>

		<div class="control-group">
			<label class="control-label"  for="subject">Subjek</label>
			<div class="controls">
			<input type="text"  class="input-xxlarge" name="subject" required>
		</div>
		</div>

		<div class="control-group">
			<label class="control-label"  for="message">Pesan</label>
			<div class="controls">
			<textarea  class="input-xxlarge" name="message" id="" cols="30" rows="10"></textarea>
		</div>
		</div>
		
		<div class="control-group">
			<label class="control-label"  for="message">  <?php
//meng-generate angka random integer antara 20 - 50
$jx = rand(20,70);
//meregisterkan angka tersebut ke session
$_SESSION['captchakuis'] = $jx;
$kx = rand(1,19);
$yx = $jx - $kx;
//mencetak ke halaman
echo "<b> ".$yx." + ".$kx." = ? </b>";;
?></label>
			<div class="controls">
			<input type="text" class="span1" name="jawaban" id="jawaban" maxlength="5">
		</div>
		</div>
		 
		<div class="form-actions"><input class="btn btn-primary" type="submit" value="Kirim Pesan"></div>
</fieldset>
	</form>
				</div>
			 

			</div>
		</div>	 
		</div>	 
		</div> 
					<div class="hero-unit">
							Kantor DPRD Kota Banjarbaru
				<table class="table table-stripped">
						<tr>
						<td> Alamat
						</td>
						<td>:
						</td>
						<td> Jl. Basuki Rahmat No. 3 Banjarbaru Kode Pos 70711
						</td>
						</tr>
						<tr>
						<td> Telpon
						</td>
						<td>:
						</td>
						<td> (0511) 6749983
						</td>
						</tr>
						<tr>
						<td> Fax
						</td>
						<td>:
						</td>
						<td>  (0511) 4781539
						</td>
						</tr>
						<tr>
						<td> Email
						</td>
						<td>:
						</td>
						<td> dewan.banjarbaru@gmail.com
						</td>
						</tr>
				</table>
						
					 
						
					</div>
			