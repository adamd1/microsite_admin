# microsite_admin
This is a quick php script that generates password protection for a small admin section of a custom microsite.

The form requests a brand name, username and password, and from those values it generates a small set of file outputs so you can put together a quick admin site in no time at all.

The login is stored via a PHP session value that lasts one hour.

The password encryption is generated using 256-bit encryption with PHP's "mcrypt".

The encryption function creates a hash of the password value so you can verify that the data was decrypted successfully, but that part can of course be easily removed. The goal here was to quickly create a password-protected directory for small branded microsites.
