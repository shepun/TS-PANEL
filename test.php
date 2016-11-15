<?php 

/*     
 *    TeamSpeak3 Password Encrypter by Actium <Actium****.net> 
 * 
 *    Revision:    2 
 *    Latest change:    Tue, 29 Dec 2009 10:25:02 +0100 
 * 
 *    Copyright (c) 2009, Actium <Actium****.net> 
 *    All rights reserved. 
 *      
 *    Redistribution and use in source and binary forms, with or without 
 *    modification, are permitted provided that the following conditions are met: 
 *        * Redistributions of source code must retain the above copyright 
 *          notice, this list of conditions and the following disclaimer. 
 *        * Redistributions in binary form must reproduce the above copyright 
 *          notice, this list of conditions and the following disclaimer in the 
 *          documentation and/or other materials provided with the distribution. 
 *        * Neither the name of Actium nor the 
 *          names of his contributors may be used to endorse or promote products 
 *          derived from this software without specific prior written permission. 
 *     
 *    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
 *    ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
 *    WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE 
 *    DISCLAIMED. IN NO EVENT SHALL ACTIUM BE LIABLE FOR ANY 
 *    DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES 
 *    (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; 
 *    LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND 
 *    ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT 
 *    (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS 
 *    SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. 
 *     
 */ 

function encrypt_ts3_client_password($password) { 
    return(base64_encode(sha1($password, true))); 
} 

?> 
<?php print('<?xml version="1.0" encoding="utf-8"?>'); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
    <title>TeamSpeak3 Password Encrypter</title> 
</head> 
<body> 
    <form action="<?php print($_SERVER['REQUEST_URI']); ?>" method="post" accept-charset="utf-8"> 
    <div> 
        <input type="text" name="password" size="60" value="<?php if(isset($_POST['password'])) { print(encrypt_ts3_client_password($_POST['password'])); }; ?>" /> 
        <span>&nbsp;</span><input type="submit" /> 
    </div> 
    </form> 
</body> 
</html>