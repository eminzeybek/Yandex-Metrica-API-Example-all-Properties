<?php

class inf {
	// haftalık özet bilgileri (ÖZET BİLGİLER)
	public function yandex_ozet($id, $token, $day, $per)
	{
		date_default_timezone_set('Europe/Istanbul');
		$date = date("Ymd");
		$timeAgo = date("Ymd", strtotime("".$day." days"));

		switch ($day) {
			case "-7":
				$link = 'https://api-metrica.yandex.com/stat/v1/data?preset=sources_summary&id='.$id.'&oauth_token='.$token.'';
				break;
			case "0":
				$link = 'https://api-metrica.yandex.com/stat/v1/data/bytime?preset=sources_summary&date1='.$timeAgo.'&date2='.$date.'&group='.$per.'&dimensions=ym:s:<attribution>TrafficSource,ym:s:lastSourceEngine&attribution=last&ids='.$id.'&metrics=ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds&oauth_token='.$token.'';
				break;
			case "-30":
				$link = 'https://api-metrica.yandex.com/stat/v1/data/bytime?preset=sources_summary&date1='.$timeAgo.'&date2='.$date.'&group='.$per.'&dimensions=ym:s:<attribution>TrafficSource,ym:s:lastSourceEngine&attribution=last&ids='.$id.'&metrics=ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds&oauth_token='.$token.'';
				break;
			case "-365":
				$link = 'https://api-metrica.yandex.com/stat/v1/data/bytime?preset=sources_summary&date1='.$timeAgo.'&date2='.$date.'&group='.$per.'&dimensions=ym:s:<attribution>TrafficSource,ym:s:lastSourceEngine&attribution=last&ids='.$id.'&metrics=ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds&oauth_token='.$token.'';
				break;
			default:
				$link = 'https://api-metrica.yandex.com/stat/v1/data?preset=sources_summary&id='.$id.'&oauth_token='.$token.'';
		}
		//day -7 -30 -365
		//per week month year
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $link);
		$result = curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($result,true);
		//toplam datalar (işlenecek veri)
		$d = $obj["totals"];
		//print_r($obj);

		/**************************************************************/
		/* Trafik verileri */
		$trafik = $obj["data"];
		global $trafikverileri;
		$trafikverileri = array();
		
		if (is_array($trafik)) {
			foreach($trafik as $key => $value)
			{
				if($value["dimensions"][0]["id"]=="organic")
				{
					if($day=="-7")
					{
						$trafikverileri["organic"] = $trafikverileri["organic"]+$value["metrics"][0];
					}
					else if($day=="-30" || $day=="-365" || $day=="0")
					{
						$trafikverileri["organic"] = $value["metrics"][0][0]+$value["metrics"][0][1];
					}
				}else
					if ($value["dimensions"][0]["id"]=="social")
				{
					if($day=="-7")
					{
						$trafikverileri["social"] = $trafikverileri["social"]+$value["metrics"][0];
					}
					else if($day=="-30" || $day=="-365" || $day=="0")
					{
						$trafikverileri["social"] = $value["metrics"][0][0]+$value["metrics"][0][1];
					}
				}else
					if ($value["dimensions"][0]["id"]=="direct")
				{
					if($day=="-7")
					{
						$trafikverileri["direct"] = $trafikverileri["direct"]+$value["metrics"][0];
					}
					else if($day=="-30" || $day=="-365" || $day=="0")
					{
						$trafikverileri["direct"] = $value["metrics"][0][0]+$value["metrics"][0][1];
					}
				}else
					if ($value["dimensions"][0]["id"]=="internal")
				{
					if($day=="-7")
					{
						$trafikverileri["internal"] = $trafikverileri["internal"]+$value["metrics"][0];
					}
					else if($day=="-30" || $day=="-365" || $day=="0")
					{
						$trafikverileri["internal"] = $value["metrics"][0][0]+$value["metrics"][0][1];
					}
				}else
					if ($value["dimensions"][0]["id"]=="referral")
				{
					if($day=="-7")
					{
						$trafikverileri["referral"] = $trafikverileri["referral"]+$value["metrics"][0];
					}
					else if($day=="-30" || $day=="-365" || $day=="0")
					{
						$trafikverileri["referral"] = $value["metrics"][0][0]+$value["metrics"][0][1];
					}
				}
			}
		}
		
		$toplamtrafik = array_sum($trafikverileri);

		$trafikverileri["organic"] = $trafikverileri["organic"]."#".$this->ziyaretciyuzdesi($toplamtrafik,$trafikverileri["organic"]);
		$trafikverileri["social"] = $trafikverileri["social"]."#".$this->ziyaretciyuzdesi($toplamtrafik,$trafikverileri["social"]);
		$trafikverileri["direct"] = $trafikverileri["direct"]."#".$this->ziyaretciyuzdesi($toplamtrafik,$trafikverileri["direct"]);
		$trafikverileri["internal"] = $trafikverileri["internal"]."#".$this->ziyaretciyuzdesi($toplamtrafik,$trafikverileri["internal"]);
		$trafikverileri["referral"] = $trafikverileri["referral"]."#".$this->ziyaretciyuzdesi($toplamtrafik,$trafikverileri["referral"]);
		/**************************************************************/

		global $toplam_ziyaret;
		global $toplam_ziyaretci;
		global $hemen_cikma;
		global $sayfa_derinligi;
		global $gecirilenzaman;

		if($day=="-7")
		{
			$toplam_ziyaret = $d[0];
			$toplam_ziyaretci = $d[1];
			$hemen_cikma = number_format($d[2], 2, ".", ".");
			$sayfa_derinligi = number_format($d[3], 2, ".", ".");
			$gecirilenzaman = number_format(($d[4]/65), 2, ":", ".");
		}
		else if($day=="-30" || $day=="-365" || $day=="0")
		{
			$toplam_ziyaret = $d[0][0]+$d[0][1];
			$toplam_ziyaretci = $d[1][0]+$d[1][1];
			$hemen_cikma = number_format((($d[2][0]+$d[2][1])/2), 2, ".", ".");
			$sayfa_derinligi = number_format((($d[3][0]+$d[3][1])/2), 2, ".", ".");
			$gecirilenzaman = number_format((($d[4][0]+$d[3][1])/65), 2, ":", ".");
		}
		return $toplam_ziyaret;
		return $toplam_ziyaretci;
		return $hemen_cikma;
		return $sayfa_derinligi;
		return $gecirilenzaman;
	}



	// ziyaretci bilgileri (gelen gün degerine göre) (GRAFİK İÇİN)
	public function yandexozet_hit($id, $token, $day, $per)
	{
		date_default_timezone_set('Europe/Istanbul');
		$date = date("Ymd");
		$timeAgo = date("Ymd", strtotime("".$day." days"));

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_URL, 'https://api-metrica.yandex.com/stat/v1/data?preset=sources_summary&id='.$id.'&oauth_token='.$token.'');
		curl_setopt($ch, CURLOPT_URL, 'https://api-metrica.yandex.com/stat/v1/data/bytime?metrics=ym:s:hits,ym:s:visits&date1='.$timeAgo.'&date2=today&group='.$per.'&id='.$id.'&oauth_token='.$token.'');
		$result = curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($result,true);

		//print_r($obj);

		global $tarihler;
		global $hit_sayi;
		global $ziyaretci_sayi;

		$tarihler = $obj["time_intervals"];


		$hit_sayi =  $obj["data"][0]["metrics"][0];
		$ziyaretci_sayi =  $obj["data"][0]["metrics"][1];

		/* print_r($tarihler);
		print_r($hit_sayi);
		print_r($ziyaretci_sayi);*/

	}

	// platforma göre istatistik verileri çek (MOBİL PC)
	public function yandexozet_platform($id, $token, $day)
	{
		date_default_timezone_set('Europe/Istanbul');
		$date = date("Ymd");
		$timeAgo = date("Ymd", strtotime("".$day." days"));

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, 'https://api-metrica.yandex.com/stat/v1/data?preset=tech_platforms&date1='.$timeAgo.'&date2='.$date.'&dimensions=ym:s:deviceCategory&id='.$id.'&oauth_token='.$token.'');
		$result = curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($result,true);
		//toplam datalar (işlenecek veri)
		$d = $obj["data"];
		$d2 = $obj["totals"];
		//print_r($obj);

		global $toplam_ziyaret_mobil;
		global $toplam_ziyaret_pc;
		global $toplam_ziyaret_mobil_yuzde;
		global $toplam_ziyaret_pc_yuzde;

		$toplam_ziyaret_mobil = $d[0]["metrics"][0];
		$toplam_ziyaret_pc = $d[1]["metrics"][0];

		$toplam_ziyaret_mobil_yuzde = $this->ziyaretciyuzdesi($d2[0],$toplam_ziyaret_mobil);
		$toplam_ziyaret_pc_yuzde = $this->ziyaretciyuzdesi($d2[0],$toplam_ziyaret_pc);

	}

	//gelen 3 farklı diziyi birleştirmek için fonksiyon
	public function dizibirlestir($array1, $array2, $array3)
	{
		$result = array();
		
		if (is_array($array1) && is_array($array2) && is_array($array3))
		{
		
			foreach($array1 as $key => $value)
			{
				array_push($result, $value."#".$array2[$key]."#".$array3[$key][0]);
			}
		}
		
		return $result;
	}

	//yuzdehesaplama
	public function ziyaretciyuzdesi($toplam, $deger)
	{
		$result = number_format((($deger/$toplam)*100), 1, ".", ".");
		return $result;
	}

}

?>