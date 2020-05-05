/*

 MyFonts Webfont Build ID 3799273, 2019-08-21T07:58:34-0400

 The fonts listed in this notice are subject to the End User License
 Agreement(s) entered into by the website owner. All other parties are 
 explicitly restricted from using the Licensed Webfonts(s).

 You may obtain a valid license at the URLs below.

 Webfont: SofiaPro-UltraLightitalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/ultra-light-italic/

 Webfont: SofiaPro-Bold by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/bold/

 Webfont: SofiaPro-Bolditalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/bold-italic/

 Webfont: SofiaPro-ExtraLight by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/extra-light/

 Webfont: SofiaPro-Blackitalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/black-italic/

 Webfont: SofiaPro-Black by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/black/

 Webfont: SofiaPro-Light by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/light/

 Webfont: SofiaPro-Medium by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/medium/

 Webfont: SofiaPro-Lightitalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/light-italic/

 Webfont: SofiaPro-ExtraLightitalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/extra-light-italic/

 Webfont: SofiaPro-Regular by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/regular/

 Webfont: SofiaPro-Mediumitalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/medium-italic/

 Webfont: SofiaPro-SemiBold by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/semi-bold/

 Webfont: SofiaPro-Regularitalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/regular-italic/

 Webfont: SofiaPro-UltraLight by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/ultra-light/

 Webfont: SofiaPro-SemiBolditalic by Mostardesign
 URL: https://www.myfonts.com/fonts/mostardesign/sofia-pro/semi-bold-italic/


 License: https://www.myfonts.com/viewlicense?type=web&buildid=3799273
 Licensed pageviews: 10,000
 Webfonts copyright: Copyright &#x00A9; Olivier Gourvat - Mostardesign Type Foundry, 2019. All rights reserved.

 ? 2019 MyFonts Inc
*/
var protocol=document.location.protocol;"https:"!=protocol&&(protocol="http:");var count=document.createElement("script");count.type="text/javascript";count.async=!0;count.src=protocol+"//hello.myfonts.net/count/39f8e9";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(count,s);var browserName,browserVersion,webfontType;if("undefined"==typeof woffEnabled)var woffEnabled=!0;var svgEnabled=0,woff2Enabled=1;
if("undefined"!=typeof customPath)var path=customPath;else{var scripts=document.getElementsByTagName("SCRIPT"),script=scripts[scripts.length-1].src;script.match("://")||"/"==script.charAt(0)||(script="./"+script);path=script.replace(/\\/g,"/").replace(/\/[^\/]*\/?$/,"")}
var wfpath=path+"/webfonts/",browsers=[{regex:"MSIE (\\d+\\.\\d+)",versionRegex:"new Number(RegExp.$1)",type:[{version:9,type:"woff"},{version:5,type:"eot"}]},{regex:"Trident/(\\d+\\.\\d+); (.+)?rv:(\\d+\\.\\d+)",versionRegex:"new Number(RegExp.$3)",type:[{version:11,type:"woff"}]},{regex:"Firefox[/s](\\d+\\.\\d+)",versionRegex:"new Number(RegExp.$1)",type:[{version:3.6,type:"woff"},{version:3.5,type:"ttf"}]},{regex:"Edge/(\\d+\\.\\d+)",versionRegex:"new Number(RegExp.$1)",type:[{version:12,type:"woff"}]},
{regex:"Chrome/(\\d+\\.\\d+)",versionRegex:"new Number(RegExp.$1)",type:[{version:36,type:"woff2"},{version:6,type:"woff"},{version:4,type:"ttf"}]},{regex:"Mozilla.*Android (\\d+\\.\\d+).*AppleWebKit.*Safari",versionRegex:"new Number(RegExp.$1)",type:[{version:4.1,type:"woff"},{version:3.1,type:"svg#wf"},{version:2.2,type:"ttf"}]},{regex:"Mozilla.*(iPhone|iPad).* OS (\\d+)_(\\d+).* AppleWebKit.*Safari",versionRegex:"new Number(RegExp.$2) + (new Number(RegExp.$3) / 10)",unhinted:!0,type:[{version:5,
type:"woff"},{version:4.2,type:"ttf"},{version:1,type:"svg#wf"}]},{regex:"Mozilla.*(iPhone|iPad|BlackBerry).*AppleWebKit.*Safari",versionRegex:"1.0",type:[{version:1,type:"svg#wf"}]},{regex:"Version/(\\d+\\.\\d+)(\\.\\d+)? Safari/(\\d+\\.\\d+)",versionRegex:"new Number(RegExp.$1)",type:[{version:5.1,type:"woff"},{version:3.1,type:"ttf"}]},{regex:"Opera/(\\d+\\.\\d+)(.+)Version/(\\d+\\.\\d+)(\\.\\d+)?",versionRegex:"new Number(RegExp.$3)",type:[{version:24,type:"woff2"},{version:11.1,type:"woff"},
{version:10.1,type:"ttf"}]}],browLen=browsers.length,suffix="",i=0;
a:for(;i<browLen;i++){var regex=new RegExp(browsers[i].regex);if(regex.test(navigator.userAgent)){browserVersion=eval(browsers[i].versionRegex);var typeLen=browsers[i].type.length;for(j=0;j<typeLen;j++)if(browserVersion>=browsers[i].type[j].version&&(1==browsers[i].unhinted&&(suffix="_unhinted"),webfontType=browsers[i].type[j].type,"woff"!=webfontType||woffEnabled)&&("woff2"!=webfontType||woff2Enabled)&&("svg#wf"!=webfontType||svgEnabled))break a}else webfontType="woff"}
/(Macintosh|Android)/.test(navigator.userAgent)&&"svg#wf"!=webfontType&&(suffix="_unhinted");var head=document.getElementsByTagName("head")[0],stylesheet=document.createElement("style");stylesheet.setAttribute("type","text/css");head.appendChild(stylesheet);
for(var fonts=[{fontFamily:"SofiaPro-UltraLightitalic",url:wfpath+"39F8E9_0"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Bold",url:wfpath+"39F8E9_1"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Bolditalic",url:wfpath+"39F8E9_2"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-ExtraLight",url:wfpath+"39F8E9_3"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Blackitalic",url:wfpath+"39F8E9_4"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Black",url:wfpath+"39F8E9_5"+suffix+"_0."+webfontType},
{fontFamily:"SofiaPro-Light",url:wfpath+"39F8E9_6"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Medium",url:wfpath+"39F8E9_7"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Lightitalic",url:wfpath+"39F8E9_8"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-ExtraLightitalic",url:wfpath+"39F8E9_9"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Regular",url:wfpath+"39F8E9_A"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Mediumitalic",url:wfpath+"39F8E9_B"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-SemiBold",
url:wfpath+"39F8E9_C"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-Regularitalic",url:wfpath+"39F8E9_D"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-UltraLight",url:wfpath+"39F8E9_E"+suffix+"_0."+webfontType},{fontFamily:"SofiaPro-SemiBolditalic",url:wfpath+"39F8E9_F"+suffix+"_0."+webfontType}],len=fonts.length,css="",i=0;i<len;i++){var format="svg#wf"==webfontType?'format("svg")':"ttf"==webfontType?'format("truetype")':"eot"==webfontType?"":'format("'+webfontType+'")',css=css+("@font-face{font-family: "+
fonts[i].fontFamily+";src:url("+fonts[i].url+")"+format+";");fonts[i].fontWeight&&(css+="font-weight: "+fonts[i].fontWeight+";");fonts[i].fontStyle&&(css+="font-style: "+fonts[i].fontStyle+";");css+="}"}stylesheet.styleSheet?stylesheet.styleSheet.cssText=css:stylesheet.innerHTML=css;
