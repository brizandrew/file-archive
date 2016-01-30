# file-archive

#### Description
The file-archive is an SQL database dependent system that stores file references as IDs with relevant tags. These tags are predetermined by a system admin through the admin portal. In version 1.0, the system does not hold the actual files themselves. Those are to be stored somewhere else with just the ID number. 

*Note: This system was originally built to be used with video files. For that reason some variable names or html IDs might reference this original design. I switched the front end names from "Video" to "File" when I realized this could be used for any file. The back end references will be removed in a future update.*

#### Setup
1. Install files on host server.
2. Update variables in database.php with your server information.
3. Update "password" variable inside admin.php to setup an admin password.
4. (Optional) If using PHP 5.6+, delete "retrieve.php" and rename "retrieve_php5-6.php" to "retrieve.php".
