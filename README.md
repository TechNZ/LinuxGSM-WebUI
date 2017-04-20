# LinuxGSM-WebUI
Web UI for LinuxGSM - initially purely internal
Im not good at writing readme's and this code was never to see the light of day.
lets see how this goes.

this system make use of the SQL structure that ProFTPD uses for MySQL authentication.
i suggest you make use of this functionality in order to allow yout users to keep FTP and web ui in sync.

the code is written in basic php using a mysql database for storage, and a little bit of bash magic to pull it all together.

the WebUI itself is handled purely from within its document root, however external function calls are made using absolute paths.

if you operate users as a seperate user to your web server, you will need to adjust script.sh to match teh user and directory structure.

i highly recommend creating a specific nopasswd entry in your /etc/sudoers file so that you can execute script.sh specifically.
without sudo you will be prompted for the username when script.sh calls the su command, which wont be available to being a non interactive session.

the majority of admin functionality can be done from withing the WebUI hwoever permission setting must be done directly through the MySQL database, simply change the 0 to 1 or vice versa for the respective serer id in the servers_username table.

if you should ever need to manually change a users password without access the the WebUI admin functions, you can generate a password has by attempting to login with the user "hashme" and with the passsword you wish to have hashed, this will output the relevant hash that can be placed into the MySQL database to alter a users password.

i hope that i have covered the majory of things that need to be adjusted, if you need any more information let me know.

i am not looking to progress with this iteration on the WebUI any further, i am looking at starting a dynamic WebUI complete with server install and configuration functionality.

Regards
Techie
