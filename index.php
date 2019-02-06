<?php $base="../../"; ?>
<!DOCTYPE html>
<html lang="tr">
    <head>        
        <?php include($base.'inc/head.php'); ?>
        <script type="text/javascript" src="<?=$base?>js/plugins/jquery/jquery.min.js"></script>
		<script>
		function datacek(p){
			var per = p;
			$.ajax({
				url: "ajax/ajax.php",
				type: "POST",
				cache: true,
				data: "&periyot="+per,
				success : function(html)
				{
					$("#degerler").html(html);
				}
			});
		}	
		</script>
		
        <!-- EOF CSS INCLUDE -->
    </head>
    <body class="x-dashboard" onLoad="datacek('haftalik')">
        <!-- START PAGE CONTAINER -->        
        <div class="page-container">            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <div class="x-content" style="margin-top: 20px;">
                        <div id="main-tab">
                            <div class="x-content-title">
                                <h1>Web Sitesi Ziyaretçi İstatistikleri</h1>
                                <div class="pull-right">
                                    <button class="btn btn-info"><span class="fa fa-desktop"></span> Site Yönetimi</button>
                                </div>
                            </div>
							<!--<div class="row">
								<div class="col-md-10">
									<div class="col-md-9">
										<h3>Project Activity</h3>
										<p>Account Type: <span>Business</span></p>
									</div>
									<div class="col-md-3">
										<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
											<i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down"></i>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									
								</div>
							</div>-->
                            <div class="row stacked" id="degerler">
                            	<!-- veriler buraya gelecek -->
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
																		<div class="title">Toplam Ziyaret Sayısı</div>
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
												
													<div class="item item-yesil block" style="margin-bottom: 3px; margin-top: 3px;">
														<strong>Sosyal Medya Trafiği</strong><font class="pull-right"></font>
													</div>
													
													<div class="item item-sari block" style="margin-bottom: 3px; margin-top: 3px;">
														<strong>Organik Trafik</strong><font class="pull-right"></font>
													</div>
													
													<div class="item item-kirmizi block" style="margin-bottom: 3px; margin-top: 3px;">
														<strong>Direk Trafik</strong><font class="pull-right"></font>
													</div>
													
													<div class="item item-mavi block" style="margin-bottom: 3px; margin-top: 3px;">
														<strong>Site İçi Trafik</strong><font class="pull-right"></font>
													</div>
													
													<div class="item item-mor block" style="margin-bottom: 3px; margin-top: 3px;">
														<strong>Yönlendirme Trafiği</strong><font class="pull-right"></font>
													</div>
													

											</div>                                        
										</div>
									</div>
								</div>
                            	<!-- veriler buraya gelecek -->
                            </div>
                            
                            
                        </div>
                    </div>
                    

                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

 

       
    	<!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        
        <script type="text/javascript" src="<?=$base?>js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=$base?>js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->     
 
        
        <script type="text/javascript" src="<?=$base?>js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="<?=$base?>js/plugins/morris/morris.min.js"></script>         
                

        <!--END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="<?=$base?>js/plugins.js"></script>        
        <script type="text/javascript" src="<?=$base?>js/actions.js"></script>
		
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>