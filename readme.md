# Application gestion de produits

Etapes d'installation du projet :

 #1- Cloner le repository (git clone "https......")  
 #2- cd app-produits  
 #3- Composer require  
 #4- Créer un fichier .env.local et y collé: DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7  , y ajouté vos logins  
 #5- faire un php bin/console doctrine:database:create   
 #6- faire un php bin/console doctrine:migrations:migrate   
 #7- faire une php bin/console doctrine:fixtures:load pour charger les fixtures  
 #8- démarré le serveur avec la commande: symfony serve -d 
 
 
 Pour les fixtures j'ai créé pour les photos une imageUrl donc cela est fonctionnel mais pour tester et voir apparaitre une image ajouté via le formulaire il y as une petite chose à changer:
 
 dans le dossier templates, aller dans le dossier produits et index.html.twig
 ligne 14 il faut pensé à décommenter {{ asset('/uploads/'~ produits.photos) }} et enlever {{ produits.photos }}
 
  
 
 