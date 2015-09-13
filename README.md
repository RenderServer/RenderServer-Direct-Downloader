RenderServer direct download generator POC

How?

Every time you load a download link on RenderServer they generate multiple hashes for that download, one of those hashes is the time expiration check.

For example, the download button for the download at: http://renderserver.net/?dl=75cde51a53771c42912df4f86dbe73be 
would have the (direct) link of: http://renderserver.net/vfm-admin/vfm-downloader.php?q=ZGV2cy83Nzdqb24vRzMvNzc3LUtlcm5lbC9BT1NQLTc3Ny1LZXJuZWxfZDg1MC1SMTcuemlw&h=96982a94619f1edb3b5fb0276b21de30&sh=fb02a5888647c236dd1f8767049b2621&t=48f576d1ed7687bef3c4f47a57c567f1

When the download button is clicked the generated hashes (plus verification &t=) are posted to the downloader script, which checks the posted &t= md5 against another md5 it generated via the same processes (md5($time.$salt2)). If the md5's match it'll let you download, else it'll return an error. The verification md5 changes hourly due to it being based off the servers (hourly) time value, thus the links expire hourly too.


To make the link generator I had to reverse the following values:

http://renderserver.net/vfm-admin/vfm-downloader.php
?q=*value*
&h=*value*
&sh=*value*
&t=*value*


Here are my findings. 

q = base64($full_file_path.$file_name)
h = md5($file_name)
sh = md5($h.$salt.$q)
t = md5($time.$salt2)

Note that for the links to work, your server time must be in sync with theirs, otherwise you'll be generating expired links. They use Europe/London time.
Getting the salts was trivial, at best. - But I won't get into that. 

Someone with more time than me can probably make a Chrome/FireFox addon which does the same as my script.

Lastly, time is generated with the function date("j:F:Y:h"), hence why links only expire hourly- see http://www.w3schools.com/php/func_date_date.asp for more info.
More info is provided in the PHP itself.

Why?

Because ad free downloads FTW!
