!function(){function j(){z=window.jQuery.noConflict(!0),q()}function q(){function B(J,K){K=Math.pow(10,K);for(var P,N=["K","M","B","T"],O=N.length-1;0<=O;O--)if(P=Math.pow(10,3*(O+1)),P<=J){1e3==(J=Math.round(J*K/P)/K)&&O<N.length-1&&(J=1,O++),J+=" "+N[O];break}return J}function C(J,K){return"BTC"==K?D(J):F(J)}function D(J){return J=1e3<=J?Math.round(J).toLocaleString():1<=J?J.toFixed(8):1e-8>J?J.toPrecision(4):J.toFixed(8)}function F(J){return J=1<=J?1e5<=J?Math.round(J).toLocaleString():J.toFixed(2):1e-6>J?J.toPrecision(2):J.toFixed(6)}function G(J,K,N){var O=K,P={btc:"\u0430\u0451\u0457",usd:"$",eur:"\u0432\u201A\xAC",cny:"\u0412\u0490",gbp:"\u0412\u0408",cad:"$",rub:"<img src='/static/img/fiat/ruble.gif'/>",hkd:"$",jpy:"\u0412\u0490",aud:"$",brl:"R$",inr:"\u0432\u201A\u2116",krw:"\u0432\u201A\xA9",mxn:"$",idr:"Rp",chf:"Fr"};return J.toLowerCase()in P&&(O=P[J.toLowerCase()]+O),N&&(O=O+" <span style=\"font-size:9px\">"+J.toUpperCase()+"</span>"),O}function H(J,K,N,O,P,Q,R,S){var T=0,U=0,V="",W="",X="";return(J&&T++,K&&T++,N&&T++,0==T)?"":((1==T&&(U=100),2==T&&(U=49.8),3==T&&(U=33),J)&&(borderWidth=0,(N||K)&&(borderWidth=1),V="<div style=\"text-align:center;float:left;width:"+U+"%;font-size:12px;padding:12px 0;border-right:"+borderWidth+"px solid #E4E6EB;line-height:1.25em;\"><span style=\"font-size: 17px; \">"+Q+"</span></div>"),N&&(borderWidth=0,K&&(borderWidth=1),W="<div style=\"text-align:center;float:left;width:"+U+"%;font-size:12px;padding:12px 0 16px 0;border-right:"+borderWidth+"px solid #E4E6EB;line-height:1.25em;\"><span style=\"font-size: 14px; \">"+G(P,R,O)+"</span></div>"),K&&(X="<div style=\"text-align:center;float:left;width:"+U+"%;font-size:12px;padding:12px 0 16px 0;line-height:1.25em;\"><span style=\"font-size: 14px; \">"+G(P,S,O)+"</span></div>"),(detailedHTML="<div style=\"border-top: 1px solid #E4E6EB;clear:both;\">"+V+W+X+"</div>",detailedHTML))}function I(J,K,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,$,_){var aa="#093";0>T&&(aa="#d14836"),valTickerHTML=X?"("+N+")":"",valPrice=Q?C(Q,O):"?",valPercentHTML=T?"<span style=\"color:"+aa+"\">("+T+"%)":"",valMarketCap=U?B(U,2):"?",valVolume=V?B(V,2):"?",R?(mainLineHeight=25,valPriceSecondary=S?C(S,R):"?",secondaryHTML="<span style=\"font-size: 12px; color:gray\">"+valPriceSecondary+" "+R+" </span>"):(mainLineHeight=30,secondaryHTML="");var ba="utm_medium=widget&utm_campaign=cmcwidget&utm_source="+location.hostname+"&utm_content="+J,ca="<div style=\"color: #fff;border-radius: 10px;min-width:285px;\"><div><div><span style=\"font-size: 18px;\">"+K+" "+valTickerHTML+"</span><span style=\"font-size: 16px;color: #adadad;\">"+valPrice+" <i class='fa fa-usd'></i> "+valPercentHTML+"</span></span>"+secondaryHTML+"</div><div style=\"text-align:center;padding:5px 0px;width:33%;\"></div></div>";return ca+=H(Y,Z,$,_,P,W,valMarketCap,valVolume),ca+=" </div>"}

z(document).ready(function(J){
	J(".coinmarketcap-currency-widget").each(function(){
		var K=J(this).attr("data-currency"),
		N=J(this).attr("data-base").toUpperCase(),
		O=J(this).attr("data-secondary");
		O=O?O.toUpperCase():null,
		O="BTC"==O||"USD"==O?O:null;
		var P=J(this).attr("data-stats");
		P=P?P.toUpperCase():null,
		P=P==N?N:"USD";
		var Q=!1!==J(this).data("ticker"),
		R=!1!==J(this).data("rank"),
		S=!1!==J(this).data("marketcap"),
		T=!1!==J(this).data("volume"),
		U=!1!==J(this).data("statsticker"),
		V=this;
		J.get({
			url:"https://api.coinmarketcap.com/v1/ticker/"+K+"/?ref=widget&convert="+N,
			success:function(W){
				var X="price_"+N.toLowerCase(),
				Y=O?"price_"+O.toLowerCase():null,
				Z="market_cap_"+P.toLowerCase(),
				$="24h_volume_"+P.toLowerCase(),
				_=parseFloat(W[0][X]),
				aa=Y?parseFloat(W[0][Y]):null,
				ba=parseInt(W[0][Z]),
				ca=parseInt(W[0][$]),
				da=W[0].name,ea=W[0].symbol,
				fa=(+W[0].percent_change_24h).toFixed(2),
				ga=W[0].rank,
				ha=I(K,da,ea,N,P,_,O,aa,fa,ba,ca,ga,Q,R,T,S,U);
				console.log('ha > '+ha);
				J(V).html(ha),
				J(V).find("a").css({"text-decoration":"none",color:"#428bca"})
				}})
				})
				})
				}
var z;
if(void 0===window.jQuery||"1.11.1"!==window.jQuery.fn.jquery){
	var A=document.createElement("script");
	A.setAttribute("type","text/javascript"),
	A.setAttribute("src","https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"),
	A.readyState?A.onreadystatechange=function(){"complete"!=this.readyState&&"loaded"!=this.readyState||j()}:A.onload=j,(document.getElementsByTagName("head")[0]||document.documentElement).appendChild(A)
	}else z=window.jQuery,q()}();