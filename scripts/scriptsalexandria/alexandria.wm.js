// your KEY
var WM_Alexandria_key = '175-38-126-103-37-51-31-144-45-814-807-816-819-809-807-827-809-759-813-826-825-762-767-768-769-769';

// The language used in your html pages 
// used by Alexandria when it can not determine the "page" language by itself
var WM_Alexandria_defaultSourceLanguage = "fr";
// used by Alexandria when it can not determine the "user" language by itself
// if it is different from WM_Alexandria_defaultSourceLanguage, translations are displayed instead of definitions and synonyms
var WM_Alexandria_defaultTargetLanguage = "gb";
// The charset used in your html pages 
// used by Alexandria when it can not determine it by itself
var WM_Alexandria_defaultCharset        = "UTF-8";

// Reserved word
// when someones clicks on these words, the page with the given url is displayed instead of Alexandria's data
// Beware : case-insensitive !!!
// Available with all options

var WM_Alexandria_reservedWords = [
  'Dutoit',                   'http://www.memodata.com/alexandria-memodata/definitions_fr/def.dominique_dutoit.fr.html',
  'Dominique Dutoit',         'http://www.memodata.com/alexandria-memodata/definitions_fr/def.dominique_dutoit.fr.html',
  'MEMODATA',                 'http://www.memodata.com/alexandria-memodata/definitions_fr/def.memodata.fr.html', 
  'Alex',                     'http://www.memodata.com/alexandria-memodata/definitions_fr/def.alexandria.fr.html',
  'Alexandria',               'http://www.memodata.com/alexandria-memodata/definitions_fr/def.alexandria.fr.html', 
  'Dictionnaire Intégral',    'http://www.memodata.com/alexandria-memodata/definitions_fr/def.di.fr.html',
  'DICTIONNAIRE INTEGRAL',    'http://www.memodata.com/alexandria-memodata/definitions_fr/def.di.fr.html',
  'LE DICTIONNAIRE INTEGRAL', 'http://www.memodata.com/alexandria-memodata/definitions_fr/def.di.fr.html',
  'SEMIOGRAPHE',              'http://www.memodata.com/alexandria-memodata/definitions_fr/def.semiographe.fr.html',
  'Sémiographe',              'http://www.memodata.com/alexandria-memodata/definitions_fr/def.semiographe.fr.html',
  'DICOLOGIQUE',              'http://www.memodata.com/alexandria-memodata/definitions_fr/def.dicologique.fr.html'];

// Do you want your reserved words to be double-underlined and reactive ?
// values : Y,N
// default value : N
var WM_Alexandria_highlight_reservedWords = "Y";
// values : 
//  - "closed" : only if the Alexandria window is closed
//  - "always" : no matter if the Alexandria window is closed or open         
// default value : "always"
var WM_Alexandria_highlight_reservedWords_options = "always";
// timeout before reaction of the reserved word (in milliseconds)
var WM_Alexandria_highlight_reservedWords_timeout = "250";
// Highlited reserved words underline style
// values : "double", "dashed", "none"
// default value : double
var WM_Alexandria_highlighted_reservedWords_style = "double";

// Doctype ( null, "HTML4", "XHTML" )
// default value : null
var WM_Alexandria_doctype = null;

// Is toolbar visible or not ?
// values : Y,N
var WM_Alexandria_show_toolbar = "Y";

// ---------------------------- NOT FREE OPTIONS --------------------------------------

// URL of your CSS to be applied on Alexandria's data
// Only available with the "CSS option"
var WM_Alexandria_cssURL = null;

// Colors of the title bar
// Only available with the "CSS option"
var WM_Alexandria_titleBackgroundColor = null;
var WM_Alexandria_titleTextColor       = null;
// max 20 characters
var WM_Alexandria_titleText            = 'MEMODATA';

// Sizes of the frames  
// Only available with the "FRAMES option"
var WM_Alexandria_topZoneHeight    = 0;
var WM_Alexandria_bottomZoneHeight = 50;
var WM_Alexandria_middleZoneHeight = 180;
var WM_Alexandria_leftZoneWidth    = 0;
var WM_Alexandria_rightZoneWidth   = 0;
var WM_Alexandria_dataWidth        = 500;

// ----------------------------------------------------
// Content of the left zone (HTML)
// Only available with the "FRAMES option"
function WM_Alexandria_getLeftZone()
{
  return '';
}
// ----------------------------------------------------
// Content of the right zone (HTML)
// Only available with the "FRAMES option"
function WM_Alexandria_getRightZone()
{
  return '';
}
// ----------------------------------------------------
// Content of the bottom zone (HTML)
// Only available with the "FRAMES option"
function WM_Alexandria_getBottomZone()
{
  return '<IFRAME style="width:100%;height:100%" SRC="http://www.sensagent.com/alexandria/getAddAlexandria.jsp?t=bas" frameborder=0 scrolling=auto></IFRAME>';
}

// ----------------------------------------------------
// Content of the top zone (HTML)
// Only available with the "FRAMES option"
function WM_Alexandria_getTopZone()
{
  return '';
}


