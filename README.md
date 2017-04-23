# calendar

##Installation

- Configure your web-server to www folder
- Create database and configure /application/config/database.php
- Upload dumps from DB folder
- Change options
 
    $config['base_url'] = 'http://calendar/';
    
    $config['reply_email'] = "noreply@example.com";
    
    to your URL and Reply email address to user invitation.
    
- That's all

##P.S.
In your specification you did not describe about event status and I leave this field as simple text

