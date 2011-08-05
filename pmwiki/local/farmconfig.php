<?php if (!defined('PmWiki')) exit();

##############################################
########## Allgemeine Einstellungen ##########
##############################################

$FarmPubDirUrl = 'http://wikifarm.amnesty-intern.de/pub'; # Unter dieser Adresse liegt die gemeinsame CSS-Datei, die das Aussehen der Seite steuert. Dadurch kann zentral eine Ver�nderung des Layouts vorgenommen werden.

$EnablePathInfo = 1; # Die Adresse im Browser wird von "http://www.amnesty.orscholz.de/pmwiki.php?p=Main.Start" zu "http://www.amnesty.orscholz.de/Main/Start"

putenv("TZ=CET-1CEST"); # Mitteleurop�ische Zeit
$TimeFmt = '%d. %B %Y, um %H:%M Uhr'; # Das Format, in dem Datum und Uhrzeit angezeigt werden.

XLPage('de','PmWikiDe.XLPage'); # Aktiviert die deutsche �bersetzung des Wikis inl. der Hilfsseiten
XLPage('de','PmWikiDe.XLPageCookbook'); # Aktiviert m�gliche deutsche �bersetzungen der Rezepte s.u.

$DefaultName = 'Start'; # Die Startseite in jeder Gruppe hei�t "Start". Die Standardeinstellung ist "HomePage".
$AuthorGroup='Profile'; # Name der Autorengruppe, Voreinstellung 'Profiles'
$AuthorRequiredFmt = 'Gib Deinen Namen/K�rzel an'; # Deutsche �bersetzung der Meldung, wenn ein Autorenname verlangt wird.
$DefaultPageTextFmt = 'Die Seite $Name gibt es nicht'; # Deutsche �bersetzung der Meldung, wenn eine Seite nicht existiert. 

$PageNotFound = 'PmWikiDe.PageNotFound'; # Die Seite, auf die umgeleitet wird, wenn Seite nicht gefunden wurde
$PageRedirectFmt = '<p><i>umgeleitet von $FullName</i></p>'; # Deutsche �bersetzung der Meldung, wenn man von einer anderen Seite umgeleitet wurde. 

$DeleteKeyPattern = "^\\s*loeschmich\\s*$"; # Ausdruck, der bewirkt, dass die Seite gel�scht werden soll. Voreinstellung ist 'delete'

$GroupPattern = '(?:Site|SiteAdmin|PmWikiDe|Main|Profile|Intern)'; # Zul�ssige Gruppen im Wiki. Weiter Gruppen k�nnen nicht angelegt werden.

$MaxIncludes = 300; # Maximale Anzahl von Seiten im Archiv.


######################
##### Kennw�rter #####
######################

$DefaultPasswords['admin'] = array('$1$CYyFNCqP$LzukB9oUt.tRhUCkdLlVf.'); # Das Standard-Admin-Passwort
$HandleAuth['upload'] = 'edit'; # Hierdurch darf jeder, der eine Seite bearbeiten darf, auch Dateien hochladen
if(($group=="Site") || ($group=="SiteAdmin") || ($group=="PmWikiDe") ) # Durch die folgenden Zeilen, darf man die Attribute einer Seite dann festlegen, wenn man die Seite bearbeiten kann, au�er in den Gruppen "Site" und "SiteAdmin".
	{
	$HandleAuth['attr'] = 'admin';
	} else
	{
	$HandleAuth['attr'] = 'edit';
	}


##############################################
##### Hochladen von Anh�ngen und Bildern #####
##############################################

$EnableUpload = 1; # Das Hochladen von Anh�ngen und Bildern aktivieren
$EnableDirectDownload=0; # Hierdurch werden Anh�nge und Bilder immer �ber das Wiki geladen und nicht direkt vom Server. Das soll die Sicherheit von vertraulichen Dateien verbessern. Im Zweifel haben vertrauliche Daten aber nichts im Wiki verloren, bzw. sollten verschl�sselt werden.
SDV($UploadMaxSize,10000000); # Maximale Gr��e von Anh�ngen und Bildern: 10 MB.

##Gruppenname
global $AiGroupName;
#$AiGroupName=PageVar('Site.Konfiguration','$:Gruppenname');
$WikiTitle = "Amnesty International - $AiGroupName";



#Amnesty Thema
$Skin = 'amnestyde';


#################
#### Rezepte ####
#################

# e-protect #
# Verschl�sselte Darstellung von E-Mail-Adressen im Seitenquelltext. Dadurch soll SPAM verhindert werden.
# http://www.pmwiki.org/wiki/Cookbook/EProtect

include_once("$FarmD/cookbook/e-protect.php");

# PageTableOfContents #
# Hierdurch wird das Einf�gen von Inhaltsverzeichnissen m�glich
# http://www.pmwiki.org/wiki/Cookbook/PageTableOfContents

$DefaultTocTitle = "Inhalt dieser Seite...";
$TocBackFmt = "Zur&uuml;ck zum Inhalt";
$ToggleText = array('Ausblenden', 'Einblenden');
$TocFloat = true;
$NumberToc = false;
include_once("$FarmD/cookbook/pagetoc.php");



# PmFeed #
# Erm�glicht die Einbindung und Anzeige externer RSS-Feeds
# http://www.pmwiki.org/wiki/Cookbook/PmFeed

include_once("$FarmD/cookbook/pmfeed.php");

# Fox # 
# Fox ist ein abstraktes Werkzeug, das vor allem dazu dient, Teilinhalte von Seiten zu bearbeiten und neue Seiten automatisch anzulegen. F�r diese neue Seiten k�nnen auch Vorlagen verwendet werden. Ein Beispiel hierf�r sind die automatisch angelegten Eintr�ge auf der Startseite
# http://www.pmwiki.org/wiki/Cookbook/Fox

include_once("$FarmD/cookbook/fox/fox.php");

# PowerTools #
# PowerTools ist ein Abstraktes Werkzeug, das es erm�glicht mehrere Seiten auf einmal anzusprechen.
# http://www.pmwiki.org/wiki/Cookbook/PowerTools

include_once("$FarmD/cookbook/powertools.php");

# GroupTitle #
# GroupTitle erlaubt es einen Titel f�r eine Wiki-Gruppe anzulegen. Es wird konkret verwendet um nat�rlichsprachliche Namen in der Zeile einzublenden, die angibt, auf welcher Seite man sich gerade befindet (Breadcrums).
# http://www.pmwiki.org/wiki/Cookbook/GroupTitle

include_once("$FarmD/cookbook/grouptitle.php");
$GroupTitlePathFmt = '$Group.GroupAttributes'; # Nur die Seite GroupAttributes nach Gruppentitel durchsuchen. Als Umkehrschluss daraus kann man den Gruppentitel auch nur auf der Seite GroupAttributes festlegen.

# PTVReplace #
# Durch PTVReplace kann man Seiten-Text-Variablen (PTV = Page Text Variable) ver�ndern. Diese Variablen werden z.B. auf der Seite mit den Informationen zur Gruppe abgelegt.
# http://www.pmwiki.org/wiki/Cookbook/PTVReplace

include_once("$FarmD/cookbook/ptvreplace.php");

# PageRevInline #
# Eine deutlichere Darstellung der �nderungen im Wiki-Quelltext
# http://www.pmwiki.org/wiki/Cookbook/InlineDiff

if ($action=='diff') # Nur, wenn die �nderungen einer Seite angezeigt werden sollen, wird das Rezept eingebunden.
include_once("$FarmD/cookbook/pagerevinline/pagerevinline.php");
	
# SearchBox 2 #
# Hiermit wird das Suchfeld erzeugt.
#! Sollte in Zukunft durch eine andere L�sung ersetzt werden !#

include_once("$FarmD/cookbook/searchbox2.php");

# Mini #
# Mini erzeugt die kleinen Thumbnails in den automatisierten Eintr�gen. Es ist aber sehr m�chtig und kann auch zur Erzeugung von Bildergalerien verwendet werden.
# http://www.pmwiki.org/wiki/Cookbook/Mini

$Mini['EnableLightbox'] = 1; # Sch�nere Vorschau mit Hilfe von lightbox
$Mini['LbUrl'] = "$FarmPubDirUrl/lb" ; # Der Pfad, in dem lightbox liegt
$Mini['thumbs'][0] = "160x160"; # Standardgr��e der Thumbnails
include_once("$FarmD/cookbook/mini.php");

# AttachDelete #
# Erm�glicht das L�schen von Anh�ngen direkt aus dem Wiki heraus
# http://www.pmwiki.org/wiki/Cookbook/AttachDelete

include_once("$FarmD/cookbook/attachdel.php");

# swf-sites #
# Erm�glicht das Einbinden von Youtube-Videos
# http://www.pmwiki.org/wiki/Cookbook/Flash

include_once("$FarmD/cookbook/swf-sites.php");

# Site Analyzer #
# Erm�glicht die �berpr�fung der Versionen der verwendeten Software und der Rezept auf der Seite von pmwiki
# http://www.pmwiki.org/wiki/PmWiki/SiteAnalyzer

include_once("$FarmD/cookbook/analyze.php");
$AnalyzeKey = 'aedmr';

# pmform #
# Ein abstraktes Werkzeug zum Erzeugen und Verarbeiten von HTML-Formularen im Wiki. Es wird f�r das Kontaktformular verwendet.
# http://www.pmwiki.org/wiki/Cookbook/PmForm

include_once("$FarmD/cookbook/pmform.php");
$PmFormMailHeaders = 'Content-type: text/plain; charset="utf-8"'; # Darstellung der E-Mail in UTF-8 (erm�glicht die direkte Verwendung von Sonderzeichen und sollte mit der verwendeten Textkodierung des Wikis (s.o.) �bereinstimmen).
global $AiContactMail;
$PmForm['kontakt'] = 'mailto=$AiContactMail form=#kontaktform fmt=#kontaktpost'; # $AiContactMail ist eine Variable, die in der Gruppenkonfiguration (gruppe/local/config.php) festgelegt wird.

# WebFeeds (RSS) #
# Eine Standarfunktion von pmwiki, die hier nur aktiviert wird. Sie erlaubt die Erzeugung eines RSS-Feeds f�r das Wiki. Ein solcher wird auf der Startseite f�r die automatisierten Eintr�ge verwendet.
# http://www.pmwiki.org/wiki/PmWiki/WebFeeds

if ($action == 'rss') include_once("$FarmD/scripts/feeds.php");
if ($action == 'rss')
     SDVA($_REQUEST, array(
       'group' => 'Main',
       'order' => '-time',
       '$:Blog' => 'Ja',
       'count' => '10',
       'name' => '-Willkommen'));
$FeedFmt['rss']['item']['title'] = '{$Title} : {$Description}';
$FeedFmt['rss']['item']['description'] = 'FeedText';

  function FeedText($pagename, &$page, $tag) {
    $p = ReadPage($pagename);
    $content = MarkupToHTML($pagename, $p['text']);
    return "<$tag><![CDATA[$content]]></$tag>";
  }
#$EnableSitewideFeed = 0;
$EnableRssLink  = 1;
$EnableAtomLink = 0;
$FeedLinkSourcePath = 'Main/Start';
include_once("$FarmD/cookbook/feedlinks.php");

# SwitchToSSLMode #
# Zumindest die Passw�rter werden per SSL verschl�sselt. Daher kommt beim Einloggen auch der Hinweis auf das ung�ltige Zertifkat. 
# http://www.pmwiki.org/wiki/Cookbook/SwitchToSSLMode

SDVA($InputTags['auth_form'], array(
':html' => "<form
action='https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}'
method='post'
name='authform'>\$PostVars"));

# WebsiteIcon #
# Erm�glicht das Einbinden eines sog. FavIcons, also eines kleinen Symbols f�r die Seite, das im Webbrowser angezeigt wird.
# http://www.pmwiki.org/wiki/Cookbook/WebsiteIcon
SDV($FavIcon, 'http://wikifarm.amnesty-intern.de/pub/skins/amnestyde/favicon.ico'); # Der Speicherort f�r das FavIcon.
include_once("$FarmD/cookbook/WebsiteIcon.php");