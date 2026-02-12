/*
 Name    Calculating wind pressure on roof surfaces
 Date    2025.09.26
 Author  Original script by F.I (Kawara Designs Ltd.), with modifications by Generative AI(Gemini)
*/

// バージョン番号
var Version = "25.9.30.2";

// 初期化 ※ページ読込時に実行
document.addEventListener("DOMContentLoaded", function () {
  StartUp();
});

// 初期化設定
function StartUp() {
  // バージョン表示
  const verEl = document.getElementById("Ver");
  if (verEl) {
    verEl.textContent = Version;
  }
  // セレクトボックスに県名をセット
  SelectKenSet();

  // 初期カーソル位置設定
  const voInput = document.ParamFm.VO;
  if (voInput) {
    voInput.focus();
  }
}

/*
県リストボックス設定
*/
function SelectKenSet() {
  var i; // 基準風速リストのインデックス
  var j; // 県リストボックスのインデックス
  var work; // 県名比較用保存域

  const kenSelect = document.ParamFm.KenList;
  if (!kenSelect) return;

  j = 0;
  for (i = 0; i <= VoList.length - 1; i++) {
    if (work != VoList[i].prefecture) {
      j++;
      kenSelect.options[j] = new Option(VoList[i].prefecture, VoList[i].prefecture);
      work = VoList[i].prefecture;
    }
  }
}

/*
市町村リストボックス設定
*/
function SelectShiSet() {
  var i; // 基準風速リストのインデックス
  var j; // 市町村リストボックスのインデックス

  const kenSelect = document.ParamFm.KenList.value;
  const shiSelect = document.ParamFm.ShiList;
  const voInput = document.ParamFm.VO;
  if (!kenSelect || !shiSelect || !voInput) return;

  shiSelect.length = 0; // リストボックス初期化
  voInput.value = ""; // 基準風速入力欄クリア
  j = 0;
  for (i = 0; i <= VoList.length - 1; i++) {
    if (kenSelect == VoList[i].prefecture) {
      j++;
      shiSelect.options[j] = new Option(VoList[i].town, VoList[i].wind);
    }
  }
}

/*
平均高さの計算
*/
function HAcalc() {
  const hhInput = document.ParamFm.HH;
  const hlInput = document.ParamFm.HL;
  const haInput = document.ParamFm.HA;

  if (!hhInput || !hlInput || !haInput) return;

  if (hhInput.value !== "" && hlInput.value !== "") {
    const work = (parseFloat(hhInput.value) + parseFloat(hlInput.value)) / 2;
    haInput.value = Math.round(work * 10) / 10;
  } else {
    haInput.value = "";
  }
}

/*
インジェクション対策の為に実体参照へ変換
*/
function EscapeHtml(inText) {
  if (typeof inText !== "string") return "";
  return inText
    .replace(/&/g, "&amp;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/\[br\]/g, "<br>");
}

/*
入力項目チェック
*/
function ParmCheck() {
  const form = document.ParamFm;
  if (!form) return;

  const Vo = form.VO.value; // 基準風速
  const Ha = form.HA.value; // 屋根平均高さ
  const Kb = form.KB.value; // 屋根勾配
  const Sk = form.SK.value; // 地表面粗度区分
  const Yk = form.YK.value; // 屋根の形状
  const Hd = EscapeHtml(form.HD.value); // コメント(サニタイズ処理)
  const wKubun = 0; // 実際の粗度地区分(一致している場合は0)

  // 未入力チェック
  if (Vo === "") {
    cDialog("alert", "未入力の警告", "基準風速を入力してください。", ["！"], function () {
      form.VO.focus();
    });
    return;
  }
  if (Ha === "") {
    cDialog("alert", "未入力の警告", "屋根平均高さを入力してください。", ["！"], function () {
      form.HA.focus();
    });
    return;
  }
  if (Kb === "" && Yk !== "5") {
    cDialog("alert", "未入力の警告", "屋根の勾配を入力してください。", ["！"], function () {
      form.KB.focus();
    });
    return;
  }

  // 数値チェック
  if (isNaN(Vo)) {
    cDialog("alert", "入力値の警告", "基準風速に数値を入力してください。", ["！"], function () {
      form.VO.focus();
    });
    return;
  }
  if (isNaN(Ha)) {
    cDialog("alert", "入力値の警告", "屋根平均高さに数値を入力してください。", ["！"], function () {
      form.HA.focus();
    });
    return;
  }
  if (parseFloat(Ha) >= 60) {
    cDialog("alert", "入力値の警告", "屋根平均高さが本画面での計算範囲外です。", ["！"], function () {
      form.HA.focus();
    });
    return;
  }
  if (isNaN(Kb)) {
    cDialog("alert", "入力値の警告", "屋根の勾配に数値を入力してください。", ["！"], function () {
      form.KB.focus();
    });
    return;
  }

  // 地表面粗度地区分チェック
  const checkRoughness = (ha, sk, hd, checkType) => {
    let message, callback;
    const confirmDialog = (title, msg, onYes, onNo) => {
      cDialog("confirm", title, msg, ["？"], (ret) => {
        if (ret) {
          onYes();
        } else {
          onNo();
        }
      });
    };

    switch (checkType) {
      case "sk1":
        message = "特定行政庁が区域Ⅰと定めた地域ですか？";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {},
        );
        break;
      case "sk2_ha_lt_13":
        message = "特定行政庁が区域Ⅱと定めた地域ですか？";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {
            cDialog("confirm", "地表面粗度区分の確認", "地表面粗度区分Ⅲが適用されるべきですが<br>区分Ⅱのままで計算を行いますか？", ["？", "計算続行", "変更する"], (ret) => {
              if (ret) {
                WindPpressureCalc(Ha, Kb, Vo, Sk, 3, Yk, Hd);
              }
            });
          },
        );
        break;
      case "sk2_ha_13_to_31":
        message = "海岸または湖岸線から200m以内であるか<br>特定行政庁が区域Ⅱと定めた地域ですか？";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {
            cDialog("confirm", "地表面粗度区分の確認", "地表面粗度区分Ⅲが適用されるべきですが<br>区分Ⅱのままで計算を行いますか？", ["？", "計算続行", "変更する"], (ret) => {
              if (ret) {
                WindPpressureCalc(Ha, Kb, Vo, Sk, 3, Yk, Hd);
              }
            });
          },
        );
        break;
      case "sk2_ha_gt_31":
        message = "海岸または湖岸線から500m以内であるか<br>特定行政庁が区域Ⅱと定めた地域ですか？";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {
            cDialog("confirm", "地表面粗度区分の確認", "地表面粗度区分Ⅲが適用されるべきですが<br>区分Ⅱのままで計算を行いますか？", ["？", "計算続行", "変更する"], (ret) => {
              if (ret) {
                WindPpressureCalc(Ha, Kb, Vo, Sk, 3, Yk, Hd);
              }
            });
          },
        );
        break;
      case "sk3_ha_lt_13":
        WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
        break;
      case "sk3_ha_13_to_31":
        message = "海岸または湖岸線から200m超ですか？";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {
            cDialog("confirm", "地表面粗度区分の確認", "地表面粗度区分Ⅱが適用されるべきですが<br>区分Ⅲのままで計算を行いますか？", ["？", "計算続行", "変更する"], (ret) => {
              if (ret) {
                WindPpressureCalc(Ha, Kb, Vo, Sk, 2, Yk, Hd);
              }
            });
          },
        );
        break;
      case "sk3_ha_gt_31":
        message = "海岸または湖岸線から500m超ですか？";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {
            cDialog("confirm", "地表面粗度区分の確認", "地表面粗度区分Ⅱが適用されるべきですが<br>区分Ⅲのままで計算を行いますか？", ["？", "計算続行", "変更する"], (ret) => {
              if (ret) {
                WindPpressureCalc(Ha, Kb, Vo, Sk, 2, Yk, Hd);
              }
            });
          },
        );
        break;
      case "sk4":
        message = "特定行政庁が区域Ⅳと定めた地域ですか？<br>(区域Ⅳの場合は、区分Ⅲの係数を使用して計算が行われます)";
        confirmDialog(
          "地表面粗度区分の確認",
          message,
          () => {
            WindPpressureCalc(Ha, Kb, Vo, Sk, 0, Yk, Hd);
          },
          () => {},
        );
        break;
    }
  };

  switch (Sk) {
    case "1":
      checkRoughness(Ha, Sk, Hd, "sk1");
      break;
    case "2":
      if (parseFloat(Ha) < 13) {
        checkRoughness(Ha, Sk, Hd, "sk2_ha_lt_13");
      } else if (parseFloat(Ha) < 31) {
        checkRoughness(Ha, Sk, Hd, "sk2_ha_13_to_31");
      } else {
        checkRoughness(Ha, Sk, Hd, "sk2_ha_gt_31");
      }
      break;
    case "3":
      if (parseFloat(Ha) < 13) {
        checkRoughness(Ha, Sk, Hd, "sk3_ha_lt_13");
      } else if (parseFloat(Ha) < 31) {
        checkRoughness(Ha, Sk, Hd, "sk3_ha_13_to_31");
      } else {
        checkRoughness(Ha, Sk, Hd, "sk3_ha_gt_31");
      }
      break;
    case "4":
      checkRoughness(Ha, Sk, Hd, "sk4");
      break;
  }
}

/*
屋根の部位別風圧力計算
*/
function WindPpressureCalc(H, Koubai, Vo, Kubun, wKubun, Yane, Header) {
  // 係数格納
  const Zb = [0, 5, 5, 5, 5]; // 区分Ⅳは区分Ⅲの係数で計算
  const Zg = [0, 250, 350, 450, 450]; // 区分Ⅳは区分Ⅲの係数で計算
  const Af = [0, 0.1, 0.15, 0.2, 0.2]; // 区分Ⅳは区分Ⅲの係数で計算

  let Rs; // 屋根勾配の角度
  let Er; // 平均風速に対する高さ方向の分布係数
  let q; // 平均速度圧
  let wH; // 計算上使用する平均高さ
  const Cf = []; // 部位別ピーク風力係数(1:平部,2:隅角部,3:外周部,4:棟端部)
  const W = []; // 部位別風圧力(1:平部,2:隅角部,3:外周部,4:棟端部)
  const Figures = 100000; // 小数点以下の四捨五入用の基数
  const ImagePath = "/wp-content/themes/kawara_corpo/images/wpc/"; //画像ファイルのパス(URL)

  // 勾配を角度へ変換
  Rs = (Math.atan(Koubai / 10) * 180) / Math.PI;
  Rs = Math.round(Rs * Figures) / Figures; // 四捨五入

  // 高さ方向係数の計算
  if (H < Zb[Kubun]) {
    wH = Zb[Kubun]; // 各地表面粗度区分で規定された最低高さで計算
  } else {
    wH = H; // そのまま平均高さで計算
  }
  Er = 1.7 * Math.pow(wH / Zg[Kubun], Af[Kubun]);
  Er = Math.round(Er * Figures) / Figures; // 四捨五入

  // 風圧力計算
  q = 0.6 * Math.pow(Vo, 2) * Math.pow(Er, 2);
  q = Math.round(q * Figures) / Figures; // 四捨五入

  // 風力係数格納
  Cf[1] = -2.5; // 平部
  Cf[3] = -3.2; // 外周部

  // 隅角部(勾配を元に直線補間で算出)
  if (Rs <= 10) {
    Cf[2] = -4.3;
  } else if (Rs <= 20) {
    Cf[2] = -4.3 + ((Rs - 10) / 10) * (-3.2 + 4.3);
    Cf[2] = Math.round(Cf[2] * 10) / 10;
  } else {
    Cf[2] = -3.2;
  }

  // 棟端部(勾配を元に直線補間で算出)
  if (Rs <= 10) {
    Cf[4] = -3.2;
  } else if (Rs <= 20) {
    Cf[4] = -5.4 + ((20 - Rs) / 10) * (5.4 - 3.2);
    Cf[4] = Math.round(10 * Cf[4]) / 10;
  } else if (Rs <= 30) {
    Cf[4] = -3.2 + ((30 - Rs) / 10) * (-5.4 + 3.2);
    Cf[4] = Math.round(10 * Cf[4]) / 10;
  } else {
    Cf[4] = -3.2;
  }

  // 風圧力計算(負数の為切下げで丸める)
  W[1] = Math.floor(q * Cf[1]); // 平部
  W[2] = Math.floor(q * Cf[2]); // 隅部
  W[3] = Math.floor(q * Cf[3]); // 外周部
  W[4] = Math.floor(q * Cf[4]); // 棟端部

  // 計算結果表示HTML生成(結果ページ作成)
  if (Header.includes("-no")) {
    footerArea = "";
    Header = Header.replaceAll("-no", "");
  } else if (Header.includes("-address")) {
    footerArea = `
			島根県大田市水上町白坏658-1<br>
		`;
    Header = Header.replaceAll("-address", "");
  } else {
    footerArea = `
			(注)「屋根の部位別風圧力構造計算」(Ver.${Version})の留意点については、弊社HPをご覧ください。<br>
			(免責) 当計算結果のご利用について生じた如何なる損害についても当方は責任を負わないものとします。<br>
		`;
  }
  const htmlContent = `
	<html>
	<head>
		<meta http-equiv='content-script-type' content='text/javascript'>
		<title>瓦百景株式会社</title>
		<style type='text/css'>
			body {
				font-size: 16pt;
				line-height: 100%;
				margin-left: 5%;
			}
			table {
				font-size: 16pt;
			}
			.header {
				line-height: 100%;
				border-bottom: 1px solid;
				width: 85%;
			}
			.foter {
				line-height: 100%;
				font-size: 7pt;
				text-align: center;
			}
			.average {
				text-decoration: underline;
				text-underline-offset: -0.8em;
			}
			@media print {
				input {display: none;}
			}
		</style>
	</head>
	<body>
		<div align="right">
			<input type="button" value="印刷" onclick="window.print();">
			&nbsp;
			<input type="button" value="閉じる" onclick="window.close();">
		</div>
		<center><font size="+3"><strong>屋根の部位別風圧力構造計算</strong></font></center>
		${Header !== "" ? `<br><div class='header'>${Header}</div>` : ""}
		<br>
		<div align="center">
			<table border="">
				<tr>
					<td colspan="2" align="center">計算条件</td>
				</tr>
				<tr title="高さ方向係数の算出に使用">
					<td>&nbsp;平均屋根高さ(H)&nbsp;</td>
					<td align="center">&nbsp;${wH}m${wH !== H ? ` <font size="-1">(実際の平均高さ:${H}m)</font>` : ""}&nbsp;</td>
				</tr>
				<tr title="ピーク風力係数の算出に使用">
					<td>&nbsp;屋根勾配&nbsp;</td>
					<td align="center">&nbsp;${Koubai}寸(${Rs}°)&nbsp;</td>
				</tr>
				<tr title="平均速度圧の算出に使用">
					<td>&nbsp;基準風速(Vo)&nbsp;</td>
					<td align="center">&nbsp;${Vo}m/s&nbsp;</td>
				</tr>
				<tr title="高さ方向係数の算出に使用">
					<td>&nbsp;地表面粗度区分&nbsp;</td>
					<td align="center">&nbsp;${["", "Ⅰ", "Ⅱ", "Ⅲ", "Ⅳ"][Kubun]}${wKubun !== 0 ? ` <font size="-1">(実際の地表面粗度区分:${["", "Ⅰ", "Ⅱ", "Ⅲ", "Ⅳ"][wKubun]})</font>` : ""}&nbsp;</td>
				</tr>
			</table>
		</div>
		<br>
		<span title="高さ10mの基準風速(Vo)を実際の屋根に対応させるため、平均屋根高さと地表面粗度区分を使って係数を算出">
			■高さ方向係数( Er )
		</span>
		<br>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td nowrap>　Ｅｒ ＝ 1.7</td>
				<td nowrap><font size="+5">(</font></td>
				<td nowrap align="center">${wH}<br> <span style="border-top: 2px solid black;"> ${Zg[Kubun]} </span> </td>
				<td nowrap><font size="+5">)</font></td>
				<td nowrap><sup>${Af[Kubun]}</sup><br><br></td>
				<td nowrap> = ${Er}</td>
			</tr>
		</table>
		<br>
		<span title="0.6(空気の質量÷2)と高さ方向係数(Er)と基準風速(Vo)を使って計算">
			■平均速度圧( <span class="average">ｑ</span> )
		</span>
		<br>
		　<span class="average">ｑ</span> ＝ 0.6×${Er}<sup>2</sup>×${Vo}<sup>2</sup> ＝ ${q} N/㎡<br>
		<br><br>
		<span title="平均速度圧(ｑ)に屋根の部位と勾配から求めたピーク風力係数(Cf)を乗じて瞬間最大速度圧を計算">
			■部位別風圧力( Ｗ )
		</span>
		<br>
		<br>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					　<img src="${ImagePath}/wpc_1.gif" height="20" width="50">平部(${Cf[1]})<br>
					<br>
					　<img src="${ImagePath}/wpc_2.gif" height="20" width="50">外周部(${Cf[3]})<br>
					${
            Yane !== "6"
              ? `
					<br>
					　<img src="${ImagePath}/wpc_3.gif" height="20" width="50">隅角部(${Cf[2]})<br>`
              : ""
          }
					${
            Yane === "0" || Yane === "1" || Yane === "2"
              ? `
					<br>
					　<img src="${ImagePath}/wpc_4.gif" height="20" width="50">棟端部(${Cf[4]})<br>`
              : ""
          }
				</td>
				<td>
					&nbsp;= <span title="${Math.round(W[1] / 9.8)} ㎏f/㎡">${W[1]} N/㎡</span><br>
					<br>
					&nbsp;= <span title="${Math.round(W[3] / 9.8)} ㎏f/㎡">${W[3]} N/㎡</span><br>
					${
            Yane !== "6"
              ? `
					<br>
					&nbsp;= <span title="${Math.round(W[2] / 9.8)} ㎏f/㎡">${W[2]} N/㎡</span><br>`
              : ""
          }
					${
            Yane === "0" || Yane === "1" || Yane === "2"
              ? `
					<br>
					&nbsp;= <span title="${Math.round(W[4] / 9.8)} ㎏f/㎡">${W[4]} N/㎡</span><br>`
              : ""
          }
				</td>
				<td width="280" align="right">
					${Yane === "1" ? `<img src="${ImagePath}/wpc_kirizuma.gif" width="230"><br>` : ""}
					${Yane === "2" ? `<img src="${ImagePath}/wpc_yosemune.gif" width="230"><br>` : ""}
					${Yane === "3" ? `<img src="${ImagePath}/wpc_katanagare.gif" width="230"><br>` : ""}
					${Yane === "4" ? `<img src="${ImagePath}/wpc_nokogiri.gif" width="230"><br>` : ""}
					${Yane === "5" ? `<img src="${ImagePath}/wpc_renzoku.gif" width="230"><br>` : ""}
					${Yane === "6" ? `<img src="${ImagePath}/wpc_arch.gif" width="230"><br>` : ""}
				</td>
			</tr>
		</table>
		<br><br><br>
		<p class="foter">
			<strong>瓦百景株式会社</strong><br>
			<br>
			${footerArea !== "" ? `<span>${footerArea}</span>` : ""}
			<br>
			https://www.kawara100.co.jp
		</p>
	</body>
	</html>
	`;
  const DWwidth = 720;
  const DWheight = Math.min(window.innerHeight + 55, 960);
  const DWtop = window.screenTop;
  const DWleft = window.screenLeft + (window.innerWidth - DWwidth) / 2;
  const DW = window.open("", "屋根の部位別風圧力構造計算", `toolbar=no,location=no,menubar=no,directories=no,status=no,scrollbars=yes,resizable=yes,top=${DWtop},left=${DWleft},width=${DWwidth},height=${DWheight}`);

  if (!DW) {
    alert("ポップアップウィンドウがブロックされました。ブラウザの設定をご確認ください。");
    return;
  }

  DW.document.write(htmlContent);
  DW.document.close();
}
