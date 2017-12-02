# JapanPlaces

VirtualBox5.2 with Vagrant and Homestead was used. 

here the steps to run it:
1) After clonning the project move to this folder 'JapanPlaces':
 cd JapanPlaces
2) Start the VB:  vagrant up
3) Log into the VB:  vagrant ssh
4) Move the the root dir:  cd code
5) Run composer to install the packages and generate the autoload file:
     php composer.phar install
6) Run the migration and seeding scripts:
     php artisan migrate:refresh --seed
    

The project is setup to run with this hostname:  homestead.test 

 
 
 
