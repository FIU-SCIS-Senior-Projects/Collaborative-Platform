#Collaborative-Platform-Ver-5.0

##Directory Structure
* **Code**:                    Contains Source Code and DBSchema Script
* **Documents**:               Contains all documentation: RD, DD, FSPP and more.
* **FinalPresentationSlides**  Contains presentations of the participants.
* **Posters**                  Contains all presentation posters on the project.
* **Videos**                   Contains installation videos, module presentation, etc.

##Deployed Site
* [Development Server](cp-dev.cis.fiu.edu)
* [Production Server](cp.cis.fiu.edu)

##Coding Guidelines

* Single quotes unless extremely necessary
* No php short tags. Instead of  ```<?=  we should use  <?php echo  
http://stackoverflow.com/questions/1386620/php-echo-vs-php-short-tags/```
* No inline css styles
* Do not change the ```template_header``` or ```template_footer``` files
* Source Control Guidelines
* Every commit should have a meaningful message.
* Commits should be small.
* It would be sane for each one of us to develop our stuff on a ```development``` separate branch and then merge it to the ```master``` once stable.
* The best way I found of doing this is first merging the destiny branch (master) into our development branch first.
* Conflicts should be solved in the ```development``` branch.
* After the ```development``` branch is conflict free, it should be merged back to the master branch with a nice commit message

##Code Deployment Guide
1. Connect to the remote server ussing ```ssh```
2. Enter the website directory
 ```cd /var/www/html/senior-projects/ ```
3. Switch to the master branch. Or any branch you want to publish
 ```sudo git checkout master ```
4. Download the latest version of the source code
 ```sudo git pull ```