// ----------------------------------------------------
// PARAMETERS
// ----------------------------------------------------

// la valeur de départ de l'opacité
var opacityStartingValue  = 0;
// la valeur maximum de l'opacité (entre 0 et 100) 
var opacityMaxValue       = 90;
// le temps (en millisecondes) entre chaque changement de l'opacité 
var opacityIncrementDelay = 25;
// la modification à apporter à l'opacité à chaque pas 
var opacityIncrement      = 1;
// le temps (en millisecondes) pendant lequel l'alerte reste affichée avec l'opacité maximum 
var maxOpacityWaitDelay   = 5000;
// le temps (en millisecondes) pendant lequel l'alerte reste invisible entre chaque affichage
var minOpacityWaitDelay   = 500;
// le nombre d'affichage de l'alerte
var displayCount          = 1;
// l'url de l'image à afficher
var imageUrl              = "./scripts/alert.fr.2D-blanc-bleu-transparent.gif";

// la position de l'alerte
// values : "top-left","top-middle","top-right",
//          "bottom-left","bottom-middle","bottom-right",
//          "center-left","center-middle","center-right"
var alertPosition = "bottom-middle"
// la marge gauche (ou droite)
var leftRightMargin = 10;
// la marge haute (ou basse)
var topBottomMargin = 10;
// faut-il redessiner l'alerte si la taille de la fenêtre change ?
// values : true, false
var moveWithWindow = true;

// ----------------------------------------------------
// INFORMATIONS SUR LA FENETRE (largeur, hauteur, etc.)
// ----------------------------------------------------

// récupérer la largeur de la fenêtre
function __getWidth()
{
  // Netscape
  if ( window.innerWidth )
    return window.innerWidth;
  // XHTML
  else if (document.documentElement && document.documentElement.clientWidth) 
    return document.documentElement.clientWidth;
  // Internet Explorer
  else
    return document.body.clientWidth;
}

// ----------------------------------------------------
// récupérer la hauteur de la fenêtre
function __getHeight()
{
  // Netscape
  if ( window.innerHeight )
    return window.innerHeight;
  // XHTML
  else if (document.documentElement && document.documentElement.clientHeight) 
    return document.documentElement.clientHeight;
  // Internet Explorer
  else
    return document.body.clientHeight;
}

// ----------------------------------------------------
// récupérer la position haute de la fenêtre (en tenant compte des ascenceurs)
function __getTop()
{
  var res = 0;
  if ( document.documentElement )
  {
    res = document.documentElement.scrollTop;
    if ( res == 0 )
      res = document.body.scrollTop;
  }
  else
    res = window.pageYOffset;

  return res;
}

// ----------------------------------------------------
// récupérer la position gauche de la fenêtre (en tenant compte des ascenceurs)
function __getLeft()
{
  try
  {
    if ( document.documentElement )
      return document.documentElement.scrollLeft;
  }
  catch (e) {}
  try
  {
    if ( document.body && document.body.scrollLeft )
      return document.body.scrollLeft;
  }
  catch (e) {}

  return window.pageXOffset;
}

// ----------------------------------------------------
// POSITIONNEMENT DE LA FENETRE
// ----------------------------------------------------

function positionAlert()
{
  var nDivAlert = document.getElementById("alexandria-alert-div");
  var imageWidth  = nDivAlert.offsetWidth;
  var imageHeight = nDivAlert.offsetHeight;

  var bTop    = (alertPosition.substr(0,3) == "top");
  var bBottom = !bTop && (alertPosition.substr(0,6) == "bottom");
  var bCenter = !bTop && !bCenter && (alertPosition.substr(0,6) == "center");
  var bLeft   = (alertPosition == "top-left") || (alertPosition == "bottom-left") || (alertPosition == "center-left");
  var bRight  = !bLeft && ( (alertPosition == "top-right") || (alertPosition == "bottom-right") || (alertPosition == "center-right") );
  var bMiddle = !bLeft && !bRight && ( (alertPosition == "top-middle") || (alertPosition == "bottom-middle") || (alertPosition == "center-middle") );
  var bError  = (!bTop && !bBottom && !bCenter ) || (!bLeft && !bRight && !bMiddle);

  var windowTop    = __getTop();
  var windowLeft   = __getLeft();
  var windowHeight = __getHeight();
  var windowWidth  = __getWidth();

  // la position verticale
  if ( bTop ) 
    nDivAlert.style.top = windowTop+topBottomMargin;
  if ( bBottom ) 
    nDivAlert.style.top = windowTop+windowHeight-topBottomMargin-imageHeight;
  if ( bCenter ) 
    nDivAlert.style.top = windowTop+(windowHeight-imageHeight)/2;

  // la position horizontale
  if ( bLeft ) 
    nDivAlert.style.left = windowLeft+leftRightMargin;
  if ( bRight ) 
    nDivAlert.style.left = windowLeft+windowWidth-leftRightMargin-imageWidth;
  if ( bMiddle ) 
    nDivAlert.style.left = windowLeft+(windowWidth-imageWidth)/2;
}

// ----------------------------------------------------
// BOUCLE TRANSPARENCE
// ----------------------------------------------------
var opacityValue  = 0;
// ----------------------------------------------------
function initAlert()
{  
  document.write(  '<div id="alexandria-alert-div" style="position:absolute;z-index:1000">'
                  +'<img src="'+imageUrl+'" id="alexandria-alert-img" style="position:relative;filter:alpha(opacity='+opacityValue +');-moz-opacity:.'+opacityValue +';opacity:.'+opacityValue+'";/></div>');
}
// ----------------------------------------------------
function drawFirstAlert()
{
  positionAlert();
  drawAlert();
}
// ----------------------------------------------------
function drawAlert()
{
  if ( displayCount > 0 )
  {
    if ( moveWithWindow )
      positionAlert();
    if ( opacityValue >= 0 )
      opacityValue += opacityIncrement;
    else
      opacityValue = 0; 
    document.getElementById("alexandria-alert-img").style.filter='alpha(opacity='+opacityValue +')';
    document.getElementById("alexandria-alert-img").style.opacity=(opacityValue/100);
    document.getElementById("alexandria-alert-img").style.KHTMLOpacity=(opacityValue/100);
    document.getElementById("alexandria-alert-img").style.MozOpacity=(opacityValue/100);

    if ( opacityValue >= opacityMaxValue )
    {
      opacityValue = -1;
      setTimeout('drawAlert()',maxOpacityWaitDelay);
      displayCount--;
    }
    else if ( opacityValue == 0 )
    {
      opacityValue = opacityStartingValue;
      setTimeout('drawAlert()',minOpacityWaitDelay);
    }
    else
      setTimeout('drawAlert()',opacityIncrementDelay );
  }
  else
    document.getElementById("alexandria-alert-div").style.visibility='hidden';
}

// ----------------------------------------------------
// MAIN
// ----------------------------------------------------

if (document.addEventListener)
  document.addEventListener("DOMContentLoaded", drawFirstAlert, null);
else if ( document.all )
  window.attachEvent("onload",drawFirstAlert);
else if (window.onload)
  window.onload=drawFirstAlert;

initAlert();


