# calendar

## Installation

- Configure your web-server to www folder
- Create database and configure /application/config/database.php
- Upload dumps from DB folder
- Change options in /application/config/config.php
 
    $config['base_url'] = 'http://calendar/';
    
    $config['reply_email'] = "noreply@example.com";
    
    to your URL and Reply email address to user invitation.
    
- That's all
- Default admin account is email "admin@example.com" with password "admin"

## P.S.
In your specification you did not describe about event status and I leave this field as simple text

