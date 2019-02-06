<?php

$id = "SAYAC ID";
$token = "TOKEN";

require("../functions.php");
$inf = new inf();




if($_POST["periyot"]!="")
{
	if($_POST["periyot"]=="bugun")
	{
		$inf->yandexozet_hit($id,$token,"0","day");
		$chart_degerleri = $inf->dizibirlestir($hit_sayi, $ziyaretci_sayi, $tarihler);
		$inf->yandex_ozet($id,$token,"0","week");
		$inf->yandexozet_platform($id,$token,"0");
		$perad = "Bugün";
	}
	else if($_POST["periyot"]=="haftalik")
	{
		$inf->yandexozet_hit($id,$token,"-7","day");
		$chart_degerleri = $inf->dizibirlestir($hit_sayi, $ziyaretci_sayi, $tarihler);
		$inf->yandex_ozet($id,$token,"-7","week");
		$inf->yandexozet_platform($id,$token,"-7");
		$perad = "Haftalık";
	}
	else if($_POST["periyot"]=="aylik")
	{
		$inf->yandexozet_hit($id,$token,"-30","day");
		$chart_degerleri = $inf->dizibirlestir($hit_sayi, $ziyaretci_sayi, $tarihler);
		$inf->yandex_ozet($id,$token,"-30","month");
		$inf->yandexozet_platform($id,$token,"-30");
		$perad = "Aylık";
	}
	else if($_POST["periyot"]=="yillik")
	{
		$inf->yandexozet_hit($id,$token,"-365","month");
		$chart_degerleri = $inf->dizibirlestir($hit_sayi, $ziyaretci_sayi, $tarihler);
		$inf->yandex_ozet($id,$token,"-365","year");
		$inf->yandexozet_platform($id,$token,"-365");
		$perad = "Yıllık";
	}
}else 
{
	$inf->yandexozet_hit($id,$token,"-7","day");
	$chart_degerleri = $inf->dizibirlestir($hit_sayi, $ziyaretci_sayi, $tarihler);
	$inf->yandex_ozet($id,$token,"-7","week");
	$inf->yandexozet_platform($id,$token,"-7");
	$perad = "Haftalık";
}

?>

	<div class="row stacked" id="degerler">
		<div class="col-md-10">
			<div class="x-chart-widget">
				<div class="x-chart-widget-content">
					<div class="x-chart-widget-content-head">
						<h4>İstatistik Özeti</h4>
						<div class="pull-right">
							<div class="btn-group">
								<button onClick="datacek('bugun')" class="btn btn-<?php if($perad=="Bugün") { echo "danger";} else { echo "default";}?>">BUGÜN</button>
								<button onClick="datacek('haftalik')" class="btn btn-<?php if($perad=="Haftalık") { echo "danger";} else { echo "default";}?>">HAFTALIK</button>
								<button onClick="datacek('aylik')" class="btn btn-<?php if($perad=="Aylık") { echo "danger";} else { echo "default";}?>">AYLIK</button>
								<button onClick="datacek('yillik')" class="btn btn-<?php if($perad=="Yıllık") { echo "danger";} else { echo "default";}?>">YILLIK</button>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="x-chart-widget-informer">
								<div class="row">
									<div class="col-md-2 bas">
										<div class="x-chart-widget-informer-item last">
											<div class="count"><?=$perad?><font class="pull-right"><i class="fa fa-calendar" style="color: white"></i></font></div>
											<div class="title">Site İstatistikleri</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="x-chart-widget-informer-item">
											<div class="count"><?=$toplam_ziyaret?><font class="pull-right"><i class="fa fa-mouse-pointer" style="color: #DEE4EC"></i></font></div>
											<div class="title">Toplam Ziyaret Sayısı</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="x-chart-widget-informer-item">
											<div class="count"><?=$toplam_ziyaretci?><font class="pull-right"><i class="fa fa-users" style="color: #DEE4EC"></i></font></div>
											<div class="title">Toplam Ziyaretçi Sayısı</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="x-chart-widget-informer-item">
											<div class="count"><font style="font-size:15px; vertical-align: text-bottom;">%</font> <?=$hemen_cikma?><font class="pull-right"><i class="fa fa-sign-out" style="color: #DEE4EC"></i></font></div>
											<div class="title">Hemen Çıkma Oranı</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="x-chart-widget-informer-item">
											<div class="count"><?=$sayfa_derinligi?><font class="pull-right"><i class="fa fa-copy" style="color: #DEE4EC"></i></font></div>
											<div class="title">Sayfa Derinliği</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="x-chart-widget-informer-item last">
											<div class="count"><?=$gecirilenzaman?><font class="pull-right"><i class="fa fa-clock-o" style="color: #DEE4EC"></i></font></div>
											<div class="title">Sitede Geçirilen Zaman</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-2 pull-right">
							<div class="x-chart-widget-informer">
								<div class="row">
									<div class="col-md-6">
										<div class="x-chart-widget-informer-item">
											<div class="count"><font style="font-size:15px; vertical-align: text-bottom;">%</font> <?=$toplam_ziyaret_mobil_yuzde?><font class="pull-right"><i class="fa fa-mobile" style="color: #DEE4EC"></i></font></div>
											<div class="title">Mobil</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="x-chart-widget-informer-item">
											<div class="count"><font style="font-size:15px; vertical-align: text-bottom;">%</font> <?=$toplam_ziyaret_pc_yuzde?><font class="pull-right"><i class="fa fa-desktop" style="color: #DEE4EC"></i></font></div>
											<div class="title">PC</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="x-chart-holder">
						<div id="x-dashboard-line" style="height: 400px;"></div>
					</div>
				</div>                                        
			</div>
		</div>
		<div class="col-md-2">

			<div class="x-widget-timeline">
				<div class="x-widget-timelime-head trafikhead">
					<h3>Trafik Kaynakları</h3>                          
				</div>
				<div class="x-widget-timeline-content">
					<div id="morris-donut-example" style="height: 300px;"></div> 
					<?php
					foreach($trafikverileri as $key => $kaynak)
					{
						$k = explode("#",$kaynak);
						if($key=="organic") { $tur = "Organik Trafik"; $color = "sari"; }
						if($key=="social") { $tur = "Sosyal Medya Trafiği"; $color = "yesil"; }
						if($key=="direct") { $tur = "Direkt Trafik"; $color = "kirmizi"; }
						if($key=="internal") { $tur = "Site İçi Trafik";  $color = "mavi"; }
						if($key=="referral") { $tur = "Yönlendirme Trafiği";  $color = "mor"; }
						?>
						<div class="item item-<?=$color?> block" style="margin-bottom: 3px; margin-top: 3px;">
							<strong><?=$tur?></strong><font class="pull-right"><font style="font-size:13px; color: #94ABBA">%<?=$k[1]?></font> <strong style="font-size: 18px;"><?=$k[0]?></strong></font>
						</div>
						<?php
					}
					?>

				</div>                                        
			</div>
		</div>
		<script>
		  Morris.Line({
			  element: 'x-dashboard-line',
			  data: [
				<?php
				foreach ($chart_degerleri as $data)
				{
					$datalar = explode("#",$data);
					echo "{ y: '".$datalar[2]."', a: ".$datalar[1].",b: ".$datalar[0]."},";
				}
				?>
			  ],
			  xkey: 'y',
			  ykeys: ['a', 'b'],
			  labels: ['Ziyaretçi', 'Sayfa Görüntüleme'],
			  resize: true,
			  lineColors: ['rgb(253, 90, 62)', 'rgb(151, 204, 100)']
			});

			Morris.Donut({
				element: 'morris-donut-example',
				colors: ['rgb(151, 204, 100)', 'rgb(255, 217, 99)', 'rgb(253, 90, 62)', 'rgb(119, 182, 231)', 'rgb(169, 85, 184)'],
				data: [
					<?php
					foreach($trafikverileri as $key => $kaynak)
					{
						$k = explode("#",$kaynak);
						if($key=="organic") { $tur = "Organik"; }
						if($key=="social") { $tur = "Sosyal"; }
						if($key=="direct") { $tur = "Direkt"; }
						if($key=="internal") { $tur = "Siteiçi"; }
						if($key=="referral") { $tur = "Yönlendirme"; }
						echo '{label: "'.$tur.'", value: '.number_format($k[1],0).'},';
					}
					?>
				],
				formatter: function (x) { return x + "%"}


			});
		</script>
	</div>
